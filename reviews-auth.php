<?php
declare(strict_types=1);

// TOTP (RFC 6238), SHA-1, six digits, 30-second periods.
function reviews_base32_encode(string $bytes): string {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    $buffer = $bits = 0;
    $result = '';
    foreach (unpack('C*', $bytes) as $byte) {
        $buffer = ($buffer << 8) | $byte;
        $bits += 8;
        while ($bits >= 5) {
            $bits -= 5;
            $result .= $alphabet[($buffer >> $bits) & 31];
        }
        $buffer &= (1 << $bits) - 1;
    }
    if ($bits) $result .= $alphabet[($buffer << (5 - $bits)) & 31];
    return $result;
}

function reviews_base32_decode(string $value): string {
    if (!preg_match('/^[A-Z2-7]+$/D', $value)) throw new InvalidArgumentException('Invalid TOTP key');
    $buffer = $bits = 0;
    $result = '';
    foreach (str_split($value) as $character) {
        $buffer = ($buffer << 5) | strpos('ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', $character);
        $bits += 5;
        if ($bits >= 8) {
            $bits -= 8;
            $result .= chr(($buffer >> $bits) & 255);
        }
        $buffer &= (1 << $bits) - 1;
    }
    return $result;
}

function reviews_totp(string $secret, int $counter, int $digits = 6): string {
    $binary = pack('N2', intdiv($counter, 4294967296), $counter & 0xffffffff);
    $hash = hash_hmac('sha1', $binary, reviews_base32_decode($secret), true);
    $offset = ord($hash[19]) & 15;
    $number = unpack('N', substr($hash, $offset, 4))[1] & 0x7fffffff;
    return str_pad((string)($number % (10 ** $digits)), $digits, '0', STR_PAD_LEFT);
}

function reviews_totp_match(string $secret, string $code, int $lastCounter, ?int $now = null): ?int {
    if (!preg_match('/^[0-9]{6}$/D', $code)) return null;
    $current = intdiv($now ?? time(), 30);
    foreach ([$current, $current - 1, $current + 1] as $counter) {
        if ($counter > $lastCounter && hash_equals(reviews_totp($secret, $counter), $code)) return $counter;
    }
    return null;
}

function reviews_auth_schema(PDO $pdo): void {
    $pdo->exec('CREATE TABLE IF NOT EXISTS reviews_admin_auth (
        id TINYINT UNSIGNED PRIMARY KEY,
        secret VARCHAR(64) NULL,
        recovery_hashes TEXT NOT NULL,
        last_counter BIGINT NOT NULL DEFAULT -1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $pdo->exec("INSERT IGNORE INTO reviews_admin_auth (id, recovery_hashes) VALUES (1, '[]')");
    $pdo->exec('CREATE TABLE IF NOT EXISTS reviews_auth_limits (
        bucket CHAR(64) PRIMARY KEY,
        started_at BIGINT NOT NULL,
        attempts INT UNSIGNED NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
}

function reviews_auth_state(PDO $pdo, bool $lock = false): array {
    return $pdo->query('SELECT * FROM reviews_admin_auth WHERE id=1' . ($lock ? ' FOR UPDATE' : ''))->fetch();
}

// Persistent limits cover different browsers, sessions and simultaneous requests.
function reviews_auth_attempt(PDO $pdo): bool {
    $now = time();
    $pdo->beginTransaction();
    try {
        foreach (['account' => 30, 'ip:' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') => 10] as $key => $limit) {
            $bucket = hash('sha256', $key);
            $pdo->prepare('INSERT IGNORE INTO reviews_auth_limits (bucket, started_at, attempts) VALUES (?, ?, 0)')->execute([$bucket, $now]);
            $query = $pdo->prepare('SELECT started_at, attempts FROM reviews_auth_limits WHERE bucket=? FOR UPDATE');
            $query->execute([$bucket]);
            $row = $query->fetch();
            $expired = (int)$row['started_at'] <= $now - 900;
            if (!$expired && (int)$row['attempts'] >= $limit) {
                $pdo->rollBack();
                return false;
            }
            $pdo->prepare('UPDATE reviews_auth_limits SET started_at=?, attempts=? WHERE bucket=?')->execute([
                $expired ? $now : (int)$row['started_at'], $expired ? 1 : (int)$row['attempts'] + 1, $bucket
            ]);
        }
        $pdo->prepare('DELETE FROM reviews_auth_limits WHERE started_at < ?')->execute([$now - 86400]);
        $pdo->commit();
        return true;
    } catch (Throwable $exception) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        throw $exception;
    }
}

function reviews_auth_verify(PDO $pdo, string $code, bool $recovery): bool {
    $pdo->beginTransaction();
    try {
        $state = reviews_auth_state($pdo, true);
        $valid = false;
        if (!empty($state['secret'])) {
            if ($recovery) {
                $normalized = strtoupper(str_replace(['-', ' '], '', $code));
                $hashes = json_decode($state['recovery_hashes'], true, 512, JSON_THROW_ON_ERROR);
                foreach ($hashes as $index => $hash) {
                    if (hash_equals($hash, hash('sha256', $normalized))) {
                        unset($hashes[$index]);
                        $pdo->prepare('UPDATE reviews_admin_auth SET recovery_hashes=? WHERE id=1')->execute([json_encode(array_values($hashes), JSON_THROW_ON_ERROR)]);
                        $valid = true;
                        break;
                    }
                }
            } else {
                $counter = reviews_totp_match($state['secret'], $code, (int)$state['last_counter']);
                if ($counter !== null) {
                    $pdo->prepare('UPDATE reviews_admin_auth SET last_counter=? WHERE id=1')->execute([$counter]);
                    $valid = true;
                }
            }
        }
        $pdo->commit();
        return $valid;
    } catch (Throwable $exception) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        throw $exception;
    }
}

function reviews_auth_enroll(PDO $pdo, string $secret, string $code): ?array {
    $counter = reviews_totp_match($secret, $code, -1);
    if ($counter === null) return null;
    $codes = $hashes = [];
    for ($i = 0; $i < 8; $i++) {
        $raw = strtoupper(bin2hex(random_bytes(8)));
        $codes[] = implode('-', str_split($raw, 4));
        $hashes[] = hash('sha256', $raw);
    }
    // Atomic enrollment: a concurrent setup can never replace an active key.
    $query = $pdo->prepare('UPDATE reviews_admin_auth SET secret=?, recovery_hashes=?, last_counter=? WHERE id=1 AND secret IS NULL');
    $query->execute([$secret, json_encode($hashes, JSON_THROW_ON_ERROR), $counter]);
    return $query->rowCount() === 1 ? $codes : null;
}

function reviews_auth_grant(string $secret): void {
    session_regenerate_id(true);
    unset($_SESSION['reviews_admin'], $_SESSION['auth_setup']);
    $_SESSION['reviews_auth_v2'] = time();
    $_SESSION['reviews_auth_started'] = time();
    $_SESSION['reviews_auth_key'] = hash('sha256', $secret);
    $_SESSION['auth_csrf'] = bin2hex(random_bytes(32));
}

function reviews_auth_escape(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function reviews_auth_redirect(): void {
    header('Location: gestione-recensioni.php', true, 303);
    exit;
}

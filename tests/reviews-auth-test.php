<?php
declare(strict_types=1);
require __DIR__ . '/../reviews-auth.php';

function check(bool $condition, string $message): void {
    if (!$condition) throw new RuntimeException($message);
}

// RFC 6238 Appendix B: independent SHA-1 reference vectors (8 digits).
$secret = reviews_base32_encode('12345678901234567890');
check($secret === 'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', 'Base32 known vector');
foreach ([59 => '94287082', 1111111109 => '07081804', 1111111111 => '14050471', 1234567890 => '89005924', 2000000000 => '69279037', 20000000000 => '65353130'] as $time => $expected) {
    check(reviews_totp($secret, intdiv($time, 30), 8) === $expected, 'RFC vector at ' . $time);
}
foreach ([1, 2, 3, 5, 20, 32] as $length) {
    $bytes = random_bytes($length);
    check(reviews_base32_decode(reviews_base32_encode($bytes)) === $bytes, 'Base32 roundtrip');
}
check(reviews_totp_match($secret, '287082', -1, 59) === 1, 'Six-digit code');
check(reviews_totp_match($secret, '287082', 1, 59) === null, 'Reject replay');
check(reviews_totp_match($secret, '287082', -1, 89) === 1, 'Allow previous period');
check(reviews_totp_match($secret, '287082', -1, 119) === null, 'Reject expired code');
check(reviews_totp_match($secret, '287082', -1, 29) === 1, 'Allow small forward clock skew');
foreach (['', '12345', '1234567', '12345x', "287082\n"] as $invalid) {
    check(reviews_totp_match($secret, $invalid, -1, 59) === null, 'Reject malformed code');
}

// Optional integration tests use a dedicated disposable CI database only.
if (getenv('REVIEWS_TEST_DSN')) {
    $pdo = new PDO(getenv('REVIEWS_TEST_DSN'), 'root', 'test', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    reviews_auth_schema($pdo);
    $pdo->exec('DELETE FROM reviews_auth_limits');
    $pdo->exec("UPDATE reviews_admin_auth SET secret=NULL, recovery_hashes='[]', last_counter=-1 WHERE id=1");
    check(reviews_auth_enroll($pdo, $secret, 'invalid') === null, 'Invalid enrollment');
    check(reviews_auth_state($pdo)['secret'] === null, 'Invalid enrollment leaves setup available');
    $code = reviews_totp($secret, intdiv(time(), 30));
    $codes = reviews_auth_enroll($pdo, $secret, $code);
    check(is_array($codes) && count($codes) === 8, 'Generate eight recovery codes');
    check(reviews_auth_enroll($pdo, reviews_base32_encode(random_bytes(20)), '000000') === null, 'Reject replacement enrollment');
    check(!reviews_auth_verify($pdo, $code, false), 'Enrollment code cannot log in again');
    $pdo->exec('UPDATE reviews_admin_auth SET last_counter=-1 WHERE id=1');
    $code = reviews_totp($secret, intdiv(time(), 30));
    check(reviews_auth_verify($pdo, $code, false), 'Login with app code');
    check(!reviews_auth_verify($pdo, $code, false), 'Reject replay across requests');
    check(reviews_auth_verify($pdo, strtolower($codes[0]), true), 'Recovery code login');
    check(!reviews_auth_verify($pdo, $codes[0], true), 'Recovery code is single use');
    check(count(json_decode(reviews_auth_state($pdo)['recovery_hashes'], true)) === 7, 'Used recovery code removed');
    check(!str_contains(reviews_auth_state($pdo)['recovery_hashes'], str_replace('-', '', $codes[1])), 'Recovery codes stored as hashes');
    $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    for ($i = 0; $i < 10; $i++) check(reviews_auth_attempt($pdo), 'Allow initial attempts');
    check(!reviews_auth_attempt($pdo), 'Block excess attempts');
    $pdo->exec('UPDATE reviews_auth_limits SET started_at=0');
    check(reviews_auth_attempt($pdo), 'Unlock after cooldown');
    for ($ip = 2; $ip <= 4; $ip++) {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.' . $ip;
        for ($i = 0; $i < ($ip === 4 ? 9 : 10); $i++) check(reviews_auth_attempt($pdo), 'Account limit initial attempts');
    }
    $_SERVER['REMOTE_ADDR'] = '127.0.0.5';
    check(!reviews_auth_attempt($pdo), 'Account-wide limit across IPs');
}
echo "Reviews authentication checks passed.\n";

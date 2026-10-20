<?php
declare(strict_types=1);
ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
session_set_cookie_params(['lifetime' => 0, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Strict']);
session_start();
header('Cache-Control: no-store, private, max-age=0');
header('Pragma: no-cache');
header('X-Robots-Tag: noindex, nofollow');
header('Referrer-Policy: no-referrer');
require __DIR__ . '/reviews-service.php';
require __DIR__ . '/reviews-auth.php';

function review_display_date(string $value): string {
    return (new DateTimeImmutable($value, new DateTimeZone('UTC')))
        ->setTimezone(new DateTimeZone('Europe/Rome'))
        ->format('d/m/Y H:i');
}

$configPath = __DIR__ . '/../reviews-config.php';
$config = is_file($configPath) ? require $configPath : [];
$error = '';
$available = true;
$state = [];
unset($_SESSION['reviews_admin']); // Invalidate all legacy password-only sessions.
$_SESSION['auth_csrf'] ??= bin2hex(random_bytes(32));
if (isset($_SESSION['auth_setup']) && (int)$_SESSION['auth_setup']['expires'] < time()) unset($_SESSION['auth_setup']);
if (isset($_SESSION['reviews_auth_v2']) && ((int)$_SESSION['reviews_auth_v2'] < time() - 1200 || (int)($_SESSION['reviews_auth_started'] ?? 0) < time() - 28800)) {
    unset($_SESSION['reviews_auth_v2'], $_SESSION['reviews_auth_started'], $_SESSION['auth_recovery_codes']);
}
try {
    $pdo = reviews_db();
    reviews_auth_schema($pdo);
    $state = reviews_auth_state($pdo);
    if (!empty($_SESSION['reviews_auth_v2']) && (empty($state['secret']) || !hash_equals(hash('sha256', $state['secret']), (string)($_SESSION['reviews_auth_key'] ?? '')))) {
        unset($_SESSION['reviews_auth_v2'], $_SESSION['reviews_auth_started'], $_SESSION['auth_recovery_codes']);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!is_string($_POST['csrf'] ?? null) || !hash_equals($_SESSION['auth_csrf'], $_POST['csrf'])) {
            http_response_code(403);
            $error = 'Sessione non valida. Ricarica la pagina e riprova.';
        } elseif (isset($_POST['logout'])) {
            $_SESSION = [];
            session_destroy();
            setcookie(session_name(), '', ['expires' => time() - 3600, 'path' => '/', 'secure' => true, 'httponly' => true, 'samesite' => 'Strict']);
            reviews_auth_redirect();
        } elseif (($_POST['auth_action'] ?? '') === 'acknowledge' && !empty($_SESSION['reviews_auth_v2']) && !empty($_POST['saved'])) {
            unset($_SESSION['auth_recovery_codes']);
            reviews_auth_redirect();
        } elseif (($_POST['auth_action'] ?? '') === 'cancel') {
            unset($_SESSION['auth_setup']);
            reviews_auth_redirect();
        } elseif (empty($_SESSION['reviews_auth_v2'])) {
            if (!reviews_auth_attempt($pdo)) {
                http_response_code(429);
                header('Retry-After: 900');
                $error = 'Troppi tentativi. Attendi 15 minuti prima di riprovare.';
            } else {
                $action = $_POST['auth_action'] ?? '';
                $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
                if ($action === 'setup' && empty($state['secret']) && !empty($config['admin_password']) && strlen($password) <= 1024 && hash_equals((string)$config['admin_password'], $password)) {
                    session_regenerate_id(true);
                    $_SESSION['auth_setup'] = ['secret' => reviews_base32_encode(random_bytes(20)), 'expires' => time() + 600];
                    reviews_auth_redirect();
                } elseif ($action === 'enroll' && empty($state['secret']) && !empty($_SESSION['auth_setup']) && is_string($_POST['code'] ?? null)) {
                    $codes = reviews_auth_enroll($pdo, $_SESSION['auth_setup']['secret'], $_POST['code']);
                    if ($codes !== null) {
                        reviews_auth_grant($_SESSION['auth_setup']['secret']);
                        $_SESSION['auth_recovery_codes'] = $codes;
                        reviews_auth_redirect();
                    }
                    $error = 'Codice non valido. Controlla l’orario del telefono e riprova con il nuovo codice.';
                } elseif (!empty($state['secret']) && in_array($action, ['login', 'recovery'], true)) {
                    $code = $_POST[$action === 'recovery' ? 'recovery' : 'code'] ?? '';
                    if (is_string($code) && strlen($code) <= 32 && reviews_auth_verify($pdo, $code, $action === 'recovery')) {
                        reviews_auth_grant($state['secret']);
                        reviews_auth_redirect();
                    }
                    $error = 'Codice non valido, scaduto o già utilizzato. Riprova.';
                } else {
                    $error = 'Accesso non riuscito. Controlla i dati e riprova.';
                }
            }
        }
    }
} catch (Throwable $exception) {
    error_log('Reviews authentication unavailable: ' . get_class($exception));
    http_response_code(503);
    $available = false;
    $error = 'Non è possibile verificare l’accesso in questo momento.';
}
if (!$available || empty($_SESSION['reviews_auth_v2']) || !empty($_SESSION['auth_recovery_codes'])) {
    define('REVIEWS_AUTH_PAGE', true);
    require __DIR__ . '/reviews-auth-page.php';
    exit;
}
$_SESSION['reviews_auth_v2'] = time();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error && isset($_POST['action'], $_POST['id'])) {
    $id = (int)$_POST['id'];
    if ($_POST['action'] === 'publish') $pdo->prepare('UPDATE site_reviews SET status="published", published_at=NOW() WHERE id=?')->execute([$id]);
    if ($_POST['action'] === 'pending') $pdo->prepare('UPDATE site_reviews SET status="pending", published_at=NULL WHERE id=?')->execute([$id]);
    if ($_POST['action'] === 'delete') $pdo->prepare('DELETE FROM site_reviews WHERE id=?')->execute([$id]);
    header('Location: gestione-recensioni.php'); exit;
}
$reviews = $pdo->query('SELECT * FROM site_reviews ORDER BY status ASC, created_at DESC')->fetchAll();
?><!doctype html><html lang="it"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>Gestione recensioni</title><body style="margin:0;background:#101010;color:#fff;font:16px Arial;padding:32px"><main style="max-width:900px;margin:auto"><form method="post" style="float:right"><input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>"><button name="logout">Esci</button></form><h1>Gestione recensioni</h1><?php if ($error): ?><p role="alert" style="color:#f88"><?= reviews_auth_escape($error) ?></p><?php endif; ?><p>Le recensioni in attesa non sono visibili ai clienti.</p><?php foreach ($reviews as $review): ?><article style="border:1px solid #444;padding:20px;margin:16px 0"><strong><?= htmlspecialchars($review['customer_name']) ?></strong> &middot; <?= str_repeat('★', (int)$review['rating']) ?><span style="color:#888"><?= str_repeat('★', 5-(int)$review['rating']) ?></span><p><?= nl2br(htmlspecialchars($review['review_text'])) ?></p><small><?= htmlspecialchars($review['status']) ?> - <?= review_display_date($review['created_at']) ?></small><form method="post" style="margin-top:14px;display:flex;gap:8px"><input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>"><input type="hidden" name="id" value="<?= (int)$review['id'] ?>"><?php if ($review['status'] === 'pending'): ?><button name="action" value="publish">Pubblica</button><?php else: ?><button name="action" value="pending">Nascondi</button><?php endif; ?><button name="action" value="delete" onclick="return confirm('Eliminare questa recensione?')">Elimina</button></form></article><?php endforeach; ?></main></body></html>

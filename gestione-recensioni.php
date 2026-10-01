<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/reviews-service.php';

function review_display_date(string $value): string {
    return (new DateTimeImmutable($value, new DateTimeZone('UTC')))
        ->setTimezone(new DateTimeZone('Europe/Rome'))
        ->format('d/m/Y H:i');
}

$configPath = __DIR__ . '/../reviews-config.php';
$config = is_file($configPath) ? require $configPath : [];
$error = '';
if (isset($_POST['logout'])) { session_destroy(); header('Location: gestione-recensioni.php'); exit; }
if (isset($_POST['password'])) {
    if (!empty($config['admin_password']) && hash_equals($config['admin_password'], (string)$_POST['password'])) $_SESSION['reviews_admin'] = true;
    else $error = 'Password non corretta.';
}
if (empty($_SESSION['reviews_admin'])) {
?><!doctype html><html lang="it"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Gestione recensioni</title><body style="margin:0;background:#101010;color:#fff;font:16px Arial;display:grid;place-items:center;min-height:100vh"><form method="post" style="width:min(360px,calc(100% - 48px));border:1px solid #444;padding:32px"><h1 style="margin-top:0">Recensioni</h1><p>Area riservata Ferri Ristrutturazioni.</p><?php if ($error) echo '<p style="color:#f88">'.$error.'</p>'; ?><label>Password<br><input type="password" name="password" required style="width:100%;box-sizing:border-box;padding:12px;margin-top:8px"></label><button style="margin-top:20px;padding:12px 18px">Accedi</button></form></body></html><?php exit;
}
$pdo = reviews_db();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['id'])) {
    $id = (int)$_POST['id'];
    if ($_POST['action'] === 'publish') $pdo->prepare('UPDATE site_reviews SET status="published", published_at=NOW() WHERE id=?')->execute([$id]);
    if ($_POST['action'] === 'pending') $pdo->prepare('UPDATE site_reviews SET status="pending", published_at=NULL WHERE id=?')->execute([$id]);
    if ($_POST['action'] === 'delete') $pdo->prepare('DELETE FROM site_reviews WHERE id=?')->execute([$id]);
    header('Location: gestione-recensioni.php'); exit;
}
$reviews = $pdo->query('SELECT * FROM site_reviews ORDER BY status ASC, created_at DESC')->fetchAll();
?><!doctype html><html lang="it"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Gestione recensioni</title><body style="margin:0;background:#101010;color:#fff;font:16px Arial;padding:32px"><main style="max-width:900px;margin:auto"><form method="post" style="float:right"><button name="logout">Esci</button></form><h1>Gestione recensioni</h1><p>Le recensioni in attesa non sono visibili ai clienti.</p><?php foreach ($reviews as $review): ?><article style="border:1px solid #444;padding:20px;margin:16px 0"><strong><?= htmlspecialchars($review['customer_name']) ?></strong> &middot; <?= str_repeat('★', (int)$review['rating']) ?><span style="color:#888"><?= str_repeat('★', 5-(int)$review['rating']) ?></span><p><?= nl2br(htmlspecialchars($review['review_text'])) ?></p><small><?= htmlspecialchars($review['status']) ?> - <?= review_display_date($review['created_at']) ?></small><form method="post" style="margin-top:14px;display:flex;gap:8px"><input type="hidden" name="id" value="<?= (int)$review['id'] ?>"><?php if ($review['status'] === 'pending'): ?><button name="action" value="publish">Pubblica</button><?php else: ?><button name="action" value="pending">Nascondi</button><?php endif; ?><button name="action" value="delete" onclick="return confirm('Eliminare questa recensione?')">Elimina</button></form></article><?php endforeach; ?></main></body></html>

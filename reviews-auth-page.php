<?php
declare(strict_types=1);
if (!defined('REVIEWS_AUTH_PAGE')) { http_response_code(404); exit; }
$setup = $_SESSION['auth_setup'] ?? null;
$codes = $_SESSION['auth_recovery_codes'] ?? [];
$enabled = !empty($state['secret']);
$uri = $setup ? 'otpauth://totp/' . rawurlencode('Ferri Ristrutturazioni:Area riservata') . '?secret=' . rawurlencode($setup['secret']) . '&issuer=Ferri%20Ristrutturazioni&algorithm=SHA1&digits=6&period=30' : '';
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Area riservata | Ferri Ristrutturazioni</title>
    <style>
        *{box-sizing:border-box}body{margin:0;background:#101010;color:#fff;font:16px/1.55 Arial,sans-serif;min-height:100vh;display:grid;place-items:center;padding:24px}
        main{width:min(100%,480px);border:1px solid #444;padding:clamp(20px,5vw,32px);background:#171717}h1{font-size:27px;line-height:1.2;margin:0 0 20px}h2{font-size:19px}p{color:#ccc}label{display:block;margin:20px 0 8px}
        input:not([type=checkbox]){width:100%;padding:14px;font:inherit;background:#fff;color:#111;border:1px solid #999;border-radius:0}input[name=code]{font-size:25px;letter-spacing:5px}
        button,.app-link{display:block;width:100%;padding:14px 18px;margin-top:20px;font:inherit;cursor:pointer;border:1px solid #fff;background:#fff;color:#111;text-align:center;text-decoration:none}
        a{color:#fff}summary{cursor:pointer}details{margin-top:24px}.error{color:#ffb3b3;border-left:3px solid #ffb3b3;padding-left:12px}.muted{font-size:14px}.brand{letter-spacing:2px;text-transform:uppercase;font-size:12px;color:#aaa}
        #auth-qr{background:#fff;padding:20px;width:min(100%,264px);margin:20px auto}#auth-qr img,#auth-qr canvas{display:block;max-width:100%;height:auto}code{overflow-wrap:anywhere;background:#292929;padding:8px;display:block;color:#fff}
        .codes{font:16px/2 monospace;padding:16px;background:#292929;list-style:none}.back{display:inline-block;margin-top:28px;font-size:14px}
    </style>
</head>
<body><main>
    <p class="brand">Ferri Ristrutturazioni</p>
    <h1>Area riservata</h1>
    <?php if ($error): ?><p class="error" role="alert"><?= reviews_auth_escape($error) ?></p><?php endif; ?>
    <?php if (!$available): ?>
        <p>Accesso momentaneamente non disponibile. Riprova tra poco.</p>
    <?php elseif ($codes): ?>
        <h2>Google Authenticator è attivo</h2>
        <p>Da ora accedi soltanto con il codice dell’app, senza password.</p>
        <p>Conserva questi codici di recupero in un luogo sicuro, diverso dal telefono. Ognuno permette un solo accesso se perdi il telefono. Verranno mostrati solo qui.</p>
        <ul class="codes"><?php foreach ($codes as $code): ?><li><?= reviews_auth_escape($code) ?></li><?php endforeach; ?></ul>
        <form method="post" action="gestione-recensioni.php">
            <input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>">
            <input type="hidden" name="auth_action" value="acknowledge">
            <label><input type="checkbox" name="saved" value="1" required> Ho conservato i codici di recupero</label>
            <button>Entra nell’area riservata</button>
        </form>
    <?php elseif ($setup && !$enabled): ?>
        <h2>Collega Google Authenticator</h2>
        <p>Apri Google Authenticator sul telefono, premi <strong>+</strong>, poi <strong>Scansiona un codice QR</strong> e inquadra questo codice.</p>
        <div id="auth-qr" data-uri="<?= reviews_auth_escape($uri) ?>" aria-label="Codice QR per Google Authenticator"></div>
        <a class="app-link" href="<?= reviews_auth_escape($uri) ?>">Apri nell’app su questo telefono</a>
        <details><summary>Inserisci la chiave manualmente</summary><p>Nell’app scegli “Inserisci una chiave di configurazione”, nome <strong>Ferri Ristrutturazioni</strong>, tipo <strong>Basato sul tempo</strong>.</p><code><?= reviews_auth_escape($setup['secret']) ?></code></details>
        <p class="muted">Non condividere il QR o la chiave. La configurazione scade dopo 10 minuti.</p>
        <form method="post" action="gestione-recensioni.php">
            <input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>">
            <input type="hidden" name="auth_action" value="enroll">
            <label for="code">Codice a 6 cifre mostrato nell’app</label>
            <input id="code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code" pattern="[0-9]{6}" minlength="6" maxlength="6" required>
            <button>Conferma e attiva l’accesso</button>
        </form>
        <form method="post" action="gestione-recensioni.php"><input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>"><button name="auth_action" value="cancel">Annulla configurazione</button></form>
        <script src="assets/js/vendor/qrcode.min.js"></script>
        <script>try{var qr=document.getElementById('auth-qr');new QRCode(qr,{text:qr.dataset.uri,width:224,height:224,correctLevel:QRCode.CorrectLevel.M});qr.removeAttribute('title');}catch(e){document.getElementById('auth-qr').textContent='Usa la chiave manuale qui sotto.';}</script>
    <?php elseif ($enabled): ?>
        <p>Apri Google Authenticator e inserisci il codice di <strong>Ferri Ristrutturazioni</strong>.</p>
        <form method="post" action="gestione-recensioni.php">
            <input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>">
            <input type="hidden" name="auth_action" value="login">
            <label for="code">Codice Google Authenticator</label>
            <input id="code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code" pattern="[0-9]{6}" minlength="6" maxlength="6" required autofocus>
            <button>Accedi</button>
        </form>
        <p class="muted">Il codice cambia ogni 30 secondi. Se lo hai appena usato, attendi il successivo.</p>
        <details><summary>Non ho il telefono</summary>
            <p>Inserisci uno dei codici di recupero salvati durante l’attivazione.</p>
            <form method="post" action="gestione-recensioni.php">
                <input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>">
                <input type="hidden" name="auth_action" value="recovery">
                <label for="recovery">Codice di recupero</label>
                <input id="recovery" name="recovery" type="text" autocomplete="off" maxlength="32" required>
                <button>Accedi con il codice di recupero</button>
            </form>
        </details>
    <?php else: ?>
        <h2>Attiva l’accesso con Google Authenticator</h2>
        <p>Per collegare il tuo telefono, conferma la password attuale dell’area riservata. Serve solo per questa prima attivazione. Poi accederai soltanto con il codice dell’app.</p>
        <form method="post" action="gestione-recensioni.php">
            <input type="hidden" name="csrf" value="<?= reviews_auth_escape($_SESSION['auth_csrf']) ?>">
            <input type="hidden" name="auth_action" value="setup">
            <label for="password">Password attuale, solo per l’attivazione</label>
            <input id="password" name="password" type="password" autocomplete="current-password" maxlength="1024" required>
            <button>Collega il mio telefono</button>
        </form>
    <?php endif; ?>
    <a class="back" href="/">Torna al sito</a>
</main></body></html>

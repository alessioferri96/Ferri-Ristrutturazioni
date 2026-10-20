<?php
declare(strict_types=1);
if (!defined('REVIEWS_ADMIN_PAGE')) { http_response_code(404); exit; }
$csrf = reviews_auth_escape($_SESSION['auth_csrf']);
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Area riservata | Ferri Ristrutturazioni</title>
    <style>
        *{box-sizing:border-box}body{margin:0;background:#101010;color:#fff;font:16px/1.55 Arial,sans-serif;padding:clamp(20px,4vw,40px)}main{max-width:960px;margin:auto}
        a{color:inherit}header{display:flex;align-items:center;justify-content:space-between;gap:20px;border-bottom:1px solid #393939;padding-bottom:24px;margin-bottom:32px}.brand{text-transform:uppercase;letter-spacing:2px;color:#aaa;font-size:12px;margin:0 0 6px}header a{text-decoration:none;font-size:22px;font-weight:bold}
        h1{font-size:clamp(26px,5vw,36px);line-height:1.2;margin:16px 0}h2{font-size:23px;margin:0 0 12px}p{color:#ccc}button,.button{background:#fff;border:1px solid #fff;color:#111;padding:11px 16px;cursor:pointer;font:inherit;text-decoration:none;display:inline-block}.secondary{background:transparent;color:#fff;border-color:#666}
        .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:24px;margin-top:28px}.card{background:#191919;border:1px solid #414141;padding:clamp(20px,3vw,32px);min-width:0}.section-link{display:flex;flex-direction:column;align-items:flex-start;text-decoration:none;transition:border-color .2s}.section-link:hover,.section-link:focus-visible{border-color:#fff}.section-link p{flex:1}.section-link .button{margin-top:16px}.eyebrow{font-size:13px;letter-spacing:2px;color:#aaa;margin-bottom:22px}
        .qr-card{text-align:center}.qr-image{box-sizing:content-box;width:min(240px,calc(100% - 40px));aspect-ratio:1;background:#fff;padding:20px;margin:24px auto}.qr-image img,.qr-image canvas{display:block;width:100%;height:auto}.destination{display:block;overflow-wrap:anywhere;font-size:14px;color:#ccc}.back{display:inline-block;color:#bbb;margin-bottom:12px;font-size:14px}
        .review{margin:20px 0;border:1px solid #444;padding:24px;overflow-wrap:anywhere}.review p{white-space:normal}.review small{color:#aaa}.review-actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:18px}.error{color:#ffb3b3}.empty{padding:28px;border:1px solid #444}.stars-empty{color:#666}
        @media(max-width:640px){.grid{grid-template-columns:1fr;gap:18px}header a{font-size:19px}header{gap:12px}.review{padding:20px}}
    </style>
</head>
<body><main>
    <header>
        <div><p class="brand">Ferri Ristrutturazioni</p><a href="gestione-recensioni.php">Area riservata</a></div>
        <form method="post" action="gestione-recensioni.php"><input type="hidden" name="csrf" value="<?= $csrf ?>"><button class="secondary" name="logout">Esci</button></form>
    </header>
    <?php if ($error): ?><p class="error" role="alert"><?= reviews_auth_escape($error) ?></p><?php endif; ?>
    <?php if ($section === 'recensioni'): ?>
        <a class="back" href="gestione-recensioni.php">← Tutte le sezioni</a>
        <h1>Gestione recensioni</h1>
        <p>Le recensioni in attesa non sono visibili ai clienti.</p>
        <?php if (!$reviews): ?><p class="empty">Non ci sono ancora recensioni da gestire.</p><?php endif; ?>
        <?php foreach ($reviews as $review): ?>
            <article class="review">
                <strong><?= reviews_auth_escape($review['customer_name']) ?></strong> &middot;
                <span aria-label="<?= (int)$review['rating'] ?> stelle su 5"><?= str_repeat('★', (int)$review['rating']) ?><span class="stars-empty"><?= str_repeat('★', 5 - (int)$review['rating']) ?></span></span>
                <p><?= nl2br(reviews_auth_escape($review['review_text'])) ?></p>
                <small><?= $review['status'] === 'pending' ? 'In attesa' : 'Pubblicata' ?> · <?= review_display_date($review['created_at']) ?></small>
                <form method="post" action="gestione-recensioni.php?sezione=recensioni" class="review-actions">
                    <input type="hidden" name="csrf" value="<?= $csrf ?>">
                    <input type="hidden" name="id" value="<?= (int)$review['id'] ?>">
                    <?php if ($review['status'] === 'pending'): ?><button name="action" value="publish">Pubblica</button><?php else: ?><button name="action" value="pending">Nascondi</button><?php endif; ?>
                    <button class="secondary" name="action" value="delete" onclick="return confirm('Eliminare questa recensione?')">Elimina</button>
                </form>
            </article>
        <?php endforeach; ?>
    <?php elseif ($section === 'qrcode'): ?>
        <a class="back" href="gestione-recensioni.php">← Tutte le sezioni</a>
        <h1>QR code</h1>
        <p>Inquadra un codice con la fotocamera del telefono per aprire il sito o il profilo Instagram.</p>
        <div class="grid">
            <article class="card qr-card">
                <h2>Sito web</h2>
                <div class="qr-image" data-qr-url="https://www.ferriristrutturazioni.com/" role="img" aria-label="QR code per il sito Ferri Ristrutturazioni"></div>
                <a class="button" href="https://www.ferriristrutturazioni.com/" target="_blank" rel="noopener noreferrer">Apri il sito</a>
                <p class="destination">www.ferriristrutturazioni.com</p>
            </article>
            <article class="card qr-card">
                <h2>Instagram</h2>
                <div class="qr-image" data-qr-url="https://www.instagram.com/ferriristrutturazioni/" role="img" aria-label="QR code per Instagram Ferri Ristrutturazioni"></div>
                <a class="button" href="https://www.instagram.com/ferriristrutturazioni/" target="_blank" rel="noopener noreferrer">Apri Instagram</a>
                <p class="destination">@ferriristrutturazioni</p>
            </article>
        </div>
        <noscript><p>Per visualizzare i QR code abilita JavaScript. Puoi aprire le destinazioni usando i pulsanti.</p></noscript>
        <script src="assets/js/vendor/qrcode.min.js" defer></script>
        <script src="assets/js/admin-qrcodes.js" defer></script>
    <?php else: ?>
        <h1>Le tue sezioni</h1>
        <p>Scegli cosa vuoi aprire.</p>
        <nav class="grid" aria-label="Sezioni area riservata">
            <a class="card section-link" href="gestione-recensioni.php?sezione=recensioni">
                <span class="eyebrow" aria-hidden="true">01</span>
                <h2>Gestione recensioni</h2>
                <p>Leggi le recensioni ricevute e scegli quali pubblicare sul sito.</p>
                <span class="button">Gestisci recensioni →</span>
            </a>
            <a class="card section-link" href="gestione-recensioni.php?sezione=qrcode">
                <span class="eyebrow" aria-hidden="true">02</span>
                <h2>QR code</h2>
                <p>Mostra i codici per raggiungere il sito web e il profilo Instagram.</p>
                <span class="button">Mostra QR code →</span>
            </a>
        </nav>
    <?php endif; ?>
</main></body></html>

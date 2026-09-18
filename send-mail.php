<?php
// Configurazione
$destinatario = 'info@ferriristrutturazioni.com';
$oggetto_base = 'Nuovo messaggio dal sito - Ferri Ristrutturazioni';

// Prevenzione accesso diretto (solo POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}

// Sanitizzazione input
$nome = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
$telefono = htmlspecialchars(trim($_POST['phone'] ?? ''), ENT_QUOTES, 'UTF-8');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$messaggio = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');
$privacy = isset($_POST['privacy']) ? true : false;
$pagine_consentite = [
    'index.html',
    'chi-siamo.html',
    'servizi.html',
    'progetti.html',
    'contatti.html',
    'ristrutturazioni-frascati.html'
];
$pagina_richiesta = trim($_POST['_pagina'] ?? '');
$pagina_origine = in_array($pagina_richiesta, $pagine_consentite, true)
    ? $pagina_richiesta
    : 'contatti.html';

$ancora = '#form-feedback';

// Validazione campi obbligatori
$errori = [];
if (empty($nome)) $errori[] = 'Nome obbligatorio';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errori[] = 'Email non valida';
if (empty($messaggio)) $errori[] = 'Messaggio obbligatorio';
if (!$privacy) $errori[] = 'Devi accettare la Privacy Policy';

// Protezione anti-spam (honeypot)
if (!empty($_POST['_hp'])) {
    // Bot rilevato, rispondi con successo finto
    header('Location: ' . $pagina_origine . '?status=ok' . $ancora, true, 303);
    exit;
}

if (!empty($errori)) {
    // Redirect con errore
    header('Location: ' . $pagina_origine . '?status=errore&msg=' . urlencode(implode(', ', $errori)) . $ancora, true, 303);
    exit;
}

// Composizione email
$oggetto = $oggetto_base . ' [da ' . $pagina_origine . ']';

$corpo = "Nuovo messaggio ricevuto dal sito web:\n\n";
$corpo .= "Nome: {$nome}\n";
if (!empty($telefono)) $corpo .= "Telefono: {$telefono}\n";
$corpo .= "Email: {$email}\n";
$corpo .= "Pagina: {$pagina_origine}\n\n";
$corpo .= "Messaggio:\n{$messaggio}\n\n";
$corpo .= "---\nInviato dal form di contatto di ferriristrutturazioni.com";

// Invio via SMTP autenticato: con mail() il messaggio parte dal server web senza
// firma DKIM e finisce in spam. Le credenziali stanno in smtp-config.php, SOPRA la
// cartella del sito (mai nel repository). Vedi docs/ "Invio Form via SMTP Autenticato".
function invia_smtp($cfg, $a, $oggetto, $corpo, $reply_to) {
    $s = @stream_socket_client('ssl://smtp.hostinger.com:465', $errno, $errstr, 15);
    if (!$s) { error_log("send-mail SMTP connessione: $errstr"); return false; }
    stream_set_timeout($s, 15);
    $leggi = function () use ($s) {
        $r = '';
        while (($riga = fgets($s, 515)) !== false) { $r .= $riga; if (isset($riga[3]) && $riga[3] === ' ') break; }
        return $r;
    };
    $dialogo = [
        [null, '220'],
        ["EHLO ferriristrutturazioni.com", '250'],
        ["AUTH LOGIN", '334'],
        [base64_encode($cfg['user']), '334'],
        [base64_encode($cfg['pass']), '235'],
        ["MAIL FROM:<{$cfg['user']}>", '250'],
        ["RCPT TO:<$a>", '250'],
        ["DATA", '354'],
        ["Date: " . date('r') . "\r\n"
            . "From: \"Sito Ferri Ristrutturazioni\" <{$cfg['user']}>\r\n"
            . "To: <$a>\r\n"
            . "Reply-To: <$reply_to>\r\n"
            . "Subject: =?UTF-8?B?" . base64_encode($oggetto) . "?=\r\n"
            . "Message-ID: <" . bin2hex(random_bytes(12)) . "@ferriristrutturazioni.com>\r\n"
            . "MIME-Version: 1.0\r\n"
            . "Content-Type: text/plain; charset=UTF-8\r\n"
            . "Content-Transfer-Encoding: base64\r\n\r\n"
            . chunk_split(base64_encode($corpo)) . ".", '250'],
    ];
    foreach ($dialogo as [$comando, $atteso]) {
        if ($comando !== null) fwrite($s, $comando . "\r\n");
        $risposta = $leggi();
        if (strncmp($risposta, $atteso, 3) !== 0) {
            // Mai loggare la password: in caso di errore si registra solo la risposta del server
            error_log("send-mail SMTP atteso $atteso, ricevuto: " . trim($risposta));
            fclose($s);
            return false;
        }
    }
    fwrite($s, "QUIT\r\n");
    fclose($s);
    return true;
}

$cfg_path = __DIR__ . '/../smtp-config.php';
$inviato = is_file($cfg_path) && invia_smtp(require $cfg_path, $destinatario, $oggetto, $corpo, $email);

// Ripiego: meglio un messaggio in spam che un contatto perso
if (!$inviato) {
    $headers = "From: noreply@ferriristrutturazioni.com\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: FerriRistrutturazioni/1.0";
    $inviato = mail($destinatario, $oggetto, $corpo, $headers);
}

if ($inviato) {
    header('Location: ' . $pagina_origine . '?status=ok' . $ancora, true, 303);
} else {
    header('Location: ' . $pagina_origine . '?status=errore&msg=' . urlencode('Errore nell\'invio. Riprova o contattaci telefonicamente.') . $ancora, true, 303);
}
exit;
?>

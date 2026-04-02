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
$pagina_origine = htmlspecialchars(trim($_POST['_pagina'] ?? 'sconosciuta'), ENT_QUOTES, 'UTF-8');

// Validazione campi obbligatori
$errori = [];
if (empty($nome)) $errori[] = 'Nome obbligatorio';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errori[] = 'Email non valida';
if (empty($messaggio)) $errori[] = 'Messaggio obbligatorio';
if (!$privacy) $errori[] = 'Devi accettare la Privacy Policy';

// Protezione anti-spam (honeypot)
if (!empty($_POST['_hp'])) {
    // Bot rilevato, rispondi con successo finto
    header('Location: contatti.html?status=ok');
    exit;
}

if (!empty($errori)) {
    // Redirect con errore
    $pagina_ritorno = ($pagina_origine !== 'sconosciuta') ? $pagina_origine : 'contatti.html';
    header('Location: ' . $pagina_ritorno . '?status=errore&msg=' . urlencode(implode(', ', $errori)));
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

$headers = "From: noreply@ferriristrutturazioni.com\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: FerriRistrutturazioni/1.0";

// Invio email
$inviato = mail($destinatario, $oggetto, $corpo, $headers);

if ($inviato) {
    header('Location: contatti.html?status=ok');
} else {
    header('Location: contatti.html?status=errore&msg=' . urlencode('Errore nell\'invio. Riprova o contattaci telefonicamente.'));
}
exit;
?>

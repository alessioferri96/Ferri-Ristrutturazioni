# Invio Form via SMTP Autenticato

## Problema

Dopo il trasferimento sul piano di Alessio (16/09) il messaggio del form arriva
in **Spam**. Intestazioni del test reale:

```
Return-Path: <noreply@srv1803.main-hosting.eu>
Authentication-Results: dkim=none; spf=pass smtp.mailfrom=noreply@srv1803.main-hosting.eu;
    dmarc=fail reason="SPF not aligned (relaxed), No valid DKIM" header.from=ferriristrutturazioni.com
X-Spam: Yes
```

`mail()` di PHP spedisce dal server web con mittente tecnico
`@srv1803.main-hosting.eu`: SPF passa per quel dominio, non per il nostro, e non
c'è firma DKIM → DMARC fallisce e il messaggio viene marcato spam.

Scartata la correzione minima (`mail(..., '-f…')`): il server web `92.113.22.51`
non rientra nell'SPF del dominio (`_spf.mail.hostinger.com` copre solo i relay
di posta), quindi andrebbe aggiunto a mano un IP che Hostinger può cambiare.

## Soluzione

`send-mail.php` invia tramite **SMTP autenticato** `smtp.hostinger.com:465`
(SSL) con le credenziali della casella `info@ferriristrutturazioni.com`. Il
messaggio parte dal server di posta Hostinger, che lo firma DKIM
(`hostingermail-*`) → DMARC allineato.

- `From: "Sito Ferri Ristrutturazioni" <info@ferriristrutturazioni.com>` (il
  server SMTP accetta solo il mittente autenticato), `Reply-To` = chi compila.
- Corpo e oggetto in base64 / encoded-word UTF-8: nessun problema con accenti o
  righe che iniziano con un punto.
- **Credenziali fuori dal repository**: file `smtp-config.php` nella cartella
  del dominio, *sopra* la web root (`/domains/ferriristrutturazioni.com/`), quindi
  non raggiungibile dal web e non toccato dal deploy.
- **Nessun messaggio perso**: se il file manca o l'SMTP fallisce, si torna a
  `mail()` (arriva, eventualmente in spam) e l'errore finisce nel log PHP.

## Verification Plan

1. `php -l send-mail.php` senza errori.
2. Test locale della funzione SMTP contro `smtp.hostinger.com` con password
   errata → deve fallire in modo pulito (false), senza eccezioni.
3. Dopo il deploy + `smtp-config.php` sul server: invio reale dal form →
   intestazioni con `dkim=pass`, `dmarc=pass`, nessun `X-Spam: Yes`, in Posta
   in arrivo.

## Riepilogo Post-Implementazione

Completato il 16/09 (commit `1acfb58` + `smtp-config.php` caricato via FTPS).

1. ✅ `php -l` senza errori.
2. ✅ Password errata contro `smtp.hostinger.com` → `535`, la funzione torna
   `false` in ~2 s, nessuna eccezione.
3. ✅ Invio reale dal terminale e dal form online: entrambi in **Posta in arrivo**,
   `Return-Path: info@ferriristrutturazioni.com`, `dkim=pass spf=pass dmarc=pass`,
   nessun `X-Spam`.

Ripiego verificato sul campo: un invio fatto mentre sul server c'era una password
sbagliata è arrivato comunque (via `mail()`, in Spam) — nessun contatto perso.

Problemi riscontrati: le prime prove di login fallivano per una password
comunicata in modo errato, non per il codice (confermato con un client SMTP
indipendente e con IMAP). `CLAUDE.md` aggiornato: cambiando la password di
`info@` va aggiornato anche `smtp-config.php`, altrimenti il form torna in spam
senza errori visibili.

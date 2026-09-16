# Consegna al Cliente

Chiusura dei punti rimasti aperti dopo la pulizia pre-consegna del 17/08, in
ordine, fino al trasferimento di dominio e hosting sull'account Hostinger del
cliente (modello A).

## Punti

| # | Punto | Tipo |
|---|---|---|
| 1 | Cache CDN con file negati ancora serviti | verifica |
| 2 | Biglietto da visita: 9 file mai committati | repo |
| 3 | Google Business Profile → proprietà a Marco Ferri | esterno |
| 4 | Search Console → delega al cliente | esterno |
| 5 | Iubenda → titolare del trattamento = impresa Ferri | esterno |
| 6 | Analytics assenti | repo + CSP |
| 7 | Trasferimento dominio + hosting + email, rotazione credenziali, verbale | Hostinger |

## 1. Cache CDN

Nessuna modifica. Verifica: i 7 file del 17/08 interrogati **senza** cache-bust
su più edge devono rispondere 403 (negati da `.htaccess`) o 404 (rimossi).

## 2. Biglietto da visita

I file del 25/05 entrano nel repository, così il cliente li riceve insieme al
sito, ma **non vengono pubblicati**: sono materiale di stampa, non pagine.

- `biglietto-da-visita.html` — anteprima a schermo (genera il QR con qrcodejs)
- `biglietto-stampa.html` — sorgente del PDF (WeasyPrint, 85×54 mm)
- `biglietto-da-visita-STAMPA.pdf` — file pronto per la tipografia
- `assets/img/hero-print.jpg`, `assets/img/qrcode-ferri.png` — usati solo da `biglietto-stampa.html`
- `loghi/*.svg` (4) — vettoriali del logo; `loghi/` è già pubblicata, restano pubblici come gli altri loghi

Modifica al workflow: aggiunti a `exclude` `biglietto-*` e le due immagini di
stampa. Sono file nuovi per il server, quindi l'esclusione basta (non esistono
online da cancellare).

Verifica: dopo il push, gli URL dei 5 file esclusi rispondono 404 (con
cache-bust) e le 9 pagine restano 200.

## 3. Google Business Profile

Dal Business Profile: Impostazioni → Persone e accesso → aggiungere l'account Google di Marco come
proprietario → dopo l'accettazione promuoverlo a **Proprietario principale**.
Nessuna modifica al repo.

## 4. Search Console — eseguire DOPO il punto 7

Stato: verifica con il token personale di Andrea `014WSJ…`, presente come TXT
nel DNS e come meta tag **solo in `index.html`**. Un proprietario delegato perde
l'accesso quando l'ultimo proprietario verificato viene rimosso, quindi Marco
deve verificarsi con un proprio TXT (proprietà Dominio) dal suo hPanel, a
dominio già trasferito. Poi: rimuovere Andrea, togliere il meta tag da
`index.html` e il TXT di Andrea dal DNS.

## 5. Iubenda

Stato della policy `10210722` (ultima modifica 8/03/2026): titolare
IMPRESA EDILE MARCO FERRI, Via Ottaviani 21 — corretto — ma **email del titolare
= indirizzo Gmail personale di Andrea**: le richieste GDPR degli utenti
arriverebbero a lui. P.IVA assente.

1. ✅ 16/09 — Email del titolare cambiata da Andrea in `alessioferri1996p@gmail.com`
   (Alessio Ferri, figlio di Marco: scelta del cliente). Verificato online su
   privacy policy, cookie policy e full-legal ("Ultima modifica: 16 settembre
   2026"), nessuna Gmail di Andrea residua. P.IVA non ancora presente (facoltativa).
2. Migrazione del progetto sull'account Iubenda di Marco: email dall'indirizzo
   registrato a `info@iubenda.it` (nessuna funzione self-service)

ID policy e widget restano invariati: nessuna modifica al repo.

## 6. Analytics

**Non installati: decisione di Andrea (16/09).** Il sito resta senza statistiche;
nessuna modifica a CSP o pagine.

## 7. Trasferimento dominio + hosting + email

Tutto intestato ad **Alessio Ferri** (`alessioferri1996p@gmail.com`), come
Business Profile, Search Console e Iubenda.

Svolgimento del 16/09 (Alessio in call):

1. Export posta `info@` — **saltato**: nessun contenuto da conservare (Andrea).
2. ✅ Dominio spostato dall'account di Andrea a quello di Alessio (funzione
   self-service, nessun EPP). Verifica: NS/MX/SPF/DKIM/DMARC/www/ftp identici allo
   snapshot pre-trasferimento, sito 200.
3. ✅ Eliminati sul piano di Andrea sito **ed email** del dominio (il piano resta:
   ospita anche drugolab.it).
4. ✅ Sul piano **Unlimited web hosting** di Alessio: sito vuoto, SSL Let's Encrypt
   (apex + www), casella `info@` gratuita.
5. ✅ Secret GitHub aggiornati: `FTP_SERVER=46.202.156.244`, `FTP_USERNAME`,
   `FTP_PASSWORD`, `FTP_TARGET_DIR=/domains/ferriristrutturazioni.com/public_html/`.
   - **Gotcha:** hPanel indica "public_html", ma l'utente FTP entra in
     `/public_html`, che NON è la web root. Il primo deploy (verde) è finito lì e
     online restava la Default page. Individuata la web root via listing FTP,
     rimossi i file caricati per errore e il `default.php` segnaposto.
   - Aggiunto `.claude/**` a `exclude`: `.claude/settings.local.json` veniva
     pubblicato anche sul vecchio server.
   - Verifica: 9 pagine 200 e md5 identiche, asset identici, file di build 403/404,
     redirect apex/index.html 301, 404 corretto, CSP/HSTS/X-Frame attivi.
6. Email: DNS di posta identici allo snapshot; l'MX accetta `info@` (250) e
   rifiuta indirizzi inesistenti (550). Mail esterna → **arrivata**. Form →
   **arrivato in Spam**: diagnosi in corso sulle intestazioni.

Effetto collaterale atteso: il TXT `google-site-verification` di Andrea non è
più nel DNS (la verifica regge sul meta tag in `index.html` fino al punto 4).

Da fare: fix spam del form, punto 4, rotazione credenziali (la password FTP è
stata scritta in chat), verbale e scheda credenziali.

## Riepilogo Post-Implementazione

Da compilare.

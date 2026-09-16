# Ferri Ristrutturazioni — sito web

Sito vetrina statico di **Impresa Edile Marco Ferri** (Frascati).
Online su <https://www.ferriristrutturazioni.com>.

Questo file è la memoria di progetto: Claude Code lo legge a ogni sessione.
Contiene le regole che, se ignorate, rompono il sito in modo **silenzioso** —
cioè senza errori visibili, il che è il modo peggiore.

---

## ⚠️ Regola numero uno

**Ogni `git push` sul branch `main` pubblica il sito online, entro un minuto.**

Non esiste un ambiente di prova. Non c'è nessuno che rilegge prima. Il push
*è* la pubblicazione (GitHub Actions → FTP su Hostinger).

Quindi: prima di pushare, apri le pagine modificate nel browser in locale
(basta un doppio click sul file `.html`) e guarda che siano a posto.

**Se qualcosa va storto dopo un push**, si torna indietro così:

```bash
git log --oneline -5        # trova il codice della modifica sbagliata
git revert <codice>         # crea una modifica che annulla quella
git push                    # ripubblica la versione buona
```

Non serve panico e non serve toccare niente su Hostinger: il sito torna com'era.

---

## Stack

HTML statico + **Tailwind CSS compilato** + JavaScript vanilla. Nessun
framework, nessun CMS, nessun database, nessuna build automatica.

- **9 pagine** `.html` nella cartella principale
- `assets/css/tailwind.css` — CSS generato da Tailwind (**44 KB, non si modifica a mano**)
- `assets/css/style.css` — stili scritti a mano (qui sì)
- `assets/css/fonts.css` + `assets/fonts/` — font self-hosted (Oswald, Roboto, Cormorant Garamond)
- `assets/js/main.js` — unico file JS: header allo scroll, menu mobile, animazione timeline
- `assets/img/` — immagini
- `send-mail.php` — riceve i form di contatto, invia a `info@ferriristrutturazioni.com`
- `.htaccess` — redirect, cache, header di sicurezza
- `sitemap.xml`, `robots.txt`, `404.html`

---

## Le 5 regole che evitano guai

### 1. Se aggiungi una classe Tailwind, devi ricompilare il CSS

Il CSS è **pre-generato**: contiene solo le classi già usate nel sito. Una
classe nuova (es. `bg-purple-500`) semplicemente **non esiste** nel file, quindi
non produce alcun effetto. La pagina sembra "non aggiornata" e non c'è nessun
errore a spiegarlo.

Dopo aver aggiunto o cambiato classi Tailwind nell'HTML:

```bash
npx tailwindcss -i input.css -o assets/css/tailwind.css --minify
```

Poi committa **anche** `assets/css/tailwind.css`, altrimenti online il sito
resta senza quello stile. Serve Node.js installato. Tailwind v3.4.

`input.css` e `tailwind.config.js` servono solo a questo comando: restano nel
repo ma non vengono pubblicati.

### 2. Aggiungere uno script esterno richiede di aggiornare la CSP

Il `.htaccess` contiene una **Content-Security-Policy** severa
(`default-src 'self'`): il browser blocca qualunque script, stile o immagine
proveniente da domini non autorizzati. Oggi la whitelist copre solo Iubenda,
unpkg (mappa Leaflet) e CartoCDN.

Quindi aggiungere Google Analytics, un widget di preventivi, una chat, un
pixel di Facebook **non funzionerà**: verrà bloccato in silenzio, visibile solo
nella console del browser.

Chi aggiunge lo script deve **contestualmente** aggiungere il dominio nella
direttiva giusta (`script-src`, `img-src`, `connect-src`…) dentro `.htaccess`.

### 3. Header e footer sono duplicati in 8 pagine

Non c'è nessun sistema di template: il menu di navigazione e il footer sono
copiati per intero in ogni pagina. Un cambio al menu, a un numero di telefono,
alla P.IVA o a una voce del footer va replicato in **tutte le 8 pagine**
(`404.html` ha un layout ridotto).

Prima di dire che una modifica del genere è finita, verifica:

```bash
grep -l "<testo che hai cambiato>" *.html    # devono comparire tutte le pagine attese
```

### 4. Il sito è dietro una CDN: la verifica va fatta aggirando la cache

Dopo un aggiornamento, una richiesta normale può restituire ancora la versione
vecchia (la serve la CDN, non il sito). Per vedere il risultato reale aggiungi
un parametro qualsiasi:

```bash
curl -sS -o /dev/null -w "%{http_code}\n" "https://www.ferriristrutturazioni.com/pagina.html?cb=123"
```

Gli header `x-hcdn-cache-status: HIT` e `age:` indicano che stai leggendo la
cache. Ci sono più server CDN con cache indipendenti, quindi due richieste
identiche possono dare risposte diverse: non è un bug del sito.

**Corollario importante sulle immagini:** hanno cache di un anno
(`immutable`). Sostituire un'immagine **mantenendo lo stesso nome file**
significa che i visitatori continueranno a vedere la vecchia. Usa un nome
nuovo, oppure svuota la cache CDN dal pannello Hostinger.

### 5. Una pagina nuova va aggiunta alla sitemap

`sitemap.xml` è scritto a mano e oggi elenca 8 URL (tutte tranne la 404).
Creando una pagina nuova va aggiunta lì, altrimenti Google fatica a trovarla.
Vanno curati anche `<title>`, meta description e il link `canonical`, che ogni
pagina ha già impostati — copiali da una pagina esistente come modello.

---

## Come si pubblica una modifica

```bash
git add .
git commit -m "descrizione di cosa è cambiato"
git push
```

Poi attendi ~1 minuto e verifica con il metodo della regola 4.
Lo stato della pubblicazione si vede su GitHub, scheda **Actions**: spunta
verde = pubblicato, croce rossa = **non** pubblicato (aprila e leggi l'errore).

Se la pubblicazione fallisce con `Timeout (control socket)`, il problema è
l'indirizzo del server FTP salvato nei segreti del repository, non il codice:
va rimesso l'**IP di origine** del server (lo si trova in Hostinger → File →
Account FTP), mai il nome del dominio, che punta alla CDN dove l'FTP non
risponde.

Se invece la pubblicazione è **verde ma online non cambia niente**, i file sono
finiti nella cartella sbagliata. L'utente FTP entra in `/public_html`, che
**non** è la cartella del sito: il sito sta in
`/domains/ferriristrutturazioni.com/public_html/` (è il valore del segreto
`FTP_TARGET_DIR`). L'etichetta "public_html" che mostra hPanel trae in inganno.

---

## Cose da non toccare senza sapere cosa si fa

- **`assets/css/tailwind.css`** — generato, ogni modifica a mano viene persa alla ricompilazione
- **`.htaccess`** — redirect, sicurezza e cache; un errore di sintassi qui rende **tutto** il sito irraggiungibile
- **`send-mail.php`** — l'indirizzo di destinazione dei form è dentro questo file
- **`.ftp-deploy-sync-state.json`** sul server — lo usa la pubblicazione automatica per capire cosa aggiornare

Nota: togliere un file dalla lista `exclude` del workflow **non lo cancella**
dal server. Per rimuovere davvero un file già pubblicato serve eliminarlo dal
repository con `git rm` e pushare.

---

## Servizi esterni collegati

| Servizio | A cosa serve |
|---|---|
| **Hostinger** | dominio, hosting, casella `info@ferriristrutturazioni.com`, CDN |
| **GitHub Actions** | pubblicazione automatica via FTP a ogni push |
| **Iubenda** | privacy policy e banner cookie |
| **Leaflet** (unpkg) + **CartoCDN** | mappa nella pagina Contatti |
| **Google Search Console** | monitoraggio presenza su Google (verifica già inserita nelle pagine) |

Il sito **non ha nessuno strumento di statistiche installato** (né Google
Analytics né altro): al momento non è possibile sapere quanti visitatori
arrivano o quanti compilano il form. Se serve, va aggiunto — ricordando la
regola 2 sulla CSP.

---

## Sicurezza

Password e credenziali (FTP, casella di posta, pannello Hostinger) **non vanno
mai scritte in questo repository**, nemmeno dentro un commento o un file di
appunti: il repository è condivisibile e la cronologia conserva tutto per
sempre. Le credenziali della pubblicazione automatica stanno nei *Secrets* di
GitHub (Settings → Secrets and variables → Actions), che nessuno può rileggere
dopo averli inseriti.

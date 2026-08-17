# Pulizia File di Sviluppo Pre-Consegna

**Data:** 2026-08-17
**Contesto:** preparazione della consegna del sito al cliente (Impresa Edile Marco Ferri).

## Problema rilevato

Verifica live su `https://www.ferriristrutturazioni.com/`: file di lavorazione
raggiungibili pubblicamente e indicizzabili.

| File | HTTP pre-fix | Perché va rimosso |
|---|---|---|
| `index-wip.html` | 200 | Vecchia pagina "Work In Progress" ancora online |
| `tmp_reflog.txt` | 200 | Dump del reflog git, espone i messaggi di commit interni |
| `package.json` | 200 | Nome progetto e dipendenze di build |
| `package-lock.json` | 200 | Idem |
| `input.css` | 200 | Sorgente Tailwind, inutile in produzione |
| `tailwind.config.js` | 200 | Config di build |
| `.ftp-deploy-sync-state.json` | 200 | Stato di FTP-Deploy-Action: elenca tutti i file del server |

Nessun link interno puntava a `index-wip.html` o `tmp_reflog.txt`, e non
comparivano in `sitemap.xml` (verificato via grep).

## Modifiche pianificate

1. `git rm index-wip.html tmp_reflog.txt` — rimossi dal repo; FTP-Deploy-Action
   li cancella anche dal server al deploy successivo (il file di stato
   `.ftp-deploy-sync-state.json` esiste già sul server, quindi il diff produce
   una DELETE e non un full-upload).
2. `.github/workflows/deploy-static-site.yml` — aggiunti alla lista `exclude`:
   `package.json`, `package-lock.json`, `input.css`, `tailwind.config.js`.
   Restano nel repo (servono alla build) ma non vengono più pubblicati.
3. `.htaccess` — blocco in lettura di `.ftp-deploy-sync-state.json`. Non è
   cancellabile: l'action lo usa come stato di sincronizzazione fra un deploy e
   il successivo, quindi si nega l'accesso invece di rimuoverlo.

## Verification Plan

Dopo il push su `main` e il completamento del workflow:

- I 7 file sopra devono rispondere **404** (o **403** per il file di stato).
- Le 7 pagine del sito (`/`, `chi-siamo`, `servizi`, `progetti`, `contatti`,
  `ristrutturazioni-frascati`, `404`) devono restare **200** e md5-identiche
  alla copia locale.
- Redirect no-www → www e http → https invariati.

Verifica solo via HTTP (`curl`), nessun check visuale automatizzato sul browser.

## Riepilogo Post-Implementazione

### Problema bloccante emerso: pipeline di deploy rotta

Il primo push (`4d95502`) ha fatto **fallire** il workflow con
`Error: Timeout (control socket)` — "Failed to connect, are you sure your
server works via FTP or FTPS?".

Causa individuata: il sito è stato messo dietro la **CDN di Hostinger**
(header di risposta `server: hcdn`, `x-hcdn-request-id`). Di conseguenza:

- `www.ferriristrutturazioni.com` → `...cdn.hstgr.net` → `84.32.84.130`, **porta 21 chiusa**
- l'origine FTP reale è `82.198.227.57` (= `ftp.ferriristrutturazioni.com`),
  porta 21 aperta e sana (risponde `220 FTP Server ready.`)

Il secret `FTP_SERVER` puntava a un hostname che oggi risolve sull'edge della
CDN. I 4 secret FTP non erano mai stati modificati dal 24/02 e l'ultimo deploy
riuscito era del **25/04** (`8060a97`): la rottura è avvenuta lato Hostinger ed
è rimasta invisibile per mesi, non essendoci stati push nel frattempo.

**Fix:** `FTP_SERVER` = `82.198.227.57` (IP nudo, senza schema `ftp://`).
`FTP_USERNAME`, `FTP_PASSWORD` e `FTP_TARGET_DIR` **non** sono stati toccati:
erano corretti e sovrascriverli alla cieca era rischioso (i secret GitHub sono
write-only, il valore precedente non è recuperabile).

Valori di riferimento da hPanel: host `82.198.227.57`, utente `u850674815`,
porta 21, cartella di upload `public_html`.

### Esito della pulizia

| File | Prima | Dopo |
|---|---|---|
| `index-wip.html` | 200 | **404** ✅ rimosso dal server |
| `tmp_reflog.txt` | 200 | **404** ✅ rimosso dal server |
| `.ftp-deploy-sync-state.json` | 200 | **403** ✅ bloccato da `.htaccess` |
| `package.json` | 200 | **403** ✅ all'origine |
| `package-lock.json` | 200 | **403** ✅ all'origine |
| `input.css` | 200 | **403** ✅ all'origine |
| `tailwind.config.js` | 200 | **403** ✅ all'origine |

**Attenzione alla CDN in fase di verifica:** subito dopo il deploy alcuni di
questi file rispondevano ancora 200. Non era un fallimento della regola: erano
copie servite dalla cache dell'edge (`x-hcdn-cache-status: HIT`, `age: 23` e
`age: 1410`). Interrogando gli stessi URL con un parametro anti-cache
(`?cb=<random>`) tutti rispondono **403**, cioè la regola è attiva
all'origine. Gli edge Hostinger sono più d'uno (`int-edge3`, `int-edge5`,
`int-edge6`) e hanno cache indipendenti: un singolo `curl` può colpirne uno
caldo e uno freddo a richieste consecutive, dando risultati contraddittori.

**Azione residua:** svuotare la cache CDN da hPanel per non aspettare la
scadenza naturale (`max-age=2592000`, 30 giorni).

**Gotcha rilevato:** inserire un file nella lista `exclude` di
FTP-Deploy-Action **non lo cancella dal server** — l'action lo ignora
semplicemente, quindi un file già pubblicato resta online per sempre. Solo la
rimozione dal repo (`git rm`) produce una DELETE via FTP. Per i 4 file di
build già presenti sul server si è quindi aggiunta una regola `<FilesMatch>`
in `.htaccess` che nega l'accesso. Restano fisicamente su disco: volendo si
possono eliminare a mano dal File Manager di Hostinger.

### Verifica finale

Le 9 pagine del sito restano **200** e **md5-identiche** alla copia locale
dopo il deploy. Redirect no-www→www, http→https e `/index.html`→`/` invariati.

### Nota per la consegna

Gli asset hanno `Cache-Control: max-age=31536000, immutable` e ora passano da
una CDN: sostituendo un'immagine **con lo stesso nome file**, l'edge può
continuare a servire la versione vecchia a lungo. Usare un nome nuovo, oppure
svuotare la cache CDN da hPanel. L'HTML non è interessato (`no-cache`,
confermato da `x-hcdn-cache-status: DYNAMIC`).

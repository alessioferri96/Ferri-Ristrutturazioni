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

_(da compilare dopo il deploy)_

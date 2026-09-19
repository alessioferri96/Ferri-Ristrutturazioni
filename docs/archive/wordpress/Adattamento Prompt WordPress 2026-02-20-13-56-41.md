# Documento di Progetto: Adattamento Prompt Tema WordPress

## Obiettivo
Adattare un prompt preesistente per guidare la conversione del sito statico "Ferri Ristrutturazioni" in un tema WordPress custom, tenendo conto delle specificità del progetto, dei file HTML esistenti e degli asset.

## Dettagli dell'Implementazione
Il prompt verrà personalizzato includendo riferimenti esatti alla struttura del nostro progetto:
1. **Riferimenti ai file HTML specifici:** `index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html`, `contatti.html` e `404.html`.
2. **Gestione degli Asset:** Istruzioni precise su come indirizzare le risorse presenti in `/assets/css/style.css`, `/assets/js/main.js` e le cartelle immagini (`/assets/img/`, `/loghi/`) utilizzando le funzioni native di WordPress (`get_template_directory_uri()`).
3. **Template Hierarchy:** Definizione chiara di quali file PHP dovranno essere generati per i vari template (es. `front-page.php`, `template-chi-siamo.php`, `home.php`, `single.php`, ecc.).
4. **Tailwind CSS:** Conferma del mantenimento delle classi utility e delle istruzioni per l'accodamento in `functions.php`.

## Fasi Previste (Post-Approvazione)
1. **Generazione del Prompt:** Fornirò il prompt finale, revisionato e adattato per il progetto Ferri Ristrutturazioni.
2. **Esecuzione (Input File HTML):** Attenderò i file HTML da parte tua (o procederò a leggerli direttamente, a seconda di come vorremo gestire il flusso) per iniziare la generazione effettiva dei file PHP (`header.php`, `footer.php`, `functions.php` e i vari template di pagina) blocco per blocco.

## Riepilogo Post-Implementazione
- **Stato:** Completato con successo.
- **Azioni Eseguite:** Sono stati creati tutti i file essenziali per il tema WordPress custom (style.css, functions.php, header.php, footer.php) e convertiti i template (`front-page.php`, `template-chi-siamo.php`, `template-servizi.php`, `template-contatti.php`, `404.php`, `template-progetti.php`, `single.php`). Tutte le sezioni chiave, l'integrazione CSS (Tailwind) e JS sono native per WP.
- **Note:** Tema pronto per l'ambiente di test/staging in locale.


# Documento di Progetto: Riconfigurazione GitHub per Sito Statico

## Obiettivo
L'utente ha deciso di non procedere con la migrazione a WordPress. L'obiettivo è configurare il deploy automatico del sito statico (HTML, CSS, JS) direttamente dalla root del progetto al server di hosting tramite GitHub Actions.

## User Review Required
> [!IMPORTANT]
> Il deploy automatico sovrascriverà i file sul tuo host direttamente dalla cartella root del repository GitHub. Assicurati che le credenziali FTP (`FTP_SERVER`, `FTP_USERNAME`, `FTP_PASSWORD`) e la cartella di destinazione (`FTP_TARGET_DIR`) siano aggiornate su GitHub Secrets per puntare alla root del tuo sito (es. `public_html/` o `httpdocs/`).

## Proposed Changes

### GitHub Actions
#### [MODIFY] [deploy-wp-theme.yml](file:///c:/Users/andre/OneDrive/Desktop/Progetti/Ferri%20Ristrutturazioni/.github/workflows/deploy-wp-theme.yml) (Verrà rinominato o aggiornato in `deploy-static-site.yml`)
- Modifica del trigger: non più limitato alla cartella `ferri-theme/`.
- Modifica della cartella locale di origine: dalla sottocartella `ferri-theme/` alla cartella root `./`.
- Esclusione dei file non necessari al sito live (es. cartella `ferri-theme/`, `.git`, `.github`, `docs/`, `task.md`, ecc.).

### Struttura Progetto
#### [KEEP] File Statici
- `index.html`
- `chi-siamo.html` (e `chi-siamo2.html` se da tenere)
- `servizi.html` (e `servizi2.html` se da tenere)
- `progetti.html`
- `contatti.html`
- `assets/`
- `loghi/`
- `404.html`

#### [IGNORE] File WordPress (nella cartella `ferri-theme/`)
- Questi file non verranno caricati sul server.

## Verification Plan

### Automated Tests
- Verifica sintassi YAML del nuovo file workflow.
- Esecuzione manuale (o via push) del workflow per testare la connessione FTP.

### Manual Verification
- Verifica che il sito sia navigabile correttamente all'indirizzo del tuo host dopo il deploy.
- Controllo che i link tra le pagine funzionino (es. passaggi tra index, chi-siamo, ecc.).

## Riepilogo Post-Implementazione
- **Stato:** Completato con successo.
- **Azioni Eseguite:**
    - Rimossa la cartella `ferri-theme/` (WordPress).
    - Rimossi i file duplicati `chi-siamo2.html` e `servizi2.html`.
    - Archiviata la documentazione WordPress obsoleta in `docs/archive/wordpress`.
    - Riconfigurato il workflow GitHub Actions in `.github/workflows/deploy-static-site.yml` per caricare i file dalla root `./` ed escludere file non necessari.
- **Note:** Il sistema è ora ottimizzato per un sito statico puro con deploy automatico su ogni push al branch `main`.

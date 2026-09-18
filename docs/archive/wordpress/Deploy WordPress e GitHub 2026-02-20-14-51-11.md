# Guida e Piano di Implementazione: Deploy Tema su WordPress e Integrazione GitHub

## 1. Come caricare il tema appena generato su WordPress (Metodo Manuale)
Questa è la procedura standard per installare il tema la prima volta o per testarlo in locale/su un server di staging:
1. **Comprimi il tema:** Vai nella cartella del progetto, clicca col tasto destro sulla cartella `ferri-theme` e comprimila in un archivio `.zip` (il file diventerà `ferri-theme.zip`).
2. **Accedi a WordPress:** Entra nella bacheca del tuo sito WordPress (es. `tuosito.it/wp-admin`).
3. **Installa il tema:** Naviga nel menu laterale su **Aspetto > Temi**. Clicca sul pulsante in alto **Aggiungi nuovo** e poi su **Carica tema**.
4. **Attiva:** Seleziona il file `ferri-theme.zip`, clicca su "Installa ora" e, al termine, clicca su **Attiva**.
5. **Assegna i Template:** Ora vai nelle tue Pagine WP (es. "Chi Siamo"), modificale e nella barra laterale destra, sotto "Attributi della pagina", seleziona il relativo "Template" (es. "Chi Siamo").


## 2. Come collegare GitHub a WordPress per il Deploy Automatico (CI/CD)
Per fare in modo che ogni modifica fatta da Antigravity (e pushata su GitHub) si aggiorni in automatico sul tuo sito WordPress in produzione, utilizzeremo le **GitHub Actions** via FTP. 

Non serve installare plugin pesanti su WordPress; sarà GitHub, ogni volta che riceve una modifica, a collegarsi al tuo hosting e sovrascrivere i file del tema.

### Piano di Implementazione (Cosa farò dopo la tua approvazione)
Creerò un file di automazione (Workflow) all'interno del progetto.

**File da creare:** `.github/workflows/deploy-wp-theme.yml`
**Cosa farà il file:**
- Ascolterà ogni `git push` effettuato sul branch principale (`main`).
- Prenderà **esclusivamente** il contenuto della cartella `ferri-theme` (evitando di caricare file sorgenti inutili per WP come i vecchi HTML statici).
- Si collegherà via FTP al tuo server usando le credenziali segrete custodite su GitHub.
- Caricherà e sovrascriverà i file del tema nella cartella di destinazione corretta di WordPress: `/wp-content/themes/ferri-theme/`.

### Requisiti lato tuo (GitHub Secrets)
Per far funzionare l'automazione, dovrai inserire le credenziali FTP del tuo hosting WP nelle impostazioni segrete di GitHub (Settings > Secrets and variables > Actions), creando questi 3 segreti:
- `FTP_SERVER` (es. ftp.tuosito.it)
- `FTP_USERNAME` (es. admin@tuosito.it)
- `FTP_PASSWORD` (la tua password FTP)
- `FTP_TARGET_DIR` (opzionale, es. `public_html/wp-content/themes/ferri-theme/`)


## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Note:** Il file `.github/workflows/deploy-wp-theme.yml` è stato creato in precedenza con successo. Con le variabili segrete appena inserite, il deploy automatico via FTP partirà automaticamente al prossimo `git push`.

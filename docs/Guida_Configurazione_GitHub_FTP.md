# Guida alla Configurazione dei Segreti GitHub per il Deploy

Per attivare il deploy automatico del sito via FTP, GitHub ha bisogno delle credenziali del tuo server. Queste informazioni **non** devono mai essere scritte nel codice, ma salvate in modo sicuro come "Secrets" (Segreti) nella repository GitHub.

## 1. Recuperare le Credenziali FTP

Le credenziali FTP si trovano solitamente nel pannello di controllo del tuo hosting (es. Aruba, SiteGround, cPanel, Plesk).

Cerca una sezione chiamata:
*   **Gestione FTP**
*   **Account FTP**
*   **Accesso File**

Dovrai annotare tre informazioni:

1.  **Host / Server**: Spesso è il nome del tuo dominio (es. `ferriristrutturazioni.it`) o un indirizzo specifico (es. `ftp.ferriristrutturazioni.it` o un indirizzo IP come `89.123.45.67`).
2.  **Username**: Il nome utente per l'accesso FTP (es. `admin@ferriristrutturazioni.it` o `u12345678`).
3.  **Password**: La password associata a quell'utente FTP.
    *   *Nota: Se non la ricordi, spesso puoi reimpostarla o crearne una nuova creando un nuovo account FTP dedicato.*

## 2. Inserire le Credenziali su GitHub

Una volta che hai i dati, vai sulla pagina della tua repository su GitHub:
`https://github.com/Drugo84-Dev/Ferri-Ristrutturazioni`

1.  Clicca sulla scheda **Settings** (Impostazioni) in alto a destra.
2.  Nella barra laterale sinistra, scorri fino a trovare **Secrets and variables** e clicca per espandere il menu.
3.  Clicca su **Actions**.
4.  Nella pagina che si apre, clicca sul pulsante verde **New repository secret** (in alto a destra).

### Aggiungi i 3 Segreti:

Ripeti questa procedura per ognuna delle seguenti variabili:

*   **Nome**: `FTP_SERVER`
    *   **Valore**: L'indirizzo del server (es. `ftp.tuisito.it`)
    *   Clicca **Add secret**.

*   **Nome**: `FTP_USERNAME`
    *   **Valore**: Il tuo username FTP.
    *   Clicca **Add secret**.

*   **Nome**: `FTP_PASSWORD`
    *   **Valore**: La tua password FTP.
    *   Clicca **Add secret**.

*   **Nome**: `FTP_TARGET_DIR` (Opzionale ma consigliato)
    *   **Valore**: La cartella dove vuoi caricare i file.
    *   Se vuoi caricare nella root del sito: `/` o `/public_html/`
    *   Se stai caricando un tema WordPress: `/wp-content/themes/ferri-ristrutturazioni/`

## 3. Verifica

Fatto questo, al prossimo "Push" (caricamento di codice) su GitHub, o se riesegui manualmente l'ultimo workflow fallito, GitHub userà queste credenziali per collegarsi al tuo server e caricare i file modificati.

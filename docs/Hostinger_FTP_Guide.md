# Guida Configurazione FTP su Hostinger (hPanel)

## 0. Prerequisiti: Non hai ancora un Sito?

Assolutamente sì, **devi creare un "Sito Web"** nel tuo pannello Hostinger prima di poter avere un accesso FTP.

### Come Creare il Tuo Sito (e WordPress):
1.  Vai alla **Home** di hPanel.
2.  Clicca su **Crea o migra un sito web**.
3.  Seleziona **Crea un nuovo sito**.
4.  Ti chiederà la piattaforma: Scegli **WordPress** (dato che il tuo obiettivo finale è avere il sito su WordPress).
    *   Crea un account amministratore WordPress (salva user e password!).
    *   Scegli i plugin (puoi saltare questo passaggio).
    *   Scegli il tema (puoi saltare o sceglierne uno a caso, tanto poi caricheremo il nostro).
5.  **Collega il Dominio**:
    *   Se hai già comprato `ferriristrutturazioni.it`, selezionalo.
    *   Se non lo hai, puoi usare un dominio temporaneo gratuito offerto da Hostinger per testare.
6.  Termina il setup e attendi.

---

## 1. Recupera le Credenziali FTP

Una volta che il sito è creato e attivo nella Dashboard:

1.  Vai su **Siti Web** e clicca su **Gestisci** (Manage) sul sito appena creato.
2.  Nel menu a sinistra cerca **File** > **Account FTP**.

Dovrai annotare tre informazioni:

*   **FTP Hostname**: (es. `ftp.tuodominio.it` o IP) -> Va in GitHub Secret `FTP_SERVER`
*   **FTP Username**: (es. `u123456789`) -> Va in GitHub Secret `FTP_USERNAME`
*   **FTP Password**:
    *   Se non la sai, clicca "Modifica password" per crearne una nuova -> Va in GitHub Secret `FTP_PASSWORD`

## 2. Inserire le Credenziali su GitHub

Vai su GitHub > Settings > Secrets and variables > Actions > New repository secret.
Inserisci i 3 segreti sopra.

## 3. Destinazione (`FTP_TARGET_DIR`)

Dato che hai installato WordPress:
*   Il tuo obiettivo sarà caricare il codice come un **Tema**.
*   Imposta il segreto `FTP_TARGET_DIR` su: `/public_html/wp-content/themes/ferri-ristrutturazioni`
    *(Nota: Non mettere lo slash finale se non sei sicuro, ma di solito `/` all'inizio serve)*.

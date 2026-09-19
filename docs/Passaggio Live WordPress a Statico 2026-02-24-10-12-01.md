# Documento di Progetto: Passaggio da WordPress a Sito Statico (Live)

## Obiettivo
Sostituire completamente l'installazione di WordPress attualmente online sul server con la versione statica gestita tramite GitHub.

## User Review Required
> [!CAUTION]
> Questa operazione comporterà la rimozione definitiva dei file di WordPress dal server. Assicurati di avere un backup se pensi che ti serviranno i dati del database o i vecchi caricamenti (upload).

## Proposed Changes

### 1. Configurazione Server (Azione Manuale consigliata)
Per una pulizia profonda, suggerisco di accedere tramite **File Manager (Hostinger)** o **FTP (FileZilla)** e rimuovere:
- Le cartelle: `wp-admin`, `wp-content`, `wp-includes`.
- I file di core: `index.php`, `wp-config.php`, `wp-load.php`, `wp-settings.php`, `xmlrpc.php`, `wp-cron.php`.
- Altri file WP: `wp-activate.php`, `wp-blog-header.php`, `wp-comments-post.php`, `wp-config-sample.php`, `wp-links-opml.php`, `wp-login.php`, `wp-mail.php`, `wp-signup.php`, `wp-trackback.php`, `license.txt`, `readme.html`.

### 2. Priorità File Index
#### [MODIFY] [.htaccess](file:///c:/Users/andre/OneDrive/Desktop/Progetti/Ferri%20Ristrutturazioni/.htaccess)
Aggiungeremo una direttiva per essere certi che il server legga `index.html` invece di eventuali rimasugli di `index.php`.

### 3. Deploy GitHub Actions
Una volta fatta pulizia sul server (o anche prima), effettueremo un "Push" su GitHub. Il workflow `deploy-static-site.yml` caricherà tutti i file HTML, CSS e JS nella root.

## Verification Plan

### Manual Verification
1.  Accedere al dominio principale (es. `ferriristrutturazioni.it`).
2.  Verificare che venga visualizzata la nuova Home statica.
3.  Navigare nelle pagine "Chi Siamo", "Servizi", ecc. e controllare che i link non puntino a vecchi URL di WordPress (es. non devono esserci `/wordpress/` o query string `?p=123`).

## Riepilogo Post-Implementazione
- **Stato:** Completato con successo.
- **Azioni Eseguite:**
    - Aggiornato `.htaccess` per priorità `index.html`.
    - L'utente ha svuotato la cartella `public_html` sul server rimuovendo ogni traccia di WordPress.
    - Deploy automatico tramite GitHub Actions configurato e attivato.
- **Risultato:** Il sito statico è ora l'unica versione presente e attiva sul server.

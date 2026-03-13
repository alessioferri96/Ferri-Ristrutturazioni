# Documento di Progetto: Riconfigurazione su Nuova Installazione

## Obiettivo
L'utente intende creare una nuova configurazione/sito su Hostinger per risolvere i problemi di persistenza del vecchio sito WordPress e assicurare un deploy pulito della versione statica.

## User Review Required
> [!IMPORTANT]
> Se crei un nuovo sito o sottodominio su Hostinger, le credenziali FTP potrebbero cambiare. Dovrai verificare e aggiornare i segreti su GitHub se necessario.
> 
> [!TIP]
> Per essere sicuri della directory, una volta creato il nuovo spazio, carica manualmente un file `test.html` tramite il File Manager e verifica se è raggiungibile via browser. Quella sarà la nostra `FTP_TARGET_DIR`.

## Proposed Changes

### GitHub Secrets
#### [UPDATE] GitHub Actions Secrets
- `FTP_SERVER`: (Se nuovo host)
- `FTP_USERNAME`: (Se nuovo utente)
- `FTP_PASSWORD`: (Se nuova password)
- `FTP_TARGET_DIR`: La nuova directory radice (es. `public_html/` o `iltuodominio.it/public_html/`).

### GitHub Actions
#### [VERIFY] [deploy-static-site.yml](file:///c:/Users/andre/OneDrive/Desktop/Progetti/Ferri%20Ristrutturazioni/.github/workflows/deploy-static-site.yml)
- Assicurarsi che punti ancora alla root locale `./`.

## Verification Plan

### Manual Verification
1.  Creazione del nuovo ambiente su Hostinger.
2.  Test manuale di raggiungibilità della cartella.
3.  Aggiornamento segreti su GitHub.
4.  Esecuzione manuale del workflow tramite pulsante "Run workflow" in GitHub Actions.
5.  Verifica visiva del sito.

## Riepilogo Post-Implementazione
*Da compilare a fine lavori*

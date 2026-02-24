# Documento di Progetto: Implementazione Iubenda (Privacy & Cookie Policy)

## Obiettivo
Integrare Iubenda nel sito statico per garantire la conformità al GDPR, gestendo il banner dei cookie, il salvataggio dei consensi e i link legali a Privacy Policy e Cookie Policy.

## Strategia e Origine Dati
Poiché il sito deriva da una precedente installazione WordPress e la vecchia cartella del tema non esiste più sul server, **è necessario recuperare i nuovi codici di embed direttamente dalla dashboard di Iubenda**.

## User Review Required
> [!IMPORTANT]
> Non essendo presenti backup dei file WordPress con gli script, ho bisogno che tu acceda a Iubenda e mi comunichi:
> 1.  Lo **Script della Cookie Solution** (quello lungo da mettere nell'header).
> 2.  I **Link/Script per le Policy** da inserire nel footer (Privacy Policy e Cookie Policy).
> Forniscimi questi codici qui in chat.

## Proposed Changes
### Fase 1: Inserimento Script Iubenda Header
- Aggiunta dello script fornito dall'utente prima della chiusura del tag `<head>` (o subito dopo l'apertura) in: `index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html`, `contatti.html`.

### Fase 2: Integrazione negli HTML (se script trovati)
1. **Header (`<head>`)**: Aggiungere lo script principale di Iubenda (Cookie Solution) prima degli altri script in `index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html`, `contatti.html`.
2. **Footer (`<footer>`)**: Sostituire i placeholder dei link "Privacy Policy" e "Cookie Policy" (attualmente puntati a `404.html`) con le classi e gli URL generati da Iubenda.

## Verification Plan
1. Verificare l'apparizione del banner cookie in fondo allo schermo caricando il sito in locale o su live.
2. Controllare che il blocco preventivo dei cookie funzioni (se configurato in Iubenda).
3. Verificare che cliccando sui link nel footer si aprano le modali/pagine previste da Iubenda.

## Riepilogo Post-Implementazione
*Da compilare a fine lavori*

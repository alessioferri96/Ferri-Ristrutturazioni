# Documento di Progetto: Risoluzione Glitch Background Parallax Mobile

## Obiettivo
Risolvere il problema del ridimensionamento continuo ("saltello/scatto") dell'immagine di sfondo nella sezione Contatti durante lo scorrimento della pagina, specifico per dispositivi mobili.

## Analisi del Problema
L'effetto parallax è ottenuto tramite la classe Tailwind `bg-fixed` (`background-attachment: fixed`) combinata a `bg-cover`. 
Sui browser mobili (come Safari su iOS e Chrome su Android), l'apertura o la chiusura della barra degli indirizzi altera l'altezza della "viewport". Poiché lo sfondo è "fisso" rispetto alla viewport, il browser è costretto a ricalcolare e ridimensionare l'immagine costantemente durante lo scroll, causando questo fastidioso sfarfallio.

## Proposed Changes
> [!TIP]
> La best practice moderna per risolvere questo difetto sui dispositivi mobili, preservando le performance e la pulizia del rendering, è disattivare `background-attachment: fixed` sugli schermi piccoli, mantenendolo attivo solo da tablet/desktop in su.

### Modifiche CSS (Tailwind Classes)
Sostituiremo la classe `bg-fixed` con `bg-scroll md:bg-fixed` in tutte le occorrenze della Contact Form Section nei file HTML.
- **bg-scroll:** Lo sfondo si muoverà normalmente insieme alla pagina su mobile (nessun ricalcolo).
- **md:bg-fixed:** Ripristina il bellissimo effetto parallax su schermi larghi almeno 768px (Tablet, PC), dove il problema delle barre a scomparsa non esiste.

#### Elenco file da modificare
- `index.html`
- `chi-siamo.html`
- `servizi.html`
- `progetti.html`
- `contatti.html`

## Verification Plan
1. Applicazione delle modifiche via sostituzione testo.
2. Esecuzione del command git push per aggiornare il repository.
3. Test finale dall'utente live tramite smartphone per verificare la fluidità.

## Riepilogo Post-Implementazione
*Da compilare a fine lavori*

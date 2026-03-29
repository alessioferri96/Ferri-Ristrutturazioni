# Lightbox Responsive Mobile/Tablet

**Data:** 2026-03-29
**Tipo:** Fix responsività

## Descrizione

Ridisegno completo del lightbox gallery nelle pagine progetto per risolvere problemi di usabilità su mobile e tablet: immagini troppo piccole, difficoltà nella navigazione e nella chiusura.

## Problema

- Container fisso a 70vw rendeva le immagini minuscole su schermi piccoli
- Frecce di navigazione ai lati dell'immagine rubavano spazio utile
- Pulsante chiudi (X) nascosto accanto alla freccia destra, difficile da trovare
- Nessun supporto per gesture touch (swipe)

## Soluzione

### Layout fullscreen
- Container da `width:70vw` a `inset:0` (fullscreen)
- Sfondo da `rgba(0,0,0,0.85)` a `rgba(0,0,0,0.95)`
- Immagine massimizzata con padding minimo (16px laterali, 60px top/bottom)

### Navigazione ridisegnata
- **X chiudi**: riposizionata in alto a destra con `position:absolute`, area tap generosa (padding 8px + icona 32px)
- **Frecce**: overlay circolare semitrasparente sui bordi dell'immagine, non rubano più spazio
- **Contatore**: posizionato in basso al centro con `position:absolute`

### Supporto touch
- Swipe sinistra/destra per navigare tra le immagini (soglia 50px)
- Swipe verso il basso per chiudere il lightbox (soglia 80px)
- Click/tap sullo sfondo per chiudere (non sull'immagine)
- Listener `passive: true` per performance ottimale

## File modificati
- `progetto-locale-frascati.html`
- `progetto-residenza-grottaferrata.html`

## Verification Plan
- Verifica visiva a cura dell'utente su mobile, tablet e desktop

- Implementazione completata con successo

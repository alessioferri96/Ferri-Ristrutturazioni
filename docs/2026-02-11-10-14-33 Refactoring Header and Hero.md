# Refactoring Header and Hero for Strict Adherence

## Obiettivo
Rifattorizzare le sezioni Header e Hero di `index.html` per replicare fedelmente la struttura e il design del sito di riferimento (Scape Construct), come definito nei file `resources/html.txt` e `resources/Built To Work.png`.

## Analisi Comparativa

### Header (Riferimento vs Attuale)
*   **Riferimento**:
    *   Sticky Header con transizione (trasparente -> solido).
    *   Logo a sinistra.
    *   Menu di navigazione centrale/destra con hover effects specifici (sottolineatura e cambio colore).
    *   Icona di ricerca (lente d'ingrandimento) a destra.
    *   Toggle menu mobile (hamburger) visibile solo su mobile.
    *   Classi Elementor: `elementor-sticky`, `elementor-nav-menu`, ecc.
*   **Attuale**:
    *   Header sticky base.
    *   Struttura semplificata.
    *   Mancano alcuni dettagli di interazione e spacing precisi.

### Hero (Riferimento vs Attuale)
*   **Riferimento**:
    *   Slider di sfondo (Slideshow) con transizione `fade`.
    *   Titolo "BUILT TO WORK" (o simile) con font `Lemon Milk` (o alternativo `Oswald`).
    *   Sottotitolo descrittivo.
    *   Pulsanti CTA ("Scopri di più", ecc.).
    *   Overlay scuro per leggibilità.
    *   Parte inferiore con "breadcrumbs" o indicatori (opzionale, da verificare).
*   **Attuale**:
    *   Immagine statica di sfondo.
    *   Titolo e CTA presenti ma con styling da rifinire.

## Piano di Implementazione

### 1. Header Refactoring
*   [ ] Aggiornare la struttura HTML per rispecchiare `html.txt` (usando classi Tailwind equivalenti ove possibile, ma mantenendo la nidificazione logica).
*   [ ] Implementare logica JS per sticky header (cambio background on scroll).
*   [ ] Affinare lo stile del menu (desktop e mobile) per matchare il PNG.
*   [ ] Aggiungere l'icona di ricerca (funzionale o mockup visivo).

### 2. Hero Refactoring
*   [ ] Implementare slideshow di sfondo (anche con immagini placeholder, ma con la logica corretta).
*   [ ] Aggiornare tipografia e spacing del titolo e sottotitolo.
*   [ ] Aggiungere overlay corretti (gradiente o solid color con opacity).

## Verifica
*   Confronto visivo diretto con `resources/Built To Work.png`.
*   Verifica funzionalità sticky header.
*   Verifica responsiveness (mobile/tablet/desktop).

## Riepilogo Post-Implementazione
*(Da compilare a fine lavori)*

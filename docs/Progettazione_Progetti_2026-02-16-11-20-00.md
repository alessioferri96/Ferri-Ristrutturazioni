# Progetto: Pagina Progetti - Immersive Slider (Approved)

**Data:** 2026-02-16
**Concept Selezionato:** #2 (Immersive Slider).
**Obiettivo:** Creare un portfolio ad alto impatto visivo dove ogni progetto è protagonista.

---

## Dettagli Layout & Contenuti

### 1. Hero / Main Slider (Core)
-   **Struttura:** L'intera viewport (`h-[100dvh]`) è occupata dallo slider.
-   **Slides:** Ogni slide rappresenta un progetto chiave.
    -   **Background:** Immagine Fullscreen con leggero overlay scuro gradient.
    -   **Caption:** Box laterale sinistro "fluttuante" (Glassmorphism o sfondo solido scuro) contenente:
        -   Categoria (es. "Ristrutturazione Residenziale") in Primary.
        -   Titolo Progetto (es. "Villa Liberty | Como") in Oswald Bold.
        -   Descrizione breve (2 righe).
        -   Link "Scopri i Dettagli" (icona freccia).
-   **Navigazione:**
    -   Frecce Minimal laterali (o in basso a destra).
    -   Progress Bar o Counter "01 / 05" in basso a sinistra.
    -   Effetto transizione: Slide o Fade lento ed elegante.

### 2. Quick Grid (Sotto lo Slider)
Per facilitare la navigazione veloce senza dover scorrere tutto lo slider.
-   **Layout:** Griglia 4 colonne, immagini quadrate piccole.
-   **Contenuto:** Thumbnail di tutti i progetti. Cliccando si apre il progetto o si scrolla lo slider alla posizione corretta.

### 3. Footer
-   Standard (come Home/Chi Siamo/Servizi).

---

## Piano di Implementazione Tecnico

### File: `progetti.html`
1.  Clonazione struttura `index.html`.
2.  **Slider Component:**
    -   Utilizzo di una libreria lightweight (es. Swiper.js) o implementazione Custom Vanilla JS (preferibile per leggerezza se le funzioni sono base).
    -   **CSS:** `absolute inset-0` per le immagini, `z-index` per gestire overlay e testi.
3.  **Dati Progetti:** Array di oggetti in JS per popolare dinamicamente lo slider (o HTML statico se i progetti sono pochi e fissi).

### File: `assets/js/progetti.js` (Nuovo)
-   Logica dello slider (Next/Prev, Autoplay opzionale, Touch events).
-   Sincronizzazione con la Quick Grid.

## Riepilogo Post-Implementazione
*(Da compilare a fine lavori)*
-   [ ] Pagina `progetti.html` creata.
-   [ ] Slider funzionante e responsive.
-   [ ] Quick Grid collegata.

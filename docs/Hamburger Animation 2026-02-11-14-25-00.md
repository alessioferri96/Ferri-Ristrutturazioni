# Progetto: Animazione Hamburger to Close Icon

**Data:** 2026-02-11
**Obiettivo:** Trasformare l'icona Hamburger in una "X" di chiusura nella stessa posizione quando il menu è aperto.

## Dettagli Tecnici

### 1. `index.html` (Toggle Button)
- **Z-Index:** Aumentare a `z-[70]` (sopra l'overlay `z-[60]`).
- **SVG Lines:** Aggiungere classi per transizioni mirate.
    - Linea 1 (Top): `origin-center transition-transform duration-300 ease-in-out`
    - Linea 2 (Middle): `transition-opacity duration-300 ease-in-out`
    - Linea 3 (Bottom): `origin-center transition-transform duration-300 ease-in-out`
- **Stato `menu-open` (applicato via JS al button):**
    - Linea 1: Ruota 45°, Trasla Y per centrare.
    - Linea 2: Opacità 0.
    - Linea 3: Ruota -45°, Trasla Y per centrare.

### 2. `assets/js/main.js`
- **Rimuovere:** Il bottone `#close-mobile-menu` generato dinamicamente.
- **Aggiornare `toggleMenu`:**
    - Toggle classe `menu-open` su `#mobile-menu-toggle`.
    - Toggle colore testo del button (da `text-secondary/primary` a `text-white` quando il menu è aperto, se necessario per contrasto su sfondo scuro). *Nota: Il menu è scuro `bg-secondary`, il testo è bianco. Il button deve diventare bianco.*

## Piano di Implementazione
1.  **Modifica `index.html`**:
    - Aggiornare classi SVG e Button.
2.  **Modifica `assets/js/main.js`**:
    - Rimuovere bottone di chiusura interno.
    - Aggiungere logica toggle classe e colore.

## Richiesta Approvazione
Procedo direttamente.

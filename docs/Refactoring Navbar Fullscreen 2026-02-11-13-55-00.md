# Progetto: Refactoring Navbar - Fullscreen Menu

**Data:** 2026-02-11
**Obiettivo:** Rimuovere la navigazione desktop classica e la ricerca, sostituendole con un menu "hamburger" attivo su tutti i dispositivi (Desktop, Tablet, Mobile).

## Dettagli Design

### 1. Navbar (`index.html`)
- **Rimuovere:**
    - Menu Desktop (`<nav class="hidden lg:flex...">`).
    - Icona Cerca.
- **Modificare Toggle Button:**
    - **Visibilità:** Visibile sempre (rimuovere `lg:hidden`).
    - **Icona:** Nuova SVG "Stylized Hamburger".
        - Linea Sopra: Lunga (Full).
        - Linea Mezzo: Corta (allineata a destra per design dinamico).
        - Linea Sotto: Lunga (Full).

### 2. Menu Overlay (`main.js`)
- **Comportamento:** Il menu a tutto schermo (attualmente generato via JS) deve aprirsi anche su Desktop.
- **Modifica:** Rimuovere la classe `lg:hidden` dalla creazione del `div` del menu.

## SVG Icon Concept
```html
<svg viewBox="0 0 24 24" width="30" height="30" stroke="currentColor" stroke-width="2" stroke-linecap="round">
    <line x1="4" y1="6" x2="20" y2="6"></line>   <!-- Long -->
    <line x1="10" y1="12" x2="20" y2="12"></line> <!-- Short (Right Aligned) -->
    <line x1="4" y1="18" x2="20" y2="18"></line>  <!-- Long -->
</svg>
```

## Piano di Implementazione
1.  **Modifica `index.html`**:
    - Rimuovere blocco `<nav>`.
    - Rimuovere blocco Pulsante Cerca.
    - Aggiornare `#mobile-menu-toggle` SVG e rimuovere classi responsive restrittive.
2.  **Modifica `assets/js/main.js`**:
    - Aggiornare stringa `className` del menu creato dinamicamente (rimuovere `lg:hidden`).

## Richiesta Approvazione
Attendo conferma per procedere.

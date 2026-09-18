# Progetto: Refactoring Navbar Scroll Effect

**Data:** 2026-02-11
**Obiettivo:** Modificare l'altezza iniziale della navbar a 120px e gestire la transizione allo scroll (sfondo bianco, testo nero, ridimensionamento logo).

## Dettagli Design

### 1. Stato Iniziale (Top of Page)
- **Altezza:** 120px (`h-[120px]`).
- **Sfondo:** Trasparente.
- **Testo:** Bianco.
- **Logo:** Dimensione originale (Grande).

### 2. Stato Scrolled (`.scrolled`)
- **Trigger:** `window.scrollY > 10` (gestito da `main.js`).
- **Altezza:** Ridotta (es. 80px / `h-20`) per effetto ridimensionamento.
- **Sfondo:** Bianco (`bg-white`) con effetto "dissolvenza" (`transition-colors duration-500`).
- **Testo:** Nero (`text-black`) per massimo contrasto.
- **Logo:** Ridimensionato proporzionalmente (es. scale text or transform) per seguire l'altezza ridotta.

## Piano di Implementazione
1.  **Modifica `index.html`**:
    - Aggiornare classi Header container: `h-[120px] group-[.scrolled]:h-24`.
    - Aggiornare colori testo: `group-[.scrolled]:text-black`.
    - Aggiornare Logo: Aggiungere classi per ridimensionamento testo (es. `transition-all origin-left group-[.scrolled]:scale-75`).
    - Verificare transizioni CSS.

## Richiesta Approvazione
Procedo con l'implementazione diretta.

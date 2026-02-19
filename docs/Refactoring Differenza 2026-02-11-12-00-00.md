# Progetto: Refactoring Sezione "La Nostra Differenza" (Newspaper Style)

**Data:** 2026-02-11
**Obiettivo:** Modificare la sezione "La Nostra Differenza" per replicare lo stile "giornalistico" della sezione "Chi Siamo".

## Dettagli Design

### 1. Layout & Stile
- **Sfondo:** Bianco (`bg-white`) per coerenza con lo stile giornale (attualmente è scuro).
- **Struttura:**
    - **Headline:** Piccolo, uppercase, spaced (es. "PERCHÉ SCEGLIERCI").
    - **Titolo:** Grande, font display (es. "LA NOSTRA DIFFERENZA").
    - **Testo:** 2 colonne (`md:columns-2`), giustificato, con Drop Cap.
- **Contenuto:** Testo Placeholder Lorem Ipsum.

### 2. Posizione
- Sostituisce l'attuale sezione `bg-secondary` alla fine del main content.

## Piano di Implementazione
1.  **Modifica `index.html`**:
    - Localizzare la sezione `La Nostra Differenza`.
    - Sostituire classi e contenuto con la struttura usata in `#chi-siamo`.
    - Adattare headline e titolo.

## Richiesta Approvazione
Procedo direttamente.

# Progetto: Refactoring Sezione "Chi Siamo" (Newspaper Style)

**Data:** 2026-02-11
**Obiettivo:** Modificare la sezione "Chi Siamo" per adottare un layout "giornalistico" su due colonne, con un headline e un titolo prominente.

## Dettagli Design

### Struttura
- **Headline (Sopratitolo):** Testo piccolo, uppercase, spaziato (es. `tracking-widest`), colore primary o grigio scuro. Testo: "CHI SIAMO".
- **Titolo:** Grande, font `font-display`, uppercase, forte impatto. Testo: "L'ECCELLENZA COSTRUTTIVA".
- **Contenuto:** Testo diviso in due colonne (`columns-1 md:columns-2 gap-12`), allineato a sinistra o giustificato, con capolettera o stile editoriale.
- **Placeholder:** Testo "Lorem Ipsum" o simile generico come richiesto.

### Stile CSS (Tailwind)
- Utilizzo di `columns-1` (mobile) e `columns-2` (desktop) per il flusso del testo.
- `prose` e `prose-lg` per la formattazione del testo.
- Separatore opzionale tra titolo e testo.

## Piano di Implementazione
1.  **Modifica `index.html`**:
    - Sostituire il contenuto di `#chi-siamo`.
    - Implementare la nuova struttura HTML.
    - Inserire il testo placeholder.

## Richiesta Approvazione
Procedo direttamente con l'implementazione come da richiesta utente.

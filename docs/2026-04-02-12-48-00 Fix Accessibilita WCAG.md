# Fix Accessibilita WCAG 2.2

**Data:** 2026-04-02
**Severita:** CRITICAL + IMPORTANT

## Descrizione

Correzione di problemi di accessibilita rilevati dall'audit WCAG 2.2.

## Modifiche Effettuate

### CRITICAL

**Background-image con alternative testuali (28 istanze, 6 pagine)**
Aggiunto `role="img"` e `aria-label` descrittivo in italiano a tutti i div con `background-image` significativi (hero, gallery, servizi, progetti).

**Gallery items accessibili da tastiera (8 istanze, 2 pagine)**
Aggiunto `tabindex="0"`, `role="button"`, `aria-label` ai div `.gallery-item` su entrambe le pagine progetto.

**Lightbox dialog (2 pagine)**
Aggiunto `role="dialog"`, `aria-modal="true"`, `aria-label="Galleria immagini"` al `#lightbox`.

**Heading hierarchy (4 pagine)**
- index.html, chi-siamo.html, servizi.html: `<h2>` eyebrow nel hero cambiato in `<span>`
- 404.html: "404" decorativo da `<h1>` a `<span>`, "Progetto Inesistente" da `<h2>` a `<h1>`

### IMPORTANT

**Contrasto colori (2 pagine progetto)**
- `text-white/40` portato a `text-white/60`
- `text-white/30` portato a `text-white/50`

**Lazy loading immagini (chi-siamo.html)**
- `loading="lazy"` aggiunto a 6 immagini below-fold
- `width`/`height` aggiunti per prevenire CLS

**Preload hero images (6 pagine)**
- `<link rel="preload" as="image">` aggiunto per l'immagine hero di ogni pagina

## File Modificati
- Tutte e 8 le pagine HTML
- `assets/css/style.css` (non modificato, focus indicators gia presenti)

## Riepilogo Post-Implementazione
Completato. 28 background-image con aria-label, gallery accessibile da tastiera, lightbox con dialog role, heading hierarchy corretta, contrasti migliorati.

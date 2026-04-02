# Ottimizzazione Performance: Self-hosting Google Fonts

**Data:** 2026-04-02
**Severita:** CRITICAL

## Descrizione

Download e self-hosting dei font Google Fonts (Roboto, Oswald, Cormorant Garamond) per eliminare 2 origini esterne render-blocking (fonts.googleapis.com, fonts.gstatic.com).

## Modifiche Effettuate

### Font Scaricati (subset Latin, formato woff2)
- `assets/fonts/roboto-latin.woff2` (43KB) — variabile, pesi 300-700
- `assets/fonts/oswald-latin.woff2` (21KB) — variabile, pesi 400-700
- `assets/fonts/cormorant-garamond-latin.woff2` (37KB) — variabile, pesi 300-700
- `assets/fonts/cormorant-garamond-italic-latin.woff2` (39KB) — variabile, italic 300-400

### File CSS Creato
- `assets/css/fonts.css` — @font-face declarations con `font-display: swap`

### HTML Aggiornato (8 pagine)
Rimossi su tutte le pagine:
- `<link rel="preconnect" href="https://fonts.googleapis.com">`
- `<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>`
- `<link href="https://fonts.googleapis.com/css2?..." rel="stylesheet">`

Sostituiti con:
- `<link rel="stylesheet" href="assets/css/fonts.css">`

## File Modificati
- `assets/fonts/` (4 nuovi file woff2)
- `assets/css/fonts.css` (nuovo)
- Tutte e 8 le pagine HTML

## Riepilogo Post-Implementazione
Completato. Totale font: 140KB. Eliminate 2 origini esterne.

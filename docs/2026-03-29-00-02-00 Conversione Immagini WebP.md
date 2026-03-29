# Conversione Immagini JPG → WebP

**Data:** 2026-03-29
**Tipo:** Ottimizzazione performance

## Descrizione

Conversione di tutte le immagini del sito da formato JPG a WebP per ridurre i tempi di caricamento. Nessun fallback JPG — WebP è supportato da tutti i browser moderni.

## Dettagli tecnici

- Tool utilizzato: `cwebp` (libwebp 1.4.0)
- Qualità: 82 (compromesso ottimale tra peso e resa visiva)
- Metodo compressione: 6 (massima efficienza)

## Risultati

- **59 immagini** convertite
- Peso totale: **15.5 MB → 9.6 MB (−38%)**
- JPG originali eliminati dalla cartella `assets/img/`
- Aggiunta nuova immagine `restauro-hero.webp` (da sorgente esterna, 15 MB → 1.1 MB)

## Riferimenti HTML aggiornati

Tutti i riferimenti `.jpg` sostituiti con `.webp` in:
- `progetto-locale-frascati.html` (7 background-image + 19 percorsi JS lightbox)
- `progetto-residenza-grottaferrata.html` (5 background-image + 17 percorsi JS lightbox)
- `progetti.html` (4 background-image)
- `index.html` (2 background-image)

## File modificati
- `assets/img/` — 60 file WebP nuovi, JPG eliminati
- `progetto-locale-frascati.html`
- `progetto-residenza-grottaferrata.html`
- `progetti.html`
- `index.html`

## Verification Plan
- Verifica visiva a cura dell'utente

- Implementazione completata con successo

# Ottimizzazione Performance: Immagini Locali

**Data:** 2026-04-02
**Severita:** CRITICAL

## Descrizione

Download di tutte le immagini esterne (Unsplash/Pexels) caricate da CDN, conversione in formato WebP e sostituzione degli URL con percorsi locali. Eliminazione di 2 origini esterne (images.unsplash.com, images.pexels.com).

## Modifiche Effettuate

### Immagini Scaricate e Convertite (11 totali)

| File locale | Origine | Usato in |
|---|---|---|
| hero-index.webp | Unsplash photo-1541976590 | index.html hero |
| hero-servizi.webp | Unsplash photo-1503387762 | servizi.html hero, chi-siamo.html timeline |
| bg-contatti.webp | Pexels 1209962 | footer contatti (4 pagine) |
| hero-chi-siamo.webp | Pexels 27873253 | chi-siamo.html hero |
| chi-siamo-utensili.webp | Pexels 5799050 | chi-siamo.html block 1 |
| chi-siamo-casco.webp | Pexels 7937319 | chi-siamo.html metodo |
| chi-siamo-artigiano.webp | Pexels 25596147 | chi-siamo.html timeline 1960 |
| chi-siamo-utensili-lavoro.webp | Pexels 11398216 | chi-siamo.html timeline 1990 |
| chi-siamo-stretta-mano.webp | Pexels 7653971 | chi-siamo.html timeline 2020 |
| servizi-chiave.webp | Pexels 30958693 | servizi.html servizio 1 |
| servizi-impiantistica.webp | Pexels 6492397 | servizi.html servizio 2 |

### Compressione restauro-hero.webp
- Prima: 1.1MB
- Dopo: 432KB (-61%)

## File Modificati
- `assets/img/` (11 nuovi file + 1 compresso)
- `index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html` (URL aggiornati)

## Riepilogo Post-Implementazione
Completato. Zero URL esterni Unsplash/Pexels rimasti nel codice. Verificato con grep.

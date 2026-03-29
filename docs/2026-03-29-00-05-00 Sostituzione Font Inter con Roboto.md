# Sostituzione Font Inter → Roboto

**Data:** 2026-03-29
**Tipo:** Aggiornamento design

## Descrizione

Sostituzione del font family base (testo, paragrafi, UI) da Inter a Roboto su tutto il sito.

## Modifiche

### Configurazione Tailwind
- `tailwind.config.js`: `font-sans` da `['Inter', 'sans-serif']` a `['Roboto', 'sans-serif']`

### Google Fonts
- Link aggiornato in tutte le pagine: `family=Inter:wght@300;400;600` → `family=Roboto:wght@300;400;500;700`

### Riferimenti inline
- Counter lightbox in `progetto-locale-frascati.html` e `progetto-residenza-grottaferrata.html`: `font-family:Inter` → `font-family:Roboto`

## File modificati
- `tailwind.config.js`
- `index.html`
- `index-wip.html`
- `chi-siamo.html`
- `servizi.html`
- `progetti.html`
- `contatti.html`
- `404.html`
- `progetto-locale-frascati.html`
- `progetto-residenza-grottaferrata.html`

## Nota
Richiede ricompilazione Tailwind CSS prima del deploy:
```
npx tailwindcss -i input.css -o assets/css/tailwind.css --minify
```

## Verification Plan
- Verifica visiva a cura dell'utente

- Implementazione completata con successo

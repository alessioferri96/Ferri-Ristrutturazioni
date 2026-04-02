# Rinomina File Progetto e Fix Link Interni

**Data:** 2026-04-02
**Severita:** IMPORTANT

## Descrizione

Rinominazione del file `progetto-residenza-grottaferrata.html` in `progetto-appartamento-frascati.html` per allineare URL e contenuto. Aggiornamento di tutti i link interni.

## Modifiche Effettuate

### File Rinominato
- `progetto-residenza-grottaferrata.html` → `progetto-appartamento-frascati.html`

### Link Aggiornati
- `index.html` — link card progetto
- `progetti.html` — link slide e CTA
- `progetto-locale-frascati.html` — link "Progetto Successivo"
- `progetto-appartamento-frascati.html` — canonical e og:url
- `sitemap.xml` — URL aggiornato

### Altro Fix
- Link "Vedi Tutti i Progetti" in index.html: `#progetti` → `progetti.html`

## File Modificati
- `progetto-appartamento-frascati.html` (nuovo nome)
- `index.html`, `progetti.html`, `progetto-locale-frascati.html`, `sitemap.xml`

## Nota
Il vecchio file `progetto-residenza-grottaferrata.html` esiste ancora e puo essere eliminato dopo il deploy. I nomi delle immagini (`residenza-grottaferrata-*.webp`) non sono stati rinominati per evitare rotture.

## Riepilogo Post-Implementazione
Completato. Zero riferimenti al vecchio URL nelle pagine di produzione.

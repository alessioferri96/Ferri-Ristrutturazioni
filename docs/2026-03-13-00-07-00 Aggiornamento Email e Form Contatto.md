# Aggiornamento Email e Form di Contatto

**Data:** 2026-03-13
**Tipo:** Modifica contenuto / Funzionalità

## Descrizione

Aggiornare tutte le email presenti nel progetto alla nuova email info@ferriristrutturazioni.com e associare i form di contatto affinché puntino a questa mail.

## Modifiche Pianificate

### Email
- `contatti.html`: info@ferriristrutturazioni.it → info@ferriristrutturazioni.com
- `contatti.html`: careers@ferriristrutturazioni.it → careers@ferriristrutturazioni.com (coerenza dominio)

### Form di contatto (aggiunta action mailto)
- `index-nascosto.html`
- `chi-siamo.html`
- `servizi.html`
- `progetti.html`
- `contatti.html`

## Verification Plan
- Verifica visiva a cura dell'utente

## Riepilogo Post-Implementazione
- Email aggiornate in `contatti.html`:
  - info@ferriristrutturazioni.it → info@ferriristrutturazioni.com (link mailto + testo visibile)
  - careers@ferriristrutturazioni.it → careers@ferriristrutturazioni.com
- Form di contatto aggiornati con `action="mailto:info@ferriristrutturazioni.com" method="POST" enctype="text/plain"` su:
  - `contatti.html`
  - `index-nascosto.html`
  - `chi-siamo.html`
  - `servizi.html`
  - `progetti.html`
- Implementazione completata con successo

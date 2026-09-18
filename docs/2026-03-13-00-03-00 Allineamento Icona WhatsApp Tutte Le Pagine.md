# Allineamento Icona WhatsApp su Tutte le Pagine

**Data:** 2026-03-13
**Tipo:** Modifica layout/UI - Coerenza cross-page

## Descrizione

Applicare la stessa modifica all'icona WhatsApp già implementata su `index-nascosto.html` a tutte le altre pagine con header/navbar: chi-siamo.html, servizi.html, contatti.html, progetti.html.

## Modifiche Pianificate

### Per ogni pagina:
- Rimuovere la sezione "Scrolled Center Icons" (WhatsApp visibile solo in stato scrolled)
- Wrappare hamburger + icona WhatsApp verde (#25D366) in un contenitore flex
- Icona WhatsApp sempre visibile, a destra dell'hamburger

### File coinvolti
- `chi-siamo.html`
- `servizi.html`
- `contatti.html`
- `progetti.html`

### File NON coinvolti
- `404.html` (header minimale senza navbar)
- `index.html` (pagina WIP senza navbar)

## Verification Plan
- Verifica visiva a cura dell'utente

## Riepilogo Post-Implementazione
- Modificata `chi-siamo.html`: rimossa sezione Scrolled Center Icons, aggiunto wrapper flex con hamburger + WhatsApp verde
- Modificata `servizi.html`: stessa modifica
- Modificata `contatti.html`: stessa modifica (mantenuta classe extra `text-black` sul button hamburger specifica di questa pagina)
- Modificata `progetti.html`: stessa modifica
- `404.html` e `index.html` non toccate (header minimale senza navbar)
- Tutte le 5 pagine con navbar (index-nascosto + 4 interne) ora hanno header identico e coerente
- Implementazione completata con successo

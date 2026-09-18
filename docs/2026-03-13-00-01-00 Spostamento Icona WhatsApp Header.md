# Spostamento Icona WhatsApp nell'Header - index-nascosto.html

**Data:** 2026-03-13
**Tipo:** Modifica layout/UI

## Descrizione

Spostare l'icona WhatsApp dalla sezione centrale della navbar scrollata alla destra dell'icona hamburger, con il colore verde classico WhatsApp (#25D366), sempre visibile.

## Modifiche Pianificate

### Stato attuale
- L'icona WhatsApp si trova nelle "Scrolled Center Icons" (righe 44-56), visibile solo quando la navbar è in stato "scrolled"
- Colore: nero con hover verde

### Nuovo stato
- Rimuovere la sezione "Scrolled Center Icons" (che ora contiene solo WhatsApp)
- Aggiungere l'icona WhatsApp verde (#25D366) a destra dell'hamburger menu
- L'icona sarà sempre visibile (non solo in stato scrolled)
- Wrappare hamburger + WhatsApp in un contenitore flex con gap

### File coinvolti
- `index-nascosto.html`

## Verification Plan
- Verifica visiva a cura dell'utente

## Riepilogo Post-Implementazione
- Rimossa la sezione "Scrolled Center Icons" che conteneva solo l'icona WhatsApp visibile in stato scrolled
- Creato un contenitore flex (`gap-3 md:gap-4`) che racchiude hamburger + icona WhatsApp
- Icona WhatsApp posizionata a destra dell'hamburger, sempre visibile con colore verde fisso `#25D366`
- Dimensione icona aumentata a 28x28 (da 20x20) per coerenza visiva con l'hamburger
- Aggiunto `z-[70]` all'icona WhatsApp per garantire visibilità sopra il menu fullscreen
- Implementazione completata con successo

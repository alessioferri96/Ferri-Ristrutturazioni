# Progetto: Ferri Ristrutturazioni
## Documento di Progetto: Sostituzione Telefono con WhatsApp (Navbar Scrolled)
**Data e Ora:** 2026-02-28 16:30:54

## Obiettivo
Sostituire l'icona del telefono e relativo numero all'interno della navbar a comparsa (scrolled navbar) con un collegamento diretto a WhatsApp. L'intervento verrà propagato in modo omogeneo a tutte le pagine HTML del progetto Ferri Ristrutturazioni che presentano questa barra di navigazione.

## Modifiche Previste
1. **Ricerca e Sostituzione Blocco:** Individuare in tutti i file della directory radice (es. `chi-siamo.html`, `contatti.html`, `servizi.html`, `progetti.html`, `index-nascosto.html`) l'ancora (`<a aria-label="Chiama Ora">`) contenente il link tel (`href="tel:+391234567890"`).
2. **Aggiornamento Link e Icona:** Sostituire il link con un collegamento a WhatsApp (`href="https://wa.me/391234567890"`), aggiungere `target="_blank" rel="noopener noreferrer"`, sostituire l'SVG del telefono con l'icona di un messaggio/chat (stile WhatsApp in linee, coerente con il design di Lucide Icons/Heroicons in uso) e aggiornare l'`aria-label`. Potremo inoltre far sì che l'hover color visualizzi il colore ufficiale di WhatsApp (`hover:text-[#25D366]`) invece di quello primario per maggior chiarezza.

## File Potenzialmente Interessati
- `servizi.html`
- `contatti.html`
- `chi-siamo.html`
- `progetti.html`
- `index-nascosto.html`

## Riepilogo Post-Implementazione
_Da compilare al termine dello sviluppo._
- **Stato:** Da iniziare
- **Note:** ...

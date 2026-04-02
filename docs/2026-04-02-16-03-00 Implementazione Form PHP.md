# Implementazione Form Contatto PHP

**Data:** 2026-04-02
**Severita:** IMPORTANT

## Descrizione

Sostituzione del sistema `mailto:` (che apriva il client email del visitatore) con uno script PHP server-side che invia le email direttamente dalla casella del server Hostinger.

## Modifiche Effettuate

### Nuovo File: send-mail.php
Script PHP con:
- **Sanitizzazione input** — `htmlspecialchars()` e `filter_var()` su tutti i campi
- **Validazione** — controlla nome, email valida, messaggio e accettazione privacy
- **Honeypot anti-spam** — campo nascosto `_hp` che solo i bot compilano
- **Pagina di origine** — campo nascosto `_pagina` per identificare da quale pagina arriva il messaggio
- **Reply-To** — l'email di risposta punta direttamente al mittente
- **Redirect con feedback** — reindirizza a `contatti.html?status=ok` o `?status=errore`

### Aggiornamento Form (5 pagine)
Su index.html, chi-siamo.html, servizi.html, progetti.html, contatti.html:
- `action="mailto:info@ferriristrutturazioni.com"` → `action="send-mail.php"`
- Rimosso `enctype="text/plain"`
- Aggiunto campo honeypot `<input type="text" name="_hp" class="hidden">`
- Aggiunto campo nascosto `<input type="hidden" name="_pagina" value="[pagina].html">`

### Feedback Visivo (contatti.html)
- Aggiunto `<div id="form-feedback">` prima del form
- Aggiunto script JS che legge i parametri URL `?status=ok/errore` e mostra messaggio verde (successo) o rosso (errore)

## File Creati
- `send-mail.php`

## File Modificati
- `index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html`, `contatti.html`

## Riepilogo Post-Implementazione
Completato e testato in produzione su Hostinger. Email ricevuta correttamente su info@ferriristrutturazioni.com.

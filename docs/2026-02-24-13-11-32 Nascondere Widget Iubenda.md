# Documento di Progetto: Nascondere Widget Iubenda Extra

## Obiettivo
Nascondere il widget testuale aggiuntivo di Iubenda (`.iub__us-widget`) che appare sulla pagina, in quanto l'icona fluttuante standard di Iubenda svolge già la medesima funzione (aprire il pannello delle preferenze privacy), evitando così ridondanze grafiche.

## Analisi del Problema
L'elemento HTML indicato dall'utente viene iniettato **dinamicamente** dallo script globale di Iubenda al caricamento della pagina.
Cercare di rimuoverlo direttamente dal codice HTML sorgente è impossibile (perché non esiste nei nostri file `.html`), e rimuoverlo tramite JavaScript dopo il caricamento potrebbe interferire con il funzionamento interno dello script di Iubenda.

## Proposed Changes
> [!TIP]
> La soluzione più sicura, approvata ufficialmente anche nei forum di supporto Iubenda per questi casi, è nascondere l'elemento visivamente utilizzando una regola CSS dedicata. Questo mantiene lo script funzionante ma rimuove l'ingombro visivo per l'utente.

### Fase 1: Aggiornamento CSS Custom
Aggiungere la seguente regola nel file `assets/css/style.css`:
```css
/* Nascondere widget testuale extra di Iubenda (già presente icona) */
.iub__us-widget {
    display: none !important;
}
```

## Verification Plan
1. Inserimento della regola CSS in `style.css`.
2. Esecuzione del commit e push (Deploy).
3. Verifica live: il widget testuale in basso non deve più apparire, mentre l'icona circolare di Iubenda deve rimanere visibile e cliccabile.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:** Aggiunta la regola CSS `display: none !important;` per la classe `.iub__us-widget` nel file `assets/css/style.css`.
- **Prossimi Passi:** L'utente verificherà live la rimozione visiva della barra testuale di Iubenda dal sito una volta terminato il deploy automatico di GitHub.

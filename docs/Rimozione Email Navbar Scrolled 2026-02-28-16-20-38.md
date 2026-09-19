# Rimozione Email Navbar Scrolled

## Descrizione
L'obiettivo di questa implementazione è scorrere tutte le pagine HTML del sito e rimuovere l'icona con il link mailto (`info@ferriristrutturazioni.it`) che si trova all'interno della navbar in versione "scrolled" (ovvero visibile quando l'utente scorre la pagina verso il basso). Verrà inoltre effettuata una pulizia di eventuali errori o codice morto (inutilizzato) all'interno delle pagine.

## Passaggi
1. Identificazione e rimozione del seguente elemento all'interno di tutte le pagine HTML (`index.html`, `chi-siamo.html`, `contatti.html`, `servizi.html`, `progetti.html`, ecc.):
```html
<a href="mailto:info@ferriristrutturazioni.it" class="text-black hover:text-primary transition-colors hover:scale-110 transform duration-300" aria-label="Invia Email">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
    </svg>
</a>
```
2. Controllo e pulizia del codice in giro per i vari file per rimuovere eventuali artefatti o errori strutturali presenti.
3. Test finale della navbar.

## Pagine Coinvolte
- `index.html`
- `chi-siamo.html`
- `servizi.html`
- `contatti.html`
- `progetti.html`
- `404.html`
- `index-nascosto.html`

## Riepilogo Post-Implementazione
_Da compilare al termine dello sviluppo._
- **Stato:** Completato
- **Note:**
  - L'icona dell'email per la navbar scrolled è stata rimossa con successo dalle pagine: `chi-siamo.html`, `contatti.html`, `servizi.html`, `progetti.html`, e `index-nascosto.html`.
  - Non sono state apportate modifiche a `index.html` e `404.html` in quanto non presentavano il medesimo blocco per la navbar (le instestazioni erano minimal senza contatti a scomparsa).
  - È stato trovato ed unito un doppio attributo `class` nei tag `<body>` dei file `servizi.html` e `progetti.html` pulendo così il codice come richiesto.

# Documento di Progetto: Fix Definitivo Animazioni Iniziali

## Obiettivo
Risolvere definitivamente il problema del FOUC (animazione impropria all'avvio) constatato sui pulsanti, dal momento che il fix precedente basato sulla classe `preload` non ha arginato il difetto.

## Analisi del Problema
Abbiamo constatato che il FOUC è ancora presente nonostante la classe CSS ponga un blocco `transition: none !important`.
In questi scenari, il "colpevole" è l'istante in cui la classe viene rimossa: `DOMContentLoaded`. 
Spesso il browser scatta questo evento **prima** di aver calcolato le geometrie o effettuato la cosiddetta "first paint" a schermo. Se il JavaScript rimuove la restrizione delle transizioni una frazione di secondo *prima* di renderizzare visivamente la pagina, Tailwind elabora e disegna le classi dei bottoni scatenandone la transizione come originariamente previsto.

## Proposed Changes
> [!TIP]
> Per garantire la sospensione visiva, occorre far slittare la rimozione della restrizione. Invece di usare `DOMContentLoaded`, la rimuoveremo nell'evento `load` di Window e la ingabberemo all'interno della direttiva `requestAnimationFrame` (che istruisce il browser di aspettare che il disegno del rendering attuale dello schermo sia materialmente completato).

### Modifica a `assets/js/main.js`
1. Rimuovo `document.body.classList.remove('preload');` dalla cima di `DOMContentLoaded`.
2. Aggiungo fuori da quel blocco, nell'ambiente globale (o ad inizio file):
```javascript
window.addEventListener('load', () => {
    // Forza il browser ad aspettare un intero ciclo di rendering a schermo
    requestAnimationFrame(() => {
        document.body.classList.remove('preload');
    });
});
```

La classe `preload` sui vari `<body>` in giro per i file HTML rimane correttamente invariata, così come la regola in `style.css`. Agiamo solo sulla tempistica dello "sblocco".

## Verification Plan
1. Modifica al file `main.js`.
2. Push su GitHub.
3. Test esecutivo utente: ricaricare cachettando e visualizzando il completo debellamento del disturbo visivo.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:** Spostata la logica di rimozione della classe `preload` dall'evento `DOMContentLoaded` all'evento documentale `window.load` in testa al file `main.js`. Incapsulata l'istruzione in `requestAnimationFrame` per assicurarne l'esecuzione al termine dell'interpretazione CSS di Tailwind.
- **Prossimi Passi:** L'utente verificherà che ricaricando le pagine lo spiacevole "sfarfallio" hover iniziale non si verifichi più.

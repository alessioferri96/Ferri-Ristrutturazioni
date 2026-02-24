# Documento di Progetto: Fix Animazione Iniziale Pulsanti

## Obiettivo
Impedire che l'animazione di ritorno dallo stato "hover" allo stato normale dei pulsanti venga innescata visivamente al primissimo caricamento delle pagine HTML (FOUC - Flash of Unstyled Content sulle transizioni CSS).

## Analisi del Problema
In molti moderni engine CSS (incluso lo stack base di Tailwind o stili inline intensi), quando il browser analizza per la prima volta le regole CSS di stato (es. hover, before, after) associandole alle transizioni (`transition-all`, `duration-300`), a volte interpreta l'applicazione dello stile *base* come un "cambiamento d'uso", scatenando l'animazione di uscita non appena il bottone viene disegnato a schermo.

## Proposed Changes
> [!TIP]
> Una best practice diffusissima per questo specifico glitch è la classe "preload". Aggiungendo una semplice classe al `<body>` e un mini-script in JavaScript, possiamo forzare il browser a mantenere *tutte* le transizioni spente (`transition: none !important`) finché la pagina non è pronta.

### Intervento
1.  **Tag Body:** Aggiungere una classe temporanea `preload` a tutti i tag `body` nel sito.
    Attuale: `<body class="... flex flex-col">`
    Futuro : `<body class="preload ... flex flex-col">`
2.  **JS (in `assets/js/main.js`):** Inserire un piccolo script in testa al file:
    ```javascript
    document.addEventListener("DOMContentLoaded", () => {
        document.body.classList.remove('preload');
    });
    ```
    *Questo rimuoverà il blocco istantaneamente non appena il DOM è pronto, garantendo hover e animazioni perfette all'interazione reale.*
3.  **CSS (in `assets/css/style.css`):** Definire la classe di blocco:
    ```css
    body.preload * {
        transition: none !important;
    }
    ```

## Verification Plan
1. Applicazione della classe al body sui 6 file HTML (inclusa la 404).
2. Aggiunta della regola JS e CSS.
3. Commit e push.
4. Richiesta verifica live all'utente, ricaricando le pagine più volte. L'effetto "risucchio" dei pulsanti alla prima riga non dovrebbe più essere disegnato.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:**
  - Aggiunta la classe `preload` ai tag `<body ...>` di tutti e 6 i documenti HTML (`index`, `chi-siamo`, `servizi`, `progetti`, `contatti` e `404`).
  - Aggiunta la regola CSS globale in `style.css` per bloccare le transizioni sui figli di `body.preload`.
  - Inserito il behavior in `main.js` per rimuovere dinamicamente la classe `preload` dal body non appena scatta l'evento `DOMContentLoaded`.
- **Prossimi Passi:** L'utente verificherà che ricaricando le pagine non ci sia più il flash visivo dell'animazione sui pulsanti allo stato base.

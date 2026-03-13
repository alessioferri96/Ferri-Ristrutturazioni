# Panoramica del Progetto: Ferri Ristrutturazioni

Questo è il sito web per "Ferri Ristrutturazioni", un'azienda di costruzioni e ristrutturazioni. Il progetto è un sito statico moderno, performante e ottimizzato per una futura integrazione con WordPress.

## Tecnologie Principali

-   **Struttura:** HTML5 Semantico
-   **Stile:** Tailwind CSS (attualmente via CDN per sviluppo rapido, previsti stili personalizzati in `assets/css/style.css`)
-   **Logica:** Vanilla JavaScript (ES6+)
-   **Font:** Oswald (Display), Inter (Body)
-   **Icone:** Lucide Icons / Heroicons (SVG inline)
-   **Librerie:** Nessuna dipendenza pesante (No jQuery, No Bootstrap), animazioni custom CSS/JS.

## Struttura del Progetto

-   **`/`**: Root del sito, contiene i file HTML principali (`index.html`, `chi-siamo.html`, `servizi.html`, etc.).
-   **`/assets`**: Risorse statiche.
    -   **`/css`**: Fogli di stile personalizzati (`style.css`).
    -   **`/js`**: Script JavaScript (`main.js`).
    -   **`/img`**: Immagini del sito.
-   **`/docs`**: Documentazione di progetto e log delle implementazioni.

## Regole di Sviluppo Aggiuntive

-   **Documentazione Preventiva:** Prima di implementare o sviluppare una nuova funzionalità, è obbligatorio creare un documento di progetto che ne descriva l'implementazione. Il documento deve dettagliare le modifiche e lo sviluppo che verranno effettuati.
    -   **Nome del File:** Il documento deve essere nominato seguendo il formato `YYYY-MM-DD-HH-mm-ss Nome Funzione`.
    -   **Posizione:** I documenti di progetto devono essere salvati nella cartella `/docs` alla radice del progetto.
    -   **Data e Ora:** Prima di creare il file, verificare sempre la data e l'ora correnti per garantire che il nome del file sia corretto.
-   **Aggiornamento Documentazione Post-Implementazione:** Al termine di ogni implementazione, è obbligatorio compilare la sezione "Riepilogo Post-Implementazione" nel documento di progetto creato in precedenza. Questo riepilogo deve attestare il completamento del lavoro, confermando che i passaggi pianificati sono stati eseguiti con successo e indicando eventuali problemi riscontrati.
-   **Monitoraggio Contesto:** Tieni traccia del contesto e avvisami quando il contesto ha raggiunto il 75% della capacità.
-   **Verification Rule:** La sezione "Verification Plan" nei documenti di progetto NON deve includere check visuali automatizzati (browser tools). La verifica estetica e funzionale visiva è riservata all'utente. Non avviare mai la verifica automatica sul browser senza esplicita richiesta.

## Convenzioni di Sviluppo

-   **Stile Coding:**
    -   Usa classi utility Tailwind direttamente nell'HTML.
    -   JavaScript moderno (ES6+) senza framework, basato su eventi e manipolazione DOM diretta.
    -   Mantieni il codice pulito e commentato.
-   **Deploy/Build:** Il sito è statico, pronto per essere caricato via FTP o convertito in tema WordPress seguendo la guida di migrazione.

# Documento di Progetto: Compilazione Tailwind CSS Locale (Fix FOUC CDN)

## Obiettivo
Debellare in via definitiva l'effetto FOUC (Flash of Unstyled Content) dovuto ai caricamenti dei pulsanti e aumentare dismisuratamente la velocità (Core Web Vitals) del sito rimuovendo la dipendenza dallo script di **Tailwind CDN**.

## Analisi del Problema
Abbiamo tentato due hook JavaScript (`DOMContentLoaded` e `window.load` + `requestAnimationFrame`) e nessuno dei due è riuscito a domare lo sfarfallio. Questo ci dà una prova inconfutabile: **Il colpevole è il CDN di Tailwind.** 
Per "comodità" di sviluppo, il sito includeva lo script `https://cdn.tailwindcss.com`. Questo script è noto alla comunità degli sviluppatori perché blocca il rendering, analizza al volo tutta la pagina, elabora il CSS corrispondente e poi lo inietta. Nel lasso di tempo in cui lo genera, i bottoni sono scoperti: appena la libreria inietta lo stile, nasce l'animazione FOUC.
Utilizzare il CDN in produzione su siti "Live" (come nel nostro caso pronto per WordPress) è fortemente scoraggiato dalla documentazione ufficiale Tailwind proprio per le brutte performance e questi artefatti grafici indesiderati.

## Proposed Changes
> [!CAUTION]
> Essendo disponibili i comandi di sviluppo locali `npx` (Node.js), compilerò fisicamente e permanentemente l'intero motore grafico Tailwind all'interno di un file `.css` tradizionale. Così facendo, il caricamento sarà istantaneo, assecondato nativamente dal browser, eliminando in via del tutto definitiva il difetto grafico.

### Interventi Specifici:
1.  **Creazione file Configurazione (`tailwind.config.js`):**
    Estrarrò tutti i tuoi stili Custom (colori `primary`, `secondary`, font `Oswald/Inter`) e li salverò in questo file di sistema locale.
2.  **Compilazione del CSS (`assets/css/tailwind.css`):**
    Tramite `npx tailwindcss`, ordinerò al compilatore di leggere tutte e 6 le tue pagine `HTML` e generare unicamente le classi CSS strettamente necessarie, comprimendole al minimo.
3.  **Pulizia Pagine HTML (Tutti i file):**
    Sostituirò il blocco script:
    ```html
    <!-- Tailwind CSS (via CDN for Development) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script> ...config... </script>
    ```
    Con il classico collegamento asincrono ultra-rapido:
    ```html
    <!-- Tailwind CSS (Compiled for Production) -->
    <link rel="stylesheet" href="assets/css/tailwind.css">
    ```
4.  **Rollback del precedente work-around:**
    L'accrocchio della classe `preload` può essere buttata via dai Body degli HTML e dallo script `main.js`. 

## Verification Plan
1. Compilazione file tramite terminale locale.
2. Modifica globale tag `<head>`.
3. Push live su Branch Main.
4. L'utente caricherà il sito notando immediatamente la fluidità al 100% e la fissa stabilità di ogni elemento UI al load (0 FOUC).

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:**
  - Installato localmente `tailwindcss` v3 tramite node.
  - Salvate impostazioni del cliente nel file custom `tailwind.config.js`.
  - Compilato asset nativo statico `assets/css/tailwind.css` alleggerito.
  - Sostituito lo sgradito CDN di sviluppo con un formale link HTML stylesheet ed eliminati tutti gli script/classi correlati al fix fallimentare FOUC originati come ripiego.
- **Prossimi Passi:** Ultimissimo e conclusivo check live da parte dell'utente per assistere all'assenza totale di sfarfallii ai pulsanti.

# Documento di Progetto: Pagina Work In Progress

## Obiettivo
Creare e implementare una pagina di manutenzione ("Work In Progress") che sostituirà temporaneamente la homepage pubblica del sito, mettendo di fatto il sito "offline" per i visitatori, mantenendo però la coerenza grafica con il brand Ferri Ristrutturazioni. Il vecchio file `index.html` non verrà eliminato ma rinominato per essere ripristinato in futuro.

## Analisi del Problema e Requisiti
- **Design:** Stile coerente con il brand (colori Primario `#6EC1E4`, Secondario scuro `#28292b`, font Oswald/Inter).
- **Elemento Visivo Principale:** Un'icona SVG animata raffigurante un "cartello triangolare di pericolo cantiere con un operaio stilizzato e caschetto giallo".
- **Separatore Grafico:** Una "striscia da cantiere" diagonale a bande gialle e nere con la dicitura ripetuta "WORK IN PROGRESS".
- **Conformità Legale:** Reintegrazione esatta dei frammenti di codice Iubenda già presenti sul sito (Widget testuale della Cookie Solution in `<head>` e link Privacy/Cookie Policy nel footer).

## Modifiche Proposte
1. **Backup:** Rinominare l'attuale `index.html` in `index-nascosto.html`.
2. **Creazione:** Creare un nuovo file `index.html`.
3. **Struttura:** 
   - Utilizzo dello stylesheet statico compilato `assets/css/tailwind.css` e `assets/css/style.css`.
   - Strutturazione di un layout Full-Screen (`min-h-screen`, `flex`, `items-center`, `justify-center`).
   - Sviluppo diretto in pagina o in `style.css` di una `@keyframes` per animare il lavoratore o l'attrezzo dentro il triangolo (es. effetto martellamento o respiro animato).
   - Inserimento di un blocco div per ricreare la striscia (tramite `repeating-linear-gradient` giallo e nero `text-black` ecc).
   - Aggiunta script Iubenda completi.

## Piano di Verifica
1. Rinomina dei file via git/shell locale.
2. Generazione del nuovo markup HTML.
3. Apertura in dev/browser per controllare fluidità, responsive e correttezza dei banner Iubenda.
4. Push del file su ramo main per messa offline sul server Hostinger.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:** 
  - La homepage commerciale `index.html` è stata posta al sicuro col nominativo `index-nascosto.html`.
  - Distribuita in radice la nuova `index.html` d'attesa recante iconografie vettoriali animate CSS a tema edilizio e un fascione avvolgente d'avviso.
  - La cookie policy e la privacy list sono saldamente incastonate al loro posto a tutela legale.
- **Prossimi Passi:** Osservazione finale del sito spento da parte dell'owner.

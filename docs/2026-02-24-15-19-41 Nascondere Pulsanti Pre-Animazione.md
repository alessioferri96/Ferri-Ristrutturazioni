# Documento di Progetto: Nascondere Pulsanti Pre-Animazione

## Obiettivo
Accogliere la risolutiva richiesta del cliente di forzare visivamente la scomparsa iniziale (invisibilità di base) dei pulsanti della hero section (`index.html`) prima che l'animazione entri in gioco.

## Analisi del Problema
Nonostante l'utilizzo del `fill-mode: both`, su determinati browser, mobile o contesti di connessione la pagina stampa l'elemento di base (il div con i bottoni) nel primissimo tick di rendering prima di processare le regole avanzate del keyframe CSS, bypassandone in quell'istante il "nascondimento" e palesando i pulsanti.
Assegnando un'opacità iniziale statica a zero tramite l'utility Tailwind `opacity-0`, l'elemento "nasce" matematicamente invisibile sulla pagina (indipendentemente da animazioni, delay o latenze). Comparirà progressivamente al 100% solo grazie e nel momento esatto in cui entrerà in azione il costrutto `to { opacity: 1; }` dell'animazione.

## Modifiche Proposte
- Modificare il div contenitore dei bottoni all'interno di `index.html` aggiungendo la classe nativa Tailwind `opacity-0`.
- Nel css custom `style.css` faremo lo stesso backup logico assegnando `opacity: 0;` originario globale di default a quella famiglia animante.

## Piano di Verifica
1. Aggiornamento in `index.html` + `style.css`.
2. Commit and push delle modifiche.
3. Collaudo visivo del caricamento a pagina vuota da parte del cliente.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:**
  - Integrata in `index.html` la system-utility `opacity-0` a livello root del wrapper bottoni in attesa fiduciaria di delay.
  - Intercettate le classi custom d'animazione `.animate-fade-in-up/down` all'interno di `style.css` fortificando l'invisibilità genetica nativa (`opacity: 0;`). Questa doppia passata elude per sempre pre-render fallaci pre-caricamento.
- **Prossimi Passi:** Deploy con commit live per valutazione traguardo raggiunto da parte del fruitore.

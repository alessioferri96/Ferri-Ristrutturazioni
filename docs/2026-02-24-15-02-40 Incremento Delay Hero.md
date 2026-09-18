# Documento di Progetto: Incremento Delay Animazione Hero

## Obiettivo
Aumentare il ritardo di esecuzione (`animation-delay`) dell'animazione di ingresso dei pulsanti nella Hero Section di `index.html`. L'obiettivo è superare la soglia di 0.5 secondi (500ms) per garantire che l'animazione parta solo quando il browser ha stabilizzato il rendering completo della pagina, mitigando eventuali sfarfallii residui descritti dall'utente.

## Analisi del Problema
Nonostante l'applicazione del `fill-mode: both` e dell'accelerazione hardware sulla GPU, alcuni dispositivi o connessioni potrebbero percepire uno sfarfallio se l'animazione tenta di partire in concomitanza con il "First Contentful Paint" o il caricamento degli sfondi pesanti. Aumentando il delay oltre il mezzo secondo, diamo respiro al thread principale del browser per completare il rendering iniziale, ottenendo un'animazione pulita in differita.

## Modifiche Proposte
- Intervento sul file `index.html`.
- Localizzazione del contenitore dei pulsanti della Hero (che attualmente dovrebbe avere `style="animation-delay: 200ms;"` o simile).
- Sostituzione del valore con `style="animation-delay: 600ms;"` (che equivale a 0.6 secondi, maggiore quindi dei 0.5 secondi richiesti dall'utente).

## Piano di Verifica
1. Modifica del file `index.html`.
2. Push delle modifiche sul repository remoto.
3. Test visivo da parte dell'utente ricaricando la pagina live.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:** Aumentato drasticamente il ritardo dell'animazione d'ingresso sul contenitore dei bottoni in `index.html`, passandolo da `200ms` a `600ms`. Questo valore scarica ampiamente la congestione del processore durante il caricamento permettendogli di renderizzare la scena a scorrimento fluidamente.
- **Prossimi Passi:** Osservazione finale del caricamento live da parte dell'utente.

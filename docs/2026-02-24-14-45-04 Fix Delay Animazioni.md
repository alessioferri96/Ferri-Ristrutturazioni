# Documento di Progetto: Fix Sfarfallio "Pre-Animazione" Hero

## Obiettivo
Eliminare l'effetto visivo sgradevole in cui i bottoni (e altri elementi) compaiono fisicamente in pagina per una frazione di secondo *prima* di sparire e iniziare correttamente la loro animazione dal basso.

## Analisi del Problema
Il sintomo descritto ("vengono caricati prima e poi parte l'animazione") è inequivocabilmente dovuto all'interazione tra l'`animation-delay` inline (es. `style="animation-delay: 200ms;"`) e la proprietà CSS `animation-fill-mode`.
Attualmente `style.css` definisce:
```css
animation: fadeInUp 0.8s ease-out forwards;
```
Il valore `forwards` impone all'elemento di mantenere lo stile *finale* a fine animazione. Tuttavia, durante i 200 millisecondi di *attesa* antecedenti al via, l'elemento eredita lo stile base della pagina (ovvero pienamente visibile al suo posto!). Finito il delay, "salta" al punto di partenza scatenando lo sfarfallio.

## Modifiche Proposte
La correzione è facilissima ed estremamente efficace. Dobbiamo dire al browser di applicare lo stile del primo fotogramma (`from { opacity: 0; }`) **anche durante l'attesa del delay**. La proprietà che assolve contemporaneamente al mantenimento *prima* e *dopo* l'animazione si chiama `both`.
Sostituirò `forwards` con `both` in `assets/css/style.css` sia per `.animate-fade-in-up` che per `.animate-fade-in-down`.

## Piano di Verifica
1. Sostituire `forwards` con `both` nel CSS custom.
2. Eseguire push su repository origin.
3. Test cliente.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:**
  - Sostituita la direttiva `forwards` con `both` nelle classi relative alle animazioni di ingresso (`.animate-fade-in-up` e `down`) nel file `style.css`. Questa action estende lo stato primario dei keyframes all'indietro per tutta la durata preassegnata ai delay d'animazione HTML, scongiurando balzi d'opacità/rendering.
  - Generata nuova build su Git inviata ad Hostinger.
- **Prossimi Passi:** L'utente esaminerà per l'ultima volta lo strato visivo della Hero per approvare definitivamente l'impalcatura animativa.

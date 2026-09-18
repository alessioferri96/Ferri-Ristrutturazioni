# Progetto: Timeline Scroll Effect

**Data:** 2026-02-19
**Autore:** Antigravity (Assistant)
**Stato:** In attesa di approvazione

## Obiettivo
L'obiettivo è implementare un effetto visivo sulla timeline della pagina `chi-siamo2.html` dove la linea verticale grigia si riempie progressivamente di colore blu (`bg-primary`) seguendo lo scroll dell'utente dall'alto verso il basso.

## Dettagli Implementativi

### 1. Modifiche HTML (`chi-siamo2.html`)
Attualmente la linea verticale è definita come:
```html
<div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-gray-300 transform md:-translate-x-1/2">
</div>
```

Verrà modificata in un contenitore relativo per ospitare due linee sovrapposte:
1.  **Linea Base (Grigia):** La linea esistente.
2.  **Linea Progresso (Blu):** Una nuova linea assoluta, posizionata sopra la base, con `bg-primary`, `height: 0` iniziale e `transition-height` impostata via JS o diretta, per fluidità.

Codice proposto:
```html
<!-- Timeline Vertical Line Container -->
<div id="timeline-line-container" class="absolute left-4 md:left-1/2 top-0 bottom-0 w-px bg-gray-300 transform md:-translate-x-1/2 overflow-hidden">
    <div id="timeline-progress-bar" class="absolute top-0 left-0 w-full bg-primary h-0 transition-height duration-100 ease-linear"></div>
</div>
```

### 2. Modifiche JavaScript (`assets/js/main.js`)
Aggiunta di una logica di scroll listener specifica per la timeline.

**Algoritmo:**
1.  Identificare l'elemento contenitore della timeline (`#timeline-section` o simile, da aggiungere se manca un ID specifico).
2.  Identificare `#timeline-line-container` o `#timeline-progress-bar`.
3.  Al verificarsi dell'evento `scroll`:
    *   Calcolare la posizione `top` della sezione timeline rispetto alla viewport.
    *   Calcolare l'altezza totale della timeline.
    *   Determinare quanto l'utente ha "scrollato" dentro la sezione.
    *   Calcolare una percentuale da 0% a 100%.
    *   Applicare `style.height = percentage + '%'` all'elemento `#timeline-progress-bar`.

**Considerazioni Mobile:**
L'effetto deve funzionare anche su mobile dove la linea è allineata a sinistra (`left-4`). Essendo basato sulla modifica dell'altezza di un div `w-px` posizionato nello stesso contenitore, il responsive è gestito automaticamente dalle classi Tailwind esistenti.

### 3. Modifiche CSS (`assets/css/style.css`)
Nessuna modifica critica, si useranno le classi utility di Tailwind o stili inline via JS.

### 4. Phase 2: Point Animation (Traguardi)
Quando la linea blu raggiunge un punto ("traguardo"), questo deve:
1.  Diventare interamente blu (rimuovere/colorare il bordo bianco).
2.  Ingrandirsi leggermente (`scale-125` o simile).
3.  Avere un effetto pulsazione (`animate-pulse` o custom keyframes).

**Implementazione:**
*   **HTML:** Aggiungere classe identificativa `.timeline-point` ai div dei pallini.
*   **CSS:** Aggiungere classe `.timeline-point.active` con gli stili richiesti (border-primary, scale, box-shadow/pulse).
*   **JS:** Nel loop `updateTimeline`, controllare la posizione di ogni `.timeline-point`. Se `lineHeight >= pointTop`, aggiungere la classe `active`.

### 5. Phase 3: Content Reveal (Sync with Line)
Gli elementi di contenuto (Testo e Immagini) devono apparire in fade-in solo quando il punto centrale viene attivato dalla linea.

**Implementazione:**
*   **HTML:**
    *   Rimuovere la classe `scroll-reveal` dai container della timeline per evitare conflitti.
    *   Aggiungere classi `timeline-text` e `timeline-img` ai rispettivi blocchi.
    *   Aggiungere classe `opacity-0` iniziale.
*   **CSS:**
    *   Stile per `timeline-content-visible` che imposta `opacity: 1` e `transform: translateY(0)`.
*   **JS:**
    *   Nell'evento `active` del punto, trovare i fratelli (o parent/children) che corrispondono a testo e immagine.
    *   Aggiungere la classe `timeline-content-visible`.
    *   Opzionale: aggiungere un piccolo delay tra testo e immagine.

## Riepilogo Post-Implementazione
*(Da compilare a lavori ultimati)*
- [x] Implementazione HTML completata
- [x] Implementazione JS completata
- [ ] Verifica estetica Desktop
- [ ] Verifica estetica Mobile

# Documento di Progetto: Fix Sfarfallio Animazione Hero

## Obiettivo
Risolvere il problema di fluidità (sfarfallio/jitter) riscontrato durante l'animazione di entrata dal basso (`fade-in-up`) dei pulsanti presenti nella Hero Section della pagina `index.html`, sia su mobile che su desktop.

## Analisi del Problema
Le animazioni CSS che coinvolgono trasformazioni (come `translate`) possono talvolta risultare poco fluide (jittering) o causare artefatti visivi se il browser non utilizza l'accelerazione hardware (GPU) per gestire il rendering dell'elemento, o se ci sono conflitti con sub-pixel rendering.

## Modifiche Proposte
La procedura standard per forzare l'hardware acceleration e migliorare drasticamente la resa visiva delle animazioni CSS è l'utilizzo di alcune proprietà specifiche:
1. Abbiamo constatato che in `assets/css/style.css` è già presente il `translate3d` nei keyframes.
2. Verranno aggiunte le seguenti istruzioni cruciali alla classe delegata (`.animate-fade-in-up` / `down`):
   - `will-change: transform, opacity;` (istruisce preventivamente il browser).
   - `backface-visibility: hidden;` e `transform-style: preserve-3d;` (evitano il sub-pixel rendering alias sfarfallio quando le transition lavorano in layering).
3. Salveremo il file minificando Tailwind se necessario, sebbene toccheremo solo le classi testuali di animazione base.

## Piano di Verifica
1. Analizzare `style.css` / `tailwind.config.js` per trovare l'animazione `animate-fade-in-up`.
2. Applicare le correzioni hardware-accelerated.
3. Compilare CSS (se modificato build Tailwind) o aggiornare `style.css`.
4. Deploy e validazione cliente.

## Riepilogo Post-Implementazione
*Da compilare a fine lavori*

# Foto del locale di Frascati — 30 ottobre 2026

## Selezione

Esaminate tutte le 19 immagini nei quattro sottogruppi di `C:\Users\aless\Desktop\Ditta Ferri\Foto lavoro Vincenzo` (comprese le copie Prima/Durante/Dopo) e confrontate con le immagini già presenti nel progetto.

Cinque fotografie del 30 ottobre selezionate: panoramica (3), parete in pietra (2), cucina (1), bagno (senza suffisso), Dopo (4). Per il confronto è stata usata come sorgente proprio la fotografia (4) della cartella `Dopo`. Le due fotografie Prima e Durante non sono state sostituite.

La pagina ha una nuova foto di apertura, una panoramica a lavori conclusi, un dettaglio della parete in pietra, otto miniature e dodici foto ingrandibili. La selezione mescola il risultato arredato con immagini reali del cantiere e dettagli strutturali già presenti. I vecchi file non sono stati eliminati né sovrascritti. Non sono più incluse nella galleria le due immagini chiamate `unsplash`.

## Ritocco e file

Ritocco effettuato con lo strumento immagini integrato (non CLI), con le stesse istruzioni per ciascuna delle cinque fotografie:

> Use case: lighting-weather, conservative documentary photo correction only. Input image 1 is the EDIT TARGET, a real completed renovation photograph for a builder's portfolio, NOT a design reference. Improve only photographic exposure, natural white balance, shadow readability and gentle detail clarity, reduce JPEG noise. Very subtle professional correction, NOT HDR, NOT a rendering. Keep the exact original camera viewpoint, original crop/aspect ratio, ALL architecture, stone texture, beams, furniture, equipment, cables, unfinished details, objects, lights, colors and spatial proportions unchanged. Do not remove clutter or add or repair any object. No new detail invented, no structural changes, no text, no watermark. It must remain a faithful photograph of the actual work. Output one corrected photo, not a collage.

PNG ritoccati salvati in `C:\Users\aless\Documents\Codex\2026-10-01\ferri-ristrutturazioni-gestione\outputs\foto-frascati-20261030\ritoccate`. Gli originali sul Desktop sono intatti.

Asset pubblici nuovi: `assets/img/locale-frascati-20261030-{panoramica,dopo,pietra,cucina,bagno}.webp` e corrispondenti versioni `-800.webp`. Queste ultime hanno lato maggiore 800 px (il bagno ha larghezza effettiva 600 px). Nessun ingrandimento artificiale. I cinque file principali totalizzano 859.802 byte, circa il 27% in meno dei cinque JPEG sorgente selezionati. Le versioni ridotte sono utilizzate con `srcset` nelle miniature e nel confronto. Rimossi i filtri di saturazione/contrasto aggiuntivi dalle nuove immagini per evitare una doppia correzione.

## Verifiche e stato

Controllati layout a 390 e 1440 px, immagini, confronto e comandi Home/End/frecce, otto miniature e dodici immagini ingrandite, corrispondenza tra miniature e ingrandimenti e assenza di errori JavaScript. Corretto il salto del cursore da 0 a 55 usando la freccia destra e aggiunta apertura delle miniature con Invio/Spazio. `git diff --check` superato.

Anteprima locale: `http://127.0.0.1:8765/progetto-locale-frascati.html`. Nessuna pubblicazione e nessun push effettuati in questa fase.

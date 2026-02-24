# Documento di Progetto: Ottimizzazione Scroll Mobile

## Obiettivo
Analizzare e risolvere un problema visivo segnalato dall'utente: uno "scatto" durante lo scroll su dispositivi mobili che causa una percezione di reset e ricalcolo del layout delle sezioni.

## User Review Required
> [!NOTE]
> Nessuna revisione richiesta al momento. Sto analizzando il codice per individuare la causa. Spesso questo problema è causato dall'uso dell'unità `100vh` su mobile, dove la barra degli indirizzi a comparsa/scomparsa innesca ricalcoli continui del layout, oppure da animazioni JS legate allo scroll che non sono ottimizzate.

## Proposed Changes
### Risoluzione Salti Layout (Viewport Units)
Ho identificato la causa principale: nelle sezioni `Hero` dei file principali è utilizzata la classe Tailwind Custom `min-h-[100dvh]` (e `h-[100dvh]` in progetti.html).
Il valore `dvh` (Dynamic Viewport Height) si adatta costantemente all'altezza reale dello schermo. Su mobile, quando l'utente fa scroll in basso, la barra del browser (Chrome/Safari) spesso si nasconde, aumentando lo spazio a disposizione. `dvh` rileva questo cambiamento e ricalcola all'istante l'altezza della sezione, spingendo il resto del contenuto e causando un fastidioso scatto o ricarimento visivo.

**Soluzione:** Sostituiremo `100dvh` con `100svh` (Small Viewport Height). `svh` prende la misura più piccola (con la barra degli indirizzi visibile) e **non** la ricalcola quando questa scompare. Pertanto l'altezza resterà fissa e non ci saranno "salti".

#### [MODIFY] index.html
Sostituire `min-h-[100dvh]` con `min-h-[100svh]`.
#### [MODIFY] chi-siamo.html
Sostituire `min-h-[100dvh]` con `min-h-[100svh]`.
#### [MODIFY] servizi.html
Sostituire `min-h-[100dvh]` con `min-h-[100svh]`.
#### [MODIFY] progetti.html
Sostituire `h-[100dvh]` con `h-[100svh]`.

## Verification Plan
- Testare le pagine su un simulatore mobile (o fisicamente su uno smartphone) per verificare che lo scorrimento risulti fluido e privo di salti.

## Riepilogo Post-Implementazione
*Da compilare a fine lavori*

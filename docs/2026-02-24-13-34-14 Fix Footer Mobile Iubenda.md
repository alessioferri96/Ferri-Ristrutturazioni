# Documento di Progetto: Fix Visibilità Link Policy su Footer Mobile

## Obiettivo
Garantire che i link "Privacy Policy" e "Cookie Policy" di Iubenda siano visibili e ben formattati nel footer su dispositivi mobili (schermi stretti).

## Analisi del Problema
Nel tag HTML, la struttura attuale del footer contiene una classe `flex gap-6` (oppure `flex gap-4`) per i link:
```html
<div class="flex gap-6">
    <a href="...">Privacy Policy</a>
    <a href="...">Cookie Policy</a>
    <!-- Icone Social -->
```
Su schermi piccoli, inserendo testi lunghi come "Privacy Policy", la riga `flex` senza wrap (invio a capo) fa trasbordare (overflow) il contenuto fuori dallo schermo o lo fa sovrapporre ad altri elementi, nascondendolo alla vista.

## Proposed Changes
> [!TIP]
> Trasformeremo `flex` in una struttura adatta al mobile (in colonna) e la faremo tornare in riga su Desktop (`md:flex-row`). 

Dobbiamo modificare il blocco del footer nei file `index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html`, `contatti.html`:
- Sostituire `<div class="flex gap-6">` con `<div class="flex flex-col md:flex-row gap-4 md:gap-6 items-center">` o `flex-wrap` permettendo ai link un posizionamento sicuro.

Da così:
`<div class="flex gap-6">`
A così:
`<div class="flex flex-wrap text-center justify-center gap-4 md:gap-6 items-center mt-4 md:mt-0">`

## Verification Plan
1. Ricerca della riga esatta nei footer.
2. Sostituzione delle classi Tailwind.
3. Commit e push.
4. Test e verifica del footer responsive da smartphone.

## Riepilogo Post-Implementazione
- **Stato:** Completato.
- **Modifiche Effettuate:** Aggiunte le classi Tailwind `flex-wrap`, `justify-center` e `mt-4 md:mt-0` ai div container dei link Iubenda nei file `index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html` e `contatti.html`. Questo permette discesa a capo automatica su schermi piccoli senza rompere il layout desktop.
- **Prossimi Passi:** L'utente verificherà l'effettiva visualizzazione completa dei link dal suo smartphone.

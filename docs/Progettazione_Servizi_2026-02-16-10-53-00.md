# Progetto: Pagina Servizi - Bento Grid & Dashboard (Approved)

**Data:** 2026-02-16
**Concept Selezionato:** #3 (Bento Grid) + CTA Finale (#2).
**Obiettivo:** Creare una pagina servizi moderna, organizzata a moduli, che offra una panoramica chiara dell'offerta di Ferri Ristrutturazioni.

---

## Dettagli Layout & Contenuti

### 1. Hero Section (Strict Consistency)
-   **Altezza:** `min-h-[100dvh]`.
-   **Visual:** Sfondo scuro/architettonico (linee blueprint o texture cemento scuro).
-   **Titolo:** "SOLUZIONI COSTRUTTIVE INTEGRATE" (Oswald).
-   **Sottotitolo:** "Dalla progettazione alla consegna chiavi in mano" (Inter).

### 2. Bento Grid (Il Core)
Una griglia CSS/Grid asimmetrica per presentare i macro-servizi.
-   **Card XL (Main):** "Ristrutturazione Completa" - Immagine/Video loop background. Focus su residenziale di lusso.
-   **Card Verticale:** "Impiantistica Avanzata" - Lista iconica (Domotica, Idraulica, Elettrica).
-   **Card Orizzontale:** "Interior Design" - Focus su render e materiali.
-   **Card Small:** "Pratiche Edilizie" - Icona documento/timbro.
-   **Interazione:** Hover su ogni blocco scala leggermente e rivela un dettaglio o cambia colore del bordo (Primary).

### 3. FAQ Section (Supporto)
-   Accordion pulito (apri/chiudi) per rispondere a dubbi comuni (Tempi, Costi, Detrazioni).

### 4. CTA Finale (Dal Concept 2)
-   **Design:** Banda full-width color Primary (`#6EC1E4`) o Scuro con bordo Primary.
-   **Copy:** "Hai un progetto complesso in mente? Parliamone."
-   **Azione:** Bottone bianco/trasparente "Richiedi Consulenza" che porta a `#contatti`.

---

## Piano di Implementazione Tecnico

### File: `servizi.html`
1.  Clonazione struttura `index.html` (Header/Footer identici).
2.  **Hero:** Adattamento testi e sfondo.
3.  **Grid Section:**
    -   Container `grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4`.
    -   Utilizzo di `col-span-2`, `row-span-2` per creare l'effetto Bento.
4.  **FAQ:**
    -   Utilizzo del tag `<details>` e `<summary>` stilizzati con Tailwind (semplice, accessibile, senza JS pesante) oppure logica custom in `main.js` se serve animazione fluida.
5.  **CTA:** Sezione semplice con flexbox centrato.

### File: `assets/js/main.js`
-   Verifica funzionamento FAQ (se JS driven).
-   Verifica navigazione menu.

## Riepilogo Post-Implementazione
*(Da compilare a fine lavori)*
-   [ ] Pagina `servizi.html` creata.
-   [ ] Bento Grid responsive (su mobile diventa colonna unica).
-   [ ] Header/Footer coerenti.

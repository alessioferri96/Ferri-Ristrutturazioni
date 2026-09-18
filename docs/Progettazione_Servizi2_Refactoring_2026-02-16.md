# Progetto: Refactoring Pagina Servizi v2 (Strict Consistency)

**Obiettivo:** Ricreare `servizi2.html` mantenendo il layout "Immersive/Parallax" ma garantendo una **totale coerenza** estetica e strutturale con `index.html`.

## 1. Elementi Coerenti (Da `index.html`)
*   **Header:** Stesso codice identico (Logo, Menu Toggle, effetti scroll), classi Tailwind `fixed w-full top-0 z-50...`.
*   **Hero Section:** Altezza 100vh (`min-h-[100dvh]`), stessi font (Oswald/Inter), stesse animazioni `fade-in-up`, overlay scuro standard.
    *   *Differenza:* Titolo specifico "I Nostri Servizi".
*   **Footer:** Stesso codice identico (Sezione Contatti, Navigazione, Copyright).
*   **Tipografia:**
    *   Titoli: `font-display font-bold uppercase tracking-tighter`.
    *   Testi: `font-sans font-light text-gray-600` (o gray-300 su dark).
    *   Colori: Primary `#6EC1E4`, Secondary `rgb(40, 41, 43)`, Accent `#61CE70`.

## 2. Layout "Immersive" Adattato
Invece di stravolgere il design, useremo sezioni alternate (Zig-Zag) o Full-Width che rispettano il grid system del sito.

**Struttura Sezioni Servizi (x4):**
*   **Opzione A (Alternata):** Immagine 50% / Testo 50%.
    *   Simile alla sezione "Chi Siamo" o "Progetti" della Home.
    *   Mantiene l'eleganza ma è più leggibile.
*   **Opzione B (Full Width con Card):** Sfondo Parallax, ma il contenuto è dentro un container/card (come la sezione Hero).

*Decisione:* Useremo un approccio **Full Screen Section** ma con i componenti UI standard del sito (bottoni, linee divisorie, font sizes).

## 3. Sezione FAQ (8 Voci)
*   StileAccordion identico a quello già approvato in `servizi.html` (o `index.html` se presente), ma esteso a 8 voci.
*   Sfondo: `bg-white` o `bg-gray-50`.
*   Titolo: Standard H2 della Home (`text-4xl...`).

## 4. Piano di Azione
1.  Copia brutale di `index.html` per avere l'impalcatura perfetta (Header/Footer/Scripts).
2.  Svuotamento del `<main>`.
3.  Inserimento Hero specifica "Servizi".
4.  Inserimento 4 Sezioni Servizi (Ristrutturazioni, Impianti, Design, Pratiche) usando le classi CSS del sito.
5.  Inserimento FAQ Section (8 items).
6.  Verifica che non ci siano stili inline "strani" o font diversi.

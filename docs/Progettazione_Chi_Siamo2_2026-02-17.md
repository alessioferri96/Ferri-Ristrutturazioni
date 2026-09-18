# Progetto: Pagina Chi Siamo v2 (Editorial + Timeline)

**Obiettivo:** Creare `chi-siamo2.html` unendo l'eleganza del layout "Editorial Grid" (Prop 2) con la narrazione della "Timeline Story" (Prop 1).

## 1. Struttura Generale
*   **Header & Footer:** Identici a `index.html` e `servizi2.html` (Strict Consistency).
*   **Hero Section:** Standard Hero (100vh) con immagine emozionale e titolo "La Nostra Storia / Il Nostro Metodo".

## 2. Sezione 1: Editorial Grid (La Visione)
Un layout asimmetrico per presentare l'azienda e il fondatore.
*   **Layout:**
    *   **Blocco A (Intro):** Colonna SX Immagine (Verticale) + Colonna DX Testo "Chi Siamo".
    *   **Blocco B (Quote):** Una grande citazione del fondatore ("Costruiamo fiducia, non solo muri") centrata o a tutta larghezza con font Oswald enorme.
    *   **Blocco C (Metodo):** Colonna SX Testo "La Nostra Filosofia" + Colonna DX Immagine dettaglio.
*   **Stile:** Spazi bianchi generosi, tipografia curata, immagini con shadow/hover discreti.

## 3. Intermezzo: I Numeri (Transition)
Una fascia orizzontale (Background Primary o Dark) con 3-4 contatori (Anni di esperienza, Cantieri, Clienti). Funge da stacco visivo tra la teoria (Grid) e la storia (Timeline).

## 4. Sezione 2: Timeline Story (La Storia)
Un percorso verticale che racconta l'evoluzione dell'azienda.
*   **Struttura:** Linea centrale verticale.
*   **Items:** Anni chiave (es. 2010, 2015, 2020, 2026) alternati sinistra/destra.
*   **Contenuto per Item:** Anno (Oswald Big), Titolo breve, Paragrafo descrittivo.
*   **Interazione:** Gli elementi appaiono (Fade In) man mano che scendono nel viewport.

## 5. File
*   [NEW] `chi-siamo2.html`

## 6. Piano di Lavoro
1.  [ ] Setup `chi-siamo2.html` da `index.html` (Base template).
2.  [ ] Implementazione Sezione Editorial Grid.
3.  [ ] Implementazione Fascia Numeri.
4.  [ ] Implementazione Timeline Verticale (CSS + Scroll Reveal classico).
5.  [ ] Verifica Mobile (Timeline diventa lista verticale semplice).

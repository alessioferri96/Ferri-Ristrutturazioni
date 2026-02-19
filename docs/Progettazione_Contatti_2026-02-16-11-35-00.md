# Progetto: Pagina Contatti - Map Integration Focus (Approved)

**Data:** 2026-02-16
**Concept Selezionato:** #2 (Map Integration Focus).
**Obiettivo:** La mappa è protagonista, suggerendo la fisicità e la presenza sul territorio, con un form "fluttuante".

---

## Dettagli Layout & Contenuti

### 1. Map Hero (Core)
-   **Struttura:** Mappa che occupa la parte superiore della viewport (`h-[70vh]`).
-   **Style:** Dark Mode / Custom Style (scala di grigi) tramite Google Maps Embed API o Leaflet (o placeholder statico ad alta risoluzione se senza API key) con overlay leggero per leggibilità.
-   **Marker:** Icona personalizzata (Brand Color) sulla sede "Ferri Ristrutturazioni".

### 2. Floating Contact Card
-   **Posizione:** Sovrapposta alla mappa, centrata o laterale (top-right/left) con margine.
-   **Stile:** Card bianca (o Glassmorphism scuro), ombra profonda (`shadow-2xl`).
-   **Contenuto:** Form compatto ma completo: Nome, Email, Telefono, Messaggio, Checkbox Privacy, CTA "Invia Richiesta".

### 3. Info Grid (Sotto la Mappa)
-   **Layout:** 3 colonne (o flex row) sotto la sezione mappa.
-   **Blocchi:**
    1.  **Showroom:** Indirizzo, Orari Apertura/Chiusura (lun-ven), "Parcheggio Clienti".
    2.  **Ufficio Tecnico:** Email diretta preventivi, Telefono urgenze.
    3.  **Lavora con Noi:** Link a pagina carriere o email HR "Invia CV".
-   **Stile:** Sfondo `bg-gray-50` o `bg-white`, icone minimal.

### 4. Footer
-   Standard (come Home/Chi Siamo/Servizi/Progetti).

---

## Piano di Implementazione Tecnico

### File: `contatti.html`
1.  **Header:** Standard.
2.  **Hero/Map Section:**
    -   `div.relative h-[70vh]`
    -   `iframe` Google Maps (grayscale filter via CSS `.grayscale`) o Immagine statica se preferito per performance.
    -   `div.absolute` per la Floating Card (z-index alto).
3.  **Info Grid:** `section` classica a 3 colonne.
4.  **Footer:** Standard.

### Integrazione Navigazione
-   Aggiornare link "Contatti" in Navbar e Footer di tutte le pagine (`index.html`, `chi-siamo.html`, `servizi.html`, `progetti.html`) per puntare a `contatti.html`.

## Riepilogo Post-Implementazione
*(Da compilare a fine lavori)*
-   [ ] Pagina `contatti.html` creata.
-   [ ] Mappa integrata e stilizzata.
-   [ ] Form fluttuante responsive.
-   [ ] Link aggiornati su tutto il sito.

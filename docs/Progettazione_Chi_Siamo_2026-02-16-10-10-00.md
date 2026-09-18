# Progetto: Pagina Chi Siamo - Evoluzione Temporale (Selected)

**Data Inizio Design:** 2026-02-16
**Stato:** Approvato (Concept "Evoluzione Temporale")
**Obiettivo:** Creare una pagina "Chi Siamo" che narri la storia dell'azienda attraverso una timeline verticale interattiva, mantenendo lo stile premium del sito.

---

## Dettagli Tecnici & Layout

### 1. Hero Section (Fullscreen Impact)
-   **Visual:** Sfondo video/immagine (b/n o desaturato) con overlay scuro.
-   **Contenuto:**
    -   Titolo: "DAL PROGETTO ALLA REALTÀ" (Oswald, Bold, Uppercase).
    -   Sottotitolo: "Una storia di passione e precisione costruttiva" (Inter, Light).
    -   Call to Action (Scroll Down): Freccia animata verso il basso.
-   **Animazioni:** Fade-in-up all'apertura.

### 2. Timeline Verticale (Core Feature)
-   **Struttura:**
    -   Linea centrale continua (border-left o div assoluto) color `primary` (#6EC1E4).
    -   Items alternati (Sinistra / Destra) su desktop. Su mobile, tutti allineati a sinistra con la linea sul bordo.
-   **Contenuto Items (Milestones):**
    -   **2015:** "Le Fondamenta" - Nascita dell'azienda.
    -   **2018:** "Prima Grande Sfida" - Completamento di un complesso residenziale importante.
    -   **2021:** "Espansione" - Apertura divisione "Interni & Design".
    -   **2024:** "Oggi" - Certificazioni ISO e focus sulla sostenibilità.
-   **Interazione:**
    -   Ogni item ha opacità 0 e `transform: translateY(20px)` di default.
    -   Quando entra nel viewport (`IntersectionObserver`), classe `is-visible`: Opacità 1, Transform 0.
    -   Il "dot" sulla linea centrale si illumina (scale up + color change) quando l'item è attivo.

### 3. Team Section (Valore Umano)
-   **Layout:** Griglia 3 o 4 colonne (responsive).
-   **Card:** Foto in scala di grigi che diventa a colori all'hover.
-   **Dati:** Nome e Ruolo sotto la foto.

### 4. Valori / Manifesto (Chiusura)
-   Sezione testo centrata su fondo scuro (`secondary`).
-   Elenco puntato stilizzato o griglia icone per i valori core: Sicurezza, Qualità, Trasparenza.

---

## Piano di Implementazione Tecnico

### File: `chi-siamo.html`
-   Creazione file basato su struttura `index.html`.
-   **Nuovo CSS Tailwind Custom:** Utilizzo di classi standard + estensioni arbitrarie per la timeline (es. `left-1/2`, `-translate-x-1/2` per la linea).

### File: `assets/js/main.js`
-   Aggiunta logica specifica per timeline se necessario, o riutilizzo `IntersectionObserver` esistente potenziato.
-   Verifica che la navbar gestisca correttamente il link attivo "Chi Siamo".

### Assets
-   Recupero immagini placeholder da Unsplash (tema cantiere/architettura/team).

## Riepilogo Post-Implementazione
**Data:** 2026-02-16
**Stato:** Completato

### Interventi Effettuati:
1.  **Pagina `chi-siamo.html`:** Creata con successo seguendo il layout "Timeline Evolution".
    -   Hero Fullscreen con titolo animato.
    -   Timeline Verticale responsive (Items alternati su desktop, lineari su mobile).
    -   Sezione Team con 3 card interattive.
2.  **Navigazione:**
    -   Aggiornato link "Chi Siamo" in `index.html` per puntare alla nuova pagina.
    -   Aggiornato menu mobile in `assets/js/main.js` per usare link assoluti/relativi corretti (es. `index.html#servizi`) permettendo il ritorno alla home dalle pagine interne.
3.  **Animazioni:**
    -   Implementato `IntersectionObserver` specifico per l'entrata degli elementi della timeline.

### Note per il futuro:
-   Le immagini sono placeholder di Unsplash e andranno sostituite con foto reali dell'azienda.
-   I testi della timeline sono fittizi e andranno rivisti con il copy definitivo.

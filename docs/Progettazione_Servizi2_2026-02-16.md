# Progetto: Pagina Servizi v2 (Immersive Parallax)

**Obiettivo:** Creare una nuova pagina servizi (`servizi2.html`) caratterizzata da un layout "Immersive Scroll" (Opzione 2), dove ogni servizio occupa una sezione full-screen con effetti parallax. Includere una sezione FAQ espansa (8 voci) alla fine.

## 1. Struttura Generale
*   **Header & Footer:** Identici a `index.html` e altre pagine per coerenza.
*   **Layout:** Sequenza di sezioni `min-h-screen` (100vh) o `min-h-[80vh]`.

## 2. Sezioni "Immersive Service"
Ogni servizio avrà:
*   **Background:** Immagine full-cover con overlay gradiente (scurisce sui lati/basso per leggibilità).
*   **Effetto Parallax:** L'immagine di sfondo si muove leggermente più lenta dello scroll (tramite CSS `bg-fixed` o JS semplice).
*   **Contenuto:**
    *   **Titolo:** Grande tipografia (Oswald), animazione fade-in-up.
    *   **Descrizione:** Breve paragrafo introduttivo.
    *   **Lista Dettagli:** 3-4 punti chiave con icone minimal.
    *   **CTA:** Pulsante "Richiedi Preventivo" specifico per quel servizio.

**Lista Servizi da Includere:**
1.  Ristrutturazioni Complete (Residenziale/Commerciale)
2.  Impiantistica e Domotica
3.  Interior Design
4.  Pratiche Edilizie

## 3. Sezione FAQ Espansa
*   **Posizione:** In fondo alla pagina, prima del Footer.
*   **Design:** Griglia a 1 o 2 colonne per gli accordion, stile pulito (sfondo bianco/grigio chiaro).
*   **Contenuto:** 8 domande frequenti su tempi, costi, permessi, garanzie, ecc.

## 4. File
*   [NEW] `servizi2.html`

## 5. Script & Stili
*   Uso di Tailwind CSS standard.
*   Script esistenti (`main.js`) per menu e scroll reveal.
*   Eventuale aggiunta di script inline per logica accordion se diversa dallo standard `details/summary`.

## 6. Piano di Lavoro
1.  [ ] Creare `servizi2.html` clonando la struttura base.
2.  [ ] Implementare le 4 sezioni Parallax dei servizi.
3.  [ ] Implementare la sezione FAQ con 8 accordion.
4.  [ ] Verificare responsive (mobile stacking) e navigazione.

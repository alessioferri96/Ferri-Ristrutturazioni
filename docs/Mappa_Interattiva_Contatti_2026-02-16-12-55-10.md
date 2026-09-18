# Documento di Progetto: Mappa Interattiva Contatti

**Data:** 2026-02-16
**Ora:** 12:55:00
**Autore:** Gemini (Assistente AI)
**Stato:** In Attesa di Approvazione

## 1. Obiettivo
Sostituire l'attuale immagine statica della mappa nella pagina `contatti.html` con una mappa interattiva funzionante, basata su Leaflet.js, mantenendo lo stile grafico "Premium" e coerente del sito (toni di grigio, marker personalizzato).

## 2. Tecnologie Scelte
Per garantire interattività senza costi immediati o complessità di API Key (come Google Maps), utilizzeremo:
*   **Leaflet.js:** Libreria JavaScript open-source leggera e mobile-friendly per mappe interattive.
*   **CartoDB Positron (No Labels/Lite):** Tile layer gratuito che offre uno stile visuale pulito, grigio chiaro e minimale, perfetto per l'estetica di Ferri Ristrutturazioni.

## 3. Dettagli Implementativi

### 3.1. Modifiche a `contatti.html`
*   **Rimozione:** Sostituzione del `div` con `background-image` statico attuale.
*   **Nuovo Container:** Inserimento di un `div#map` che occuperà il 100% dell'altezza/larghezza del genitore (`h-[80vh]`).
*   **Inclusione Risorse:** Aggiunta del CSS e JS di Leaflet via CDN nel `<head>` (o prima della chiusura del `body`).

### 3.2. Stile e Personalizzazione (`main.js` o script inline)
*   **Inizializzazione:** Mappa centrata su Milano (Via Alessandro Volta, 42 - coordinate fittizie o reali approssimate: 45.4800, 9.1860).
*   **Tile Layer:** Utilizzo di `https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png` per il look "bianco e nero/grigio".
*   **Marker Personalizzato:** Creazione di un `L.icon` personalizzato utilizzando un pin colorato con i colori del brand (`#6EC1E4` primary), per replicare il design del marker statico attuale ma rendendolo cliccabile.
*   **Popup:** Al click sul marker, si aprirà un popup con le informazioni essenziali (Nome Azienda, Indirizzo, Link "Indicazioni").

### 3.3. Gestione Overlay
Il form di contatto "fluttuante" (`floating contact card`) rimarrà sovrapposto alla mappa grazie a `z-index` e posizionamento assoluto, garantendo che la mappa sia navigabile (zoom/pan) nelle aree libere ma che il form sia sempre accessibile. Necessario impostare `z-index` della mappa inferiore al form.

## 4. Piano di Rilascio
1.  Backup `contatti.html`.
2.  Implementazione HTML/JS.
3.  Test preventivo di navigazione e sovrapposizione su mobile/desktop.
4.  Rilascio finale.

## 5. Riepilogo Post-Implementazione
*(Da compilare a lavori ultimati)*
- [ ] Mappa Leaflet integrata.
- [ ] Stile Grayscale applicato.
- [ ] Marker custom funzionante.
- [ ] Form fluttuante preservato.

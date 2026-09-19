# Creazione Pagine Dedicate Progetti

**Data:** 2026-03-13
**Tipo:** Nuova funzionalità

## Descrizione

Creare 3 pagine dedicate per ogni progetto, con layout editoriale stile rivista di design: immagini d'impatto e brevi blocchi di testo. Le pagine saranno raggiungibili sia dalle slide in `progetti.html` ("Scopri il Progetto") sia cliccando sulle card in `index-nascosto.html`.

## Pagine da Creare

### 1. `progetto-villa-tuscolana.html`
- Tipo: Residenziale
- Location: Castelli Romani
- Layout: Hero full-width + griglia editoriale con immagini e testi

### 2. `progetto-locale-frascati.html`
- Tipo: Commerciale
- Location: Frascati
- Layout: Hero full-width + griglia editoriale con immagini e testi

### 3. `progetto-residenza-grottaferrata.html`
- Tipo: Residenziale
- Location: Grottaferrata
- Layout: Hero full-width + griglia editoriale con immagini e testi

## Link da Aggiornare

### progetti.html
- Slide 1 "Scopri il Progetto" → progetto-villa-tuscolana.html
- Slide 2 "Scopri il Progetto" → progetto-locale-frascati.html
- Slide 3 "Scopri il Progetto" → progetto-residenza-grottaferrata.html

### index-nascosto.html
- Card "Locale Commerciale - Frascati" → progetto-locale-frascati.html
- Card "Residenza Privata - Grottaferrata" → progetto-residenza-grottaferrata.html

## Design
- Stile rivista di design / editoriale
- Immagini full-width e a griglia, impattanti
- Testi brevi, tipografia pulita
- Header/footer coerenti con il resto del sito

## Verification Plan
- Verifica visiva a cura dell'utente

## Riepilogo Post-Implementazione

### Pagine create
- **progetto-villa-tuscolana.html** — Layout editoriale: hero full-width, griglia specs progetto, sezione editoriale con testo + immagine, immagine full-width di separazione, sezione dettaglio con immagine laterale, griglia immagini (2col + 3col), citazione testimonial, link "Progetto Successivo" → Locale Frascati
- **progetto-locale-frascati.html** — Layout editoriale: hero full-width, griglia specs progetto, sezione editoriale con testo + immagine, immagine full-width di separazione, sezione dettaglio con immagine laterale, griglia immagini (3 colonne uguali), citazione testimonial, link "Progetto Successivo" → Residenza Grottaferrata
- **progetto-residenza-grottaferrata.html** — Layout editoriale: hero full-width, griglia specs progetto, sezione editoriale con testo + immagine, immagine full-width di separazione, sezione dettaglio con immagine laterale, griglia immagini (2col + 1 full-width), citazione testimonial, link "Progetto Successivo" → Villa Tuscolana (loop circolare)

### Link aggiornati
- **progetti.html**: 3 link "Scopri il Progetto" aggiornati da `404.html` alle rispettive pagine progetto
- **index-nascosto.html**: 2 card progetto convertite da `<div>` a `<a>` con link alle rispettive pagine progetto

### Design
- Header e footer coerenti con il resto del sito (navbar con scroll state, WhatsApp icon, fullscreen menu)
- Navigazione circolare tra i 3 progetti tramite sezione "Progetto Successivo"
- Immagini Unsplash ad alta risoluzione in layout full-width e griglia
- Tipografia Oswald (display) + Inter (body), palette colori del sito

- Implementazione completata con successo

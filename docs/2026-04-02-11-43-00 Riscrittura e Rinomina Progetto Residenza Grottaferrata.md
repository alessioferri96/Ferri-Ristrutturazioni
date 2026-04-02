# Riscrittura e Rinomina Progetto Residenza Grottaferrata

**Data:** 2026-04-02
**Pagina:** `progetto-residenza-grottaferrata.html`

## Descrizione

Rinominazione del progetto da "Residenza Grottaferrata" a "Appartamento a Frascati" con aggiornamento metratura (180mq -> 90mq, su due livelli) e riscrittura completa del copywriting.

## Modifiche Effettuate

### Rinominazione
- Titolo: "Residenza Grottaferrata" -> "Appartamento a Frascati"
- Meta description aggiornata
- Hero title aggiornato
- Specs bar: 180mq -> 90mq, Grottaferrata -> Frascati
- Luogo: Grottaferrata (RM) -> Frascati (RM)

### Copywriting
Riscrittura di 3 blocchi di testo + citazione con agente ai-writing-auditor:
- **"Il Progetto"** (intro + dettaglio): rimossi "dialogo materico", tono diretto in prima persona
- **"I Dettagli"** (2 paragrafi): rimossi "racconta l'anima", "gioco di volumi", "dialoga con"
- **Citazione**: "vivere uno spazio" -> "vivere casa nostra" -> "tutto l'appartamento"

### Filtro Immagini
Aggiunto filtro CSS `img-enhance` a tutte le immagini dopo la hero:
- `filter: contrast(1.08) saturate(1.12) brightness(1.03)`
- Full-width image, detail image: classe `img-enhance`
- Gallery images: classe `img-enhance-gallery` con rimozione filtro all'hover
- Lightbox: filtro inline sull'elemento `<img>`

### Aggiornamento Riferimenti in Altre Pagine
- `index.html`: card progetto aggiornata (titolo, citta, mq)
- `progetti.html`: titolo e descrizione aggiornati
- `progetto-locale-frascati.html`: link "Progetto Successivo" aggiornato

## File Modificati
- `progetto-residenza-grottaferrata.html`
- `index.html`
- `progetti.html`
- `progetto-locale-frascati.html`

## Riepilogo Post-Implementazione
Implementazione completata con successo. Tutti i riferimenti testuali aggiornati. I nomi file HTML e immagini .webp mantenuti invariati per non rompere i percorsi.

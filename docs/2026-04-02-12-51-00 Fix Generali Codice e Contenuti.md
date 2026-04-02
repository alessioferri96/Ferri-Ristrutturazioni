# Fix Generali: Codice, Contenuti e Configurazione

**Data:** 2026-04-02
**Severita:** IMPORTANT + MINOR

## Descrizione

Correzioni varie su numeri di telefono, email, badge accreditamento, favicon, caching, codice morto e accessibilita slider.

## Modifiche Effettuate

### Numero di Telefono Reale
Sostituito placeholder `391234567890` con `393428556117` su:
- WhatsApp link (tutte le pagine)
- `tel:` link footer (tutte le pagine)
- Testo visibile menu hamburger (main.js)
- JSON-LD structured data (index.html)

### Email Corretta
- main.js: `ferriristrutturazioni.it` → `ferriristrutturazioni.com`

### Badge Accreditamento Italiani (5 pagine)
Sostituiti badge UK con equivalenti italiani:
- SSIP Safety Schemes → SOA Attestazione Qualificazione
- ISO 9001 14001 → DURC Regolarita Contributiva
- Safe Contractor Approved → CEI Conformita Impianti

### Favicon (8 pagine)
Creati 3 file favicon ("F" azzurra #6EC1E4 su sfondo bianco):
- `assets/img/favicon.svg` (vettoriale)
- `assets/img/favicon-32.png` (32x32)
- `assets/img/apple-touch-icon.png` (180x180)
Aggiunto link tag nel `<head>` di tutte e 8 le pagine.

### Testo Contatti Footer (3 pagine)
Uniformato testo su index, servizi, progetti:
"Mettiamo in campo vasta esperienza..." → "Portiamo in ogni progetto oltre sessant'anni di esperienza concreta..."

### .htaccess Caching e GZIP
Aggiunto a `.htaccess`:
- Compressione GZIP per HTML, CSS, JS, JSON, SVG
- Cache 1 anno per immagini e font
- Cache 1 mese per CSS e JS
- No cache per HTML

### Autoplay Slider (progetti.html)
Aggiunto check `prefers-reduced-motion`: l'autoplay si attiva solo se l'utente non ha disabilitato le animazioni.

### Codice Morto Rimosso (main.js)
- Riferimento a `#close-mobile-menu` (non esiste nel DOM)
- Intero blocco carousel `#projects-carousel` / `#prev-project` / `#next-project` (ID inesistenti)

## File Modificati
- Tutte e 8 le pagine HTML
- `assets/js/main.js`
- `assets/img/` (3 nuovi file favicon)
- `.htaccess`

## Riepilogo Post-Implementazione
Completato. Verificato con grep che nessun numero placeholder rimanga nel codice di produzione.

# Fix Accessibilità WCAG 2.2

**Data:** 2026-03-13
**Tipo:** Accessibilità

## Descrizione

Correzioni di accessibilità per portare il sito a conformità WCAG 2.2 Level AA. Audit eseguito su tutte le 10 pagine HTML, CSS e JS.

## Modifiche Implementate

### 1. Skip-to-Content Link (WCAG A — tutte le pagine)
- Aggiunto link "Vai al contenuto" nascosto con `sr-only`, visibile su focus via Tab
- Punta a `id="main-content"` su ogni tag `<main>`
- File: tutte le 10 pagine HTML

### 2. Focus Visible (WCAG AA — CSS globale)
- Aggiunto `*:focus-visible` con outline `#6EC1E4` (primary) 2px solid
- Outline-offset 3px su elementi interattivi (a, button, input, textarea, summary)
- File: `assets/css/style.css`

### 3. aria-expanded su Menu Toggle (WCAG AA — HTML + JS)
- Aggiunto `aria-expanded="false"` e `aria-controls="mobile-menu"` al bottone `#mobile-menu-toggle` su 8 pagine
- JS aggiornato per toggle `aria-expanded` true/false al click
- Menu dinamico: aggiunto `id="mobile-menu"` e `aria-label="Menu di navigazione"`
- File: 8 pagine HTML + `assets/js/main.js`

### 4. Contrasto Colori (WCAG AA — pagine progetto)
- `text-white/50` → `text-white/60` su tutte e 3 le pagine progetto
- Migliora il rapporto di contrasto su sfondo nero `#0a0a0a`
- File: progetto-villa-tuscolana.html, progetto-locale-frascati.html, progetto-residenza-grottaferrata.html

### 5. Prefers Reduced Motion (WCAG AAA — CSS globale)
- Aggiunta media query `@media (prefers-reduced-motion: reduce)`
- Disabilita tutte le animazioni e transizioni (duration 0.01ms)
- Override specifici per `.scroll-reveal`, `.animate-fade-in-up`, `.animate-fade-in-down`
- File: `assets/css/style.css`

### 6. Touch Targets 44x44px (WCAG AAA — CSS globale)
- Link social footer (LinkedIn, Instagram) portati a min 44x44px via CSS
- Selettore: `footer a[aria-label="LinkedIn/Instagram"]`
- File: `assets/css/style.css`

## Verification Plan
- Navigazione da tastiera (Tab) su tutte le pagine
- Test con screen reader (VoiceOver/NVDA)
- Verifica contrasto con strumenti dev browser
- Test con `prefers-reduced-motion` attivato nel sistema

## Riepilogo Post-Implementazione
- Skip-to-content: 10 pagine aggiornate
- id="main-content" su main: 10 pagine aggiornate
- focus-visible: CSS globale applicato
- aria-expanded: 8 pagine HTML + JS aggiornati
- Contrasto: 3 pagine progetto corrette
- prefers-reduced-motion: CSS globale applicato
- Touch targets: CSS globale applicato
- Implementazione completata con successo

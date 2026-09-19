# Sviluppo Sito Ferri Ristrutturazioni 2026-02-11-09-57-38

## Obiettivo
Sviluppare un sito web portfolio multipagina per "Ferri Ristrutturazioni" ispirato al design industriale di "Scape Construct", utilizzando tecnologie moderne e leggere (Tailwind CSS 4.0, Vanilla JS) e predisponendo il codice per una futura integrazione WordPress.

## Analisi Riferimenti
- **Design System**: Ispirato a `resources/Built To Work.png` e `scapeconstruct.com`.
  - **Vibe**: Industriale, solido, professionale ("Built To Work").
  - **Colori**: Estrazione in corso da `html.txt` (Elementor Kit).
  - **Animazioni**: Reveal on scroll, transizioni fluide, micro-interazioni native.
- **Struttura Tecnica**: Basata su `resources/html.txt` ma ripulita dal bloat di Elementor/WordPress.

## Requisiti Tecnici
- **Stack**:
  - HTML5 Semantico.
  - Tailwind CSS 4.0 (JIT Mode).
  - JavaScript (Vanilla ES2026).
- **WP Compatibility**:
  - Naming convention standard (es. `site-header`, `site-footer`, `entry-content`).
  - Struttura modulare (Header, Footer, Partials).
- **Performance**:
  - Critical CSS.
  - Lazy loading nativo.
  - Assenza di jQuery e librerie pesanti.

## Struttura Sito
1.  **Header**: Navigazione, Logo, CTA.
2.  **Home**:
    - **Hero**: Immagine impattante, Headline "Costruiamo il tuo Futuro".
    - **PSA Section**: Problem (Disordine), Solution (Metodo Ferri), Action (CTA).
    - **Featured Projects**: Carosello leggero.
3.  **Chi Siamo**: Storia, Valori, Team.
4.  **Servizi**: Lista servizi con icone/dettagli.
5.  **Progetti**: Griglia filtrabile.
6.  **Contatti**: Form e Map.
7.  **Footer**: Link utili, Social, Copyright.

## Roadmap
1.  **Setup**: Configurazione Tailwind 4 e struttura cartelle.
2.  **Design System**: Definizione token (colori, font) in `style.css`.
3.  **Sviluppo Componenti**: Header, Footer, Hero, Cards.
4.  **Animazioni**: Implementazione logica scroll-reveal.
5.  **Ottimizzazione**: Pulizia codice e verifica Lighthouse.
6.  **Migrazione**: Creazione guida `WP_Migration_Guide.md`.

## Riepilogo Post-Implementazione
*(Da compilare a fine lavori)*

# Redesign Premium Pagine Progetto

**Data:** 2026-03-13
**Tipo:** Modifica design

## Descrizione

Ridisegnare le 3 pagine progetto dedicate con estetica premium/luxury: tonalità nere, stile rivista cartacea di design, font editoriale serif (Cormorant Garamond) esclusivo per queste pagine.

## Modifiche Pianificate

### Design
- Background nero (#0a0a0a) su tutto il body e le sezioni
- Font editoriale: Cormorant Garamond (serif) per titoli, citazioni e testi editoriali
- Header scrollato con backdrop scuro (non bianco)
- Footer in versione dark coerente
- Separatori sottili in bianco/10 al posto di bordi grigi
- Immagini con overlay scuri ai bordi per effetto rivista
- Tipografia più drammatica con spaziatura ampia
- Palette: nero, bianco, grigio chiaro, accento primary (#6EC1E4)

### File coinvolti
- `progetto-villa-tuscolana.html`
- `progetto-locale-frascati.html`
- `progetto-residenza-grottaferrata.html`

## Verification Plan
- Verifica visiva a cura dell'utente

## Riepilogo Post-Implementazione

### Modifiche applicate a tutte e 3 le pagine progetto

**Font editoriale:**
- Aggiunto Google Font **Cormorant Garamond** (serif, pesi 300-700 + italic)
- Classe `.font-editorial` definita via `<style>` in-page (non richiede rebuild Tailwind)
- Usato per: titoli hero, titoli sezione, specs, citazioni, link progetto successivo

**Palette dark/luxury:**
- Body: `bg-[#0a0a0a]` (nero quasi assoluto)
- Header scrollato: `bg-[#0a0a0a]/95` con `backdrop-blur-sm` e `border-white/10` (no shadow bianco)
- Logo scrollato: resta bianco (non diventa nero)
- Testi: bianco con opacità variabile (white/90, white/50, white/40, white/30)
- Separatori: `border-white/10`, `border-white/5`
- Accento primary (#6EC1E4) usato con parsimonia su label e linee decorative

**Layout editoriale rivista:**
- Hero: titolo in font-editorial font-light gigante (fino a 10rem), tag tipologia con bordo semitrasparente, linea decorativa + testo location
- Specs bar: griglia 3 colonne con divisori verticali semitrasparenti
- Testo editoriale: layout 4/8 colonne con label a sinistra e testo serif grande a destra
- Immagini full-width: con gradient fade-in/out dal nero ai bordi
- Griglia immagini: hover zoom lento (1s), overlay che si dissolve
- Citazione: virgoletta serif gigante in primary/30, testo italic serif, separatori decorativi
- Next Project: testo gigante semitrasparente (white/20) che si illumina su hover, linea animata

**Footer dark:**
- Sfondo nero, testi white/40 e white/30
- Bordi white/10 e white/5
- CTA "Chiama Ora" con bordo e fill semitrasparenti

- Implementazione completata con successo

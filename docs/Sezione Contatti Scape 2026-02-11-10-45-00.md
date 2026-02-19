# Progetto: Rifacimento Sezione Contatti (Scape Construct Style)

**Data:** 2026-02-11
**Obiettivo:** Ricreare la sezione "Contatti" esattamente come presente nel sito Scape Construct (footer), seguendo la struttura rilevata nel codice sorgente di riferimento.

## Analisi dello Stato Attuale vs Riferimento

| Caratteristica | Attuale (Mio Codice) | Riferimento (Scape Construct) |
| :--- | :--- | :--- |
| **Posizione** | Sezione `section#contatti` separata, sfondo bianco. | Integrata nel Footer (`elementor-location-footer`), sfondo scuro (presunto). |
| **Layout** | Grid 2 colonne (Testo SX, Form DX su card bianca). | Colonna singola (`elementor-col-100`) o stack verticale. |
| **Stile Form** | Card bianca con ombra, label visibili. | Sfondo trasparente, label nascoste (`hide_label`), placeholder visibili. |
| **Input** | Input standard con bordo. | Input integrati su sfondo scuro (probabilmente solo border-bottom o stile minimal). |
| **Testo** | Traduzione italiana, stile "Hero". | "Contact" + "We bring a breadth...", stile minimal. |

## Modifiche Proposte

### 1. Struttura HTML
- Spostare la sezione Contatti visivamente nel contesto "Dark" del footer.
- Rimuovere il contenitore bianco (`bg-white shadow`) del form.
- Impostare il layout su una struttura che rispecchi `elementor-col-100`:
  - Intestazione "Contatti" (H3).
  - Paragrafo descrittivo.
  - Form a larghezza intera o in griglia ma senza "card".

### 2. Form (Fluent Form Replica)
- **Campi:**
  - Nome (Placeholder: "Nome *")
  - Email (Placeholder: "Indirizzo Email *")
  - Telefono (Placeholder: "Telefono *")
  - Messaggio (Placeholder: "Come possiamo aiutarti? *")
- **Stile:**
  - Nascondere le `<label>`.
  - Usare solo `placeholder`.
  - Input con sfondo trasparente o bianco/translucido adatto a sfondo scuro.
  - Pulsante "Invia" allineato (probabilmente a sinistra o full width).

### 3. Contenuti (Italiano)
- **Titolo:** "CONTATTI"
- **Testo:** "Mettiamo in campo vasta esperienza e competenza. Per noi è fondamentale che tu possa contare su di noi in ogni fase del processo e oltre." (Traduzione fedele di Scape).

## Piano di Implementazione
1.  **Modifica `index.html`**:
    - Aggiornare la sezione `#contact-form-section`.
    - Applicare classi `bg-secondary` e `text-white`.
    - Rimuovere il wrapper `bg-white` dal form.
    - Aggiornare i campi input per nascondere label e mostrare placeholder.
2.  **Stile CSS (Tailwind)**:
    - Assicurare che gli input siano leggibili su sfondo scuro (es. `bg-transparent border-b border-gray-500 text-white placeholder-gray-400`).
3.  **Verifica**:
    - Controllare visualmente che la sezione sembri un'estensione fluida del footer, "tale e quale" a Scape.

## Richiesta Approvazione
Attendo "Procedi" per applicare queste modifiche.

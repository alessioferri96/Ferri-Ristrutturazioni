# Citazione Inline — Residenza Grottaferrata

**Data:** 2026-03-29
**Tipo:** Fix design

## Descrizione

Ridisegno della sezione citazione nella pagina progetto Residenza Grottaferrata. Le virgolette decorative giganti isolate sopra il testo sono state sostituite con virgolette inline.

## Problema

- Elemento `div` con virgolette di apertura in dimensione 6xl/8xl/9xl posizionato sopra il paragrafo come elemento decorativo separato
- Margine negativo (`-mt-8/-mt-12/-mt-16`) per compensare lo spazio, creando problemi di allineamento

## Soluzione

- Rimosso `div` decorativo isolato
- Virgolette `"` e `"` inserite come `<span>` inline nel paragrafo
- Stessa dimensione del testo, colore primary, non corsive (`not-italic`)
- Spaziatura: `mr-3` + spazio dopo apertura, `ml-2` prima di chiusura
- Rimossi margini negativi non più necessari

## File modificati
- `progetto-residenza-grottaferrata.html`

## Verification Plan
- Verifica visiva a cura dell'utente

- Implementazione completata con successo

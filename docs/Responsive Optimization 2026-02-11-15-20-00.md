# Progetto: Ottimizzazione Responsiva (Best Practices 2026)

**Data:** 2026-02-11
**Obiettivo:** Perfezionare la resa su Mobile e Tablet seguendo le direttive "UI/UX Design" e "WordPress Mastery" presenti in SKILL.md.

## Analisi e Interventi

### 1. Tipografia Fluida (UI/UX)
- **Problema:** Titoli `text-5xl` o `text-6xl` occupano troppo spazio su mobile e causano "a capo" indesiderati.
- **Soluzione:** Utilizzare classi responsive per ridurre la dimensione su mobile.
    - `h1`: `text-4xl md:text-6xl lg:text-8xl`.
    - `h2`: `text-3xl md:text-5xl`.
    - Body text: `text-left` su mobile (leggibilità), `text-justify` abbinato a `md:text-justify` solo su desktop se necessario.

### 2. Spaziature e Padding (UI/UX)
- **Problema:** `py-24` (96px) e `p-10` (40px) sono eccessivi su schermi piccoli, forzando troppo scroll.
- **Soluzione:**
    - Sezioni: `py-12 md:py-24`.
    - Card/Container: `p-6 md:p-10`.

### 3. Hero Section (Fullstack/CSS)
- **Problema:** `h-screen` può creare problemi con la barra degli indirizzi mobile (100vh vs 100dvh).
- **Soluzione:** Usare `h-[100dvh]` (Dynamic Viewport Height) se supportato o fallback `min-h-screen`.

### 4. Navigazione e Header
- **Problema:** Header `h-[120px]` ruba spazio su mobile landscape.
- **Soluzione:**
    - Base: `h-20` (80px) su mobile.
    - `md:h-[120px]` (120px) su desktop.

## Piano di Implementazione (index.html)
1.  **Global:** Aggiornare tutte le `section` con `py-12 md:py-24`.
2.  **Hero:** `h-screen` -> `min-h-[100dvh]`. Titolo `text-4xl md:text-6xl lg:text-8xl`.
3.  **PSA/About/Differenza:**
    - Padding interni: `p-6 md:p-10`.
    - Testo: Rimuovere `text-justify` forzato su mobile (usare `text-left md:text-justify`).
4.  **Header:** Altezza responsiva.

## Richiesta Approvazione
Procedo direttamente.

# SEO: Meta Tags, Canonical, Open Graph e Structured Data

**Data:** 2026-04-02
**Severita:** CRITICAL + IMPORTANT

## Descrizione

Aggiunta di canonical URL, Open Graph, Twitter Card, JSON-LD structured data e ottimizzazione geo-keyword.

## Modifiche Effettuate

### Canonical URL (8 pagine)
Aggiunto `<link rel="canonical" href="https://www.ferriristrutturazioni.com/[pagina]">` a tutte le pagine.

### Open Graph + Twitter Card (8 pagine)
Aggiunto su ogni pagina:
- `og:title`, `og:description`, `og:url`, `og:type`, `og:locale`, `og:site_name`
- `twitter:card` (summary_large_image)

### JSON-LD Structured Data (index.html)
Schema `LocalBusiness` con: nome, URL, telefono, email, indirizzo (Frascati), area servita (Castelli Romani).

### Geo-keyword (index.html)
- Title: "Ferri Ristrutturazioni | Ristrutturazioni Castelli Romani e Frascati"
- Meta description: include "Castelli Romani", "Frascati", "impresa edile familiare", "preventivo gratuito"

### noindex su 404.html
Aggiunto `<meta name="robots" content="noindex, nofollow">`.

## File Modificati
- Tutte e 8 le pagine HTML

## Riepilogo Post-Implementazione
Completato. Verificato presenza tag su tutte le pagine.

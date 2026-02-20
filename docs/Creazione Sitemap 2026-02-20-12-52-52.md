# Creazione Sitemap 2026-02-20-12-52-52

Il presente documento descrive l'implementazione del file `sitemap.xml` per il sito "Ferri Ristrutturazioni" al fine di migliorare l'indicizzazione sui motori di ricerca (SEO).

## Obiettivo
Creare un file `sitemap.xml` standard che elenchi tutte le pagine pubbliche del sito.

## Pagine da includere
In base all'analisi della directory principale, la sitemap includerà i seguenti URL:
- `index.html` (Home)
- `chi-siamo.html` (Chi Siamo)
- `servizi.html` (Servizi)
- `progetti.html` (Progetti)
- `contatti.html` (Contatti)

> [!NOTE]
> La pagina `404.html` non viene inclusa nella sitemap. Secondo le best practice SEO, la sitemap deve elencare solo le pagine che si desidera indicizzare sui motori di ricerca. Una pagina di errore 404 indicizzata potrebbe confondere gli utenti e danneggiare il posizionamento del sito.

## Modifiche Proposte

### [NEW] [sitemap.xml](file:///c:/Users/andre/OneDrive/Desktop/Progetti/Ferri/Ristrutturazioni/sitemap.xml)
Creazione del file nella root del progetto con struttura XML standard.

### [NEW] [robots.txt](file:///c:/Users/andre/OneDrive/Desktop/Progetti/Ferri/Ristrutturazioni/robots.txt) [OPZIONALE]
Se non presente, verrà creato un file `robots.txt` per indicare ai bot la posizione della sitemap.

## Scelte Tecniche
- **Dominio:** In assenza di un dominio definitivo confermato, verrà utilizzato un placeholder (es. `https://ferriristrutturazioni.it`) che l'utente potrà modificare.
- **Frequenza di aggiornamento:** Set-up standard (mensile).
- **Priorità:** Home (1.0), Pagine principali (0.8).

## Riepilogo Post-Implementazione
Implementazione completata con successo in data 2026-02-20.
- Creato file `sitemap.xml` con 5 URL principali.
- Creato file `robots.txt` con direttiva `Allow: /` e link alla sitemap.
- Esclusa pagina `404.html` come da best practice SEO e approvazione utente.
- Verificata la corretta formattazione XML della sitemap.

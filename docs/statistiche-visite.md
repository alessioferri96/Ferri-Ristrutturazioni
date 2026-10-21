# Statistiche visite — 21 ottobre 2026

Terza sezione privata `gestione-recensioni.php?sezione=statistiche`, protetta dallo stesso accesso Google Authenticator. Grafico giornaliero a due serie, tabella accessibile e conteggi per oggi, sette e trenta giorni. Le visualizzazioni sono aperture/ricaricamenti di pagine pubbliche; gli unici sono browser distinti nel periodo, non la somma degli unici giornalieri e non una misura esatta delle persone. Le giornate antecedenti alla data di attivazione sono indicate come non rilevate. Nessun dato storico è stato importato.

## Raccolta e consenso

Le nove pagine pubbliche includono `assets/js/statistics-client.js`. Area riservata, 404, materiale di stampa e pagina informativa sono esclusi. Il browser invia esclusivamente pathname ammesso (senza query/hash), identificativi casuali di browser e visualizzazione e conferma del consenso. Nessun IP, fingerprint, referrer, contenuto dei moduli o URL con parametri viene conservato nelle tabelle delle statistiche. I normali log tecnici dell’hosting sono indipendenti da questa funzionalità.

Il consenso alla misurazione di iubenda, quando è espressamente disponibile nella categoria 4, ha priorità. Il banner iubenda verificato prima dell’intervento non conteneva la categoria 4: in tal caso il sito chiede una scelta separata ed esplicita con un piccolo avviso, dopo che l’utente ha chiuso il banner esistente. Non si assume che “Accetta tutto” relativo ad altre finalità autorizzi queste statistiche. Consenti/Rifiuta sono presentati con pari evidenza; non viene cambiata la configurazione remota iubenda.

La preferenza locale `ferri_statistics_consent` dura trenta giorni; l’identificativo facoltativo `ferri_statistics_visitor`, creato solo dopo consenso, dura al massimo trenta giorni. Revoca e diniego della categoria 4 rimuovono l’identificativo locale. Do Not Track e Global Privacy Control impediscono la raccolta. Se localStorage è bloccato, niente misurazione e niente metodi alternativi per riconoscere il browser. La pagina pubblica `statistiche-privacy.html` descrive il sistema e permette di modificare la scelta. È collegata dai nove footer e dalla sitemap.

## Server e conservazione

`statistics-collect.php` accetta solo POST JSON dall’origine HTTPS del sito e non restituisce contatori. Rifiuta eventi non validi, percorsi non ammessi, payload oltre 2 KB e segnali automatici di crawler. Richieste ripetute della stessa visualizzazione sono deduplicate atomicamente. Nessuna sessione amministrativa è inviata dal client (`credentials: omit`).

Il database è quello già configurato per le recensioni. Tabelle create automaticamente: `site_statistics_meta`, `site_statistics_visitors`, `site_statistics_events`. Identificativi salvati come hash, senza i valori originali. Una riga per giorno/browser contiene solo il numero di aperture. I totali di sette/trenta giorni usano `COUNT(DISTINCT visitor_hash)`. Conservazione di trenta giorni per i visitatori e di oggi/ieri per i codici antiripetizione, pulizia al successivo conteggio o consultazione, al massimo una volta al giorno. Nessun account analytics o fornitore pubblicitario aggiunto.

## Verifiche

Il workflow prima del caricamento FTP esegue controllo sintassi PHP, test autenticazione e test statistiche su MySQL temporaneo: consenso, payload privati rifiutati, deduplicazione visualizzazioni, unici su periodi diversi, retention, assenza di storico e rendering del grafico anche vuoto. Test browser locali controllano consenso, revoca, Do Not Track, localStorage bloccato, continuità del visitatore tra pagine e visualizzazione responsive della navigazione privata.

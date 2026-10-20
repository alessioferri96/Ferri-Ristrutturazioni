# Area riservata con Google Authenticator

L’area riservata è `gestione-recensioni.php`, raggiungibile dal fondo della home.
Dopo l’attivazione usa solo Google Authenticator, senza password e senza SMS.

## Prima attivazione del proprietario

1. Aprire l’area riservata sul sito HTTPS.
2. Confermare la password **attuale** una sola volta: serve esclusivamente a impedire che un visitatore colleghi un proprio telefono prima del proprietario.
3. In Google Authenticator premere `+` e scansionare il QR. Sullo stesso telefono è disponibile il collegamento per aprire l’app; in alternativa inserire la chiave manualmente con tipo “Basato sul tempo”.
4. Inserire il codice dell’app per confermare. Finché il codice non viene verificato, il collegamento non è attivo e non concede accesso alla gestione.
5. Conservare gli otto codici di recupero fuori dal telefono. Ciascuno può essere usato una sola volta al posto dell’app.

Non viene impostata una password nuova: la richiesta di accesso solo con l’app sostituisce la precedente richiesta di cambio password. La vecchia password non consente più alcun accesso dopo l’attivazione, nemmeno richiamando direttamente il modulo. Può essere rimossa dalla configurazione privata sul server dopo avere completato l’attivazione.

## Comportamento e protezioni

- Chiave casuale personale generata solo sul server, salvata nel database privato recensioni; mai nel repository o nei file statici. QR generato nel browser da una libreria locale MIT: nessun servizio esterno riceve la chiave.
- Codici TOTP SHA-1 a sei cifre, periodo 30 secondi, tolleranza di un periodo. Un codice usato non può essere riutilizzato, anche in sessioni diverse. La verifica e il consumo dei codici sono atomici nel database.
- Limiti persistenti: dieci tentativi per indirizzo e trenta complessivi ogni quindici minuti. Non si azzerano cambiando cookie o browser.
- Sessioni precedenti invalidate. Cookie HTTPS, HttpOnly, SameSite Strict; rotazione dell’identificativo; scadenza dopo venti minuti di inattività e otto ore complessive.
- Token anti-CSRF su login, configurazione, uscita e modifica recensioni. Pagine riservate senza cache e senza indicizzazione.
- La prima configurazione scade dopo dieci minuti; due configurazioni contemporanee non possono sovrascriversi.
- I codici di recupero sono casuali a 128 bit e salvati come hash. Sono visibili soltanto nella sessione di attivazione fino alla conferma del salvataggio.

Si tratta di autenticazione con un solo fattore (possesso dell’app), come richiesto, non di autenticazione a due fattori. L’orologio del telefono deve essere automatico.

## Manutenzione e recupero

Le tabelle `reviews_admin_auth` e `reviews_auth_limits` sono create automaticamente con lo stesso database e le stesse credenziali già usate dalle recensioni. Nessun nuovo account esterno. Il database deve conservare queste tabelle tra una pubblicazione e l’altra; includerle nei backup privati. Un ripristino può rendere riutilizzabili codici già consumati: in quel caso riconfigurare la chiave.

Se si perde il telefono, usare un codice di recupero. Per collegare un altro telefono contattare l’amministratore dell’hosting: verificare l’identità del proprietario, ripristinare una password di attivazione nel file privato `reviews-config.php` e azzerare solo la riga di configurazione dell’autenticatore. Questa operazione revoca la chiave precedente e i codici di recupero; richiede un nuovo collegamento del telefono. Non esiste un reset pubblico con la vecchia password.

## Verifica prima della pubblicazione

Il workflow di pubblicazione controlla la sintassi PHP, i vettori ufficiali RFC 6238 e il flusso su un database MySQL temporaneo: attivazione, riutilizzo, codici di recupero e limiti dei tentativi. Il caricamento FTP parte soltanto se i controlli passano.

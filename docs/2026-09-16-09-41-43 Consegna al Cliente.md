# Consegna al Cliente

Chiusura dei punti rimasti aperti dopo la pulizia pre-consegna del 17/08, in
ordine, fino al trasferimento di dominio e hosting sull'account Hostinger del
cliente (modello A).

## Punti

| # | Punto | Tipo |
|---|---|---|
| 1 | Cache CDN con file negati ancora serviti | verifica |
| 2 | Biglietto da visita: 9 file mai committati | repo |
| 3 | Google Business Profile → proprietà a Marco Ferri | esterno |
| 4 | Search Console → delega al cliente | esterno |
| 5 | Iubenda → titolare del trattamento = impresa Ferri | esterno |
| 6 | Analytics assenti | repo + CSP |
| 7 | Trasferimento dominio + hosting + email, rotazione credenziali, verbale | Hostinger |

## 1. Cache CDN

Nessuna modifica. Verifica: i 7 file del 17/08 interrogati **senza** cache-bust
su più edge devono rispondere 403 (negati da `.htaccess`) o 404 (rimossi).

## 2. Biglietto da visita

I file del 25/05 entrano nel repository, così il cliente li riceve insieme al
sito, ma **non vengono pubblicati**: sono materiale di stampa, non pagine.

- `biglietto-da-visita.html` — anteprima a schermo (genera il QR con qrcodejs)
- `biglietto-stampa.html` — sorgente del PDF (WeasyPrint, 85×54 mm)
- `biglietto-da-visita-STAMPA.pdf` — file pronto per la tipografia
- `assets/img/hero-print.jpg`, `assets/img/qrcode-ferri.png` — usati solo da `biglietto-stampa.html`
- `loghi/*.svg` (4) — vettoriali del logo; `loghi/` è già pubblicata, restano pubblici come gli altri loghi

Modifica al workflow: aggiunti a `exclude` `biglietto-*` e le due immagini di
stampa. Sono file nuovi per il server, quindi l'esclusione basta (non esistono
online da cancellare).

Verifica: dopo il push, gli URL dei 5 file esclusi rispondono 404 (con
cache-bust) e le 9 pagine restano 200.

## 3–7

Da compilare man mano.

## Riepilogo Post-Implementazione

Da compilare.

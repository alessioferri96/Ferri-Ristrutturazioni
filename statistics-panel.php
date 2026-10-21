<?php
declare(strict_types=1);
if (!defined('REVIEWS_ADMIN_PAGE')) { http_response_code(404); exit; }
?>
<a class="back" href="gestione-recensioni.php">← Tutte le sezioni</a>
<h1>Statistiche visite</h1>
<p>Visualizzazioni delle pagine e visitatori unici stimati: due modi diversi di leggere il traffico del sito.</p>
<?php if ($statistics !== null): ?>
    <p class="stats-note">Raccolta attiva dal <?= reviews_auth_escape((new DateTimeImmutable($statistics['started_on']))->format('d/m/Y')) ?>. Giorni e orari seguono il fuso di Roma.</p>
    <div class="metrics">
        <?php foreach ([1 => 'Oggi', 7 => 'Ultimi 7 giorni', 30 => 'Ultimi 30 giorni'] as $days => $label): ?>
            <article class="card metric">
                <h2><?= $label ?></h2>
                <p class="metric-number views-color"><?= number_format($statistics['totals'][$days]['views'], 0, ',', '.') ?><span class="metric-label">Visualizzazioni delle pagine</span></p>
                <p class="metric-number visitors-color"><?= number_format($statistics['totals'][$days]['visitors'], 0, ',', '.') ?><span class="metric-label">Visitatori unici stimati</span></p>
            </article>
        <?php endforeach; ?>
    </div>
    <nav class="periods" aria-label="Periodo del grafico">
        <?php foreach ([7, 30] as $period): ?><a class="button secondary" href="gestione-recensioni.php?sezione=statistiche&amp;periodo=<?= $period ?>"<?= $statistics['period'] === $period ? ' aria-current="page"' : '' ?>>Ultimi <?= $period ?> giorni</a><?php endforeach; ?>
    </nav>
    <section class="card" aria-labelledby="statistics-chart-title">
        <h2 id="statistics-chart-title">Andamento giornaliero</h2>
        <div class="legend"><span class="views-color">● Visualizzazioni</span><span class="visitors-color">● Visitatori unici stimati</span></div>
        <?php
        $series = $statistics['series'];
        $max = max(4, ...array_column($series, 'views'));
        $step = (int)max(1, ceil($max / 4));
        $ceiling = $step * 4;
        $x = static fn(int $index): float => 54 + $index * 750 / max(1, count($series) - 1);
        $y = static fn(int $value): float => 214 - 180 * $value / $ceiling;
        $points = ['views' => [], 'visitors' => []];
        foreach ($series as $index => $day) {
            if (!$day['available']) continue;
            foreach (array_keys($points) as $metric) $points[$metric][] = round($x($index), 2) . ',' . round($y($day[$metric]), 2);
        }
        ?>
        <?php if ($statistics['totals'][30]['views'] === 0): ?><p class="stats-note">Ancora nessuna visita registrata. Il grafico si popolerà con le visite che autorizzano la misurazione.</p><?php endif; ?>
        <div class="chart-scroll">
            <svg viewBox="0 0 840 270" role="img" aria-label="Grafico giornaliero: linea dorata per le visualizzazioni, linea azzurra per i visitatori unici stimati. Valori completi nella tabella sotto.">
                <?php for ($i = 0; $i <= 4; $i++): $value = $i * $step; ?>
                    <line x1="54" x2="804" y1="<?= $y($value) ?>" y2="<?= $y($value) ?>" stroke="#414141" />
                    <text x="44" y="<?= $y($value) + 5 ?>" text-anchor="end" fill="#bbb" font-size="14"><?= $value ?></text>
                <?php endfor; ?>
                <polyline data-series="views" points="<?= implode(' ', $points['views']) ?>" fill="none" stroke="#d5ad70" stroke-width="3" stroke-linejoin="round" />
                <polyline data-series="visitors" points="<?= implode(' ', $points['visitors']) ?>" fill="none" stroke="#76c7ff" stroke-width="3" stroke-linejoin="round" />
                <?php foreach ($series as $index => $day): ?>
                    <?php if ($index === 0 || $index === count($series) - 1 || $index % max(1, (int)ceil(count($series) / 6)) === 0): ?><text x="<?= $x($index) ?>" y="246" text-anchor="middle" fill="#bbb" font-size="14"><?= $day['label'] ?></text><?php endif; ?>
                    <?php if ($day['available']): ?>
                        <circle cx="<?= $x($index) ?>" cy="<?= $y($day['views']) ?>" r="4" fill="#d5ad70"><title><?= $day['label'] ?>: <?= $day['views'] ?> visualizzazioni</title></circle>
                        <circle cx="<?= $x($index) ?>" cy="<?= $y($day['visitors']) ?>" r="4" fill="#76c7ff"><title><?= $day['label'] ?>: <?= $day['visitors'] ?> visitatori unici stimati</title></circle>
                    <?php endif; ?>
                <?php endforeach; ?>
            </svg>
        </div>
        <details><summary>Mostra i valori giorno per giorno</summary>
            <div class="table-scroll"><table class="stats-table"><thead><tr><th scope="col">Giorno</th><th scope="col">Visualizzazioni</th><th scope="col">Visitatori unici stimati</th></tr></thead><tbody>
                <?php foreach (array_reverse($series) as $day): ?><tr><th scope="row"><?= $day['label'] ?></th><td><?= $day['available'] ? $day['views'] : 'Non rilevato' ?></td><td><?= $day['available'] ? $day['visitors'] : 'Non rilevato' ?></td></tr><?php endforeach; ?>
            </tbody></table></div>
        </details>
    </section>
    <div class="stats-note">
        <p><strong>Visualizzazioni:</strong> ogni apertura o ricaricamento di una pagina conta una volta. Una persona può generarne molte.</p>
        <p><strong>Visitatori unici stimati:</strong> browser distinti nel periodo selezionato. Lo stesso browser che torna più giorni conta una sola volta nei totali di 7 e 30 giorni; per questo quei totali non sono la somma dei visitatori giornalieri.</p>
        <p>La misurazione parte solo dopo il consenso alle statistiche. Chi rifiuta, blocca il tracciamento o usa “Do Not Track” non viene contato. Telefoni, computer e browser diversi possono far risultare più visitatori per la stessa persona; cancellare i dati del browser ha lo stesso effetto. I dati precedenti all’attivazione non sono disponibili.</p>
        <p>Aggiorna questa pagina per leggere gli ultimi conteggi. <a href="statistiche-privacy.html" target="_blank" rel="noopener noreferrer">Come vengono misurate le visite</a>.</p>
    </div>
<?php endif; ?>

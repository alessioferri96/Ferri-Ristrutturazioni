<?php
declare(strict_types=1);
require __DIR__ . '/../statistics-service.php';
require __DIR__ . '/../reviews-auth.php';
function stats_check(bool $condition, string $message): void {
    if (!$condition) throw new RuntimeException($message);
}
$event = ['consent' => true, 'visitor' => str_repeat('a', 32), 'event' => str_repeat('b', 32), 'path' => '/'];
stats_check(statistics_valid_event($event), 'Accept valid event');
foreach ([['consent' => false], ['consent' => 'true'], ['path' => '/gestione-recensioni.php'], ['path' => '/?email=private@example.com'], ['visitor' => 'invalid'], ['event' => []]] as $invalid) {
    stats_check(!statistics_valid_event(array_replace($event, $invalid)), 'Reject invalid or private events');
}
if (getenv('REVIEWS_TEST_DSN')) {
    $pdo = new PDO(getenv('REVIEWS_TEST_DSN'), 'root', 'test', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    statistics_schema($pdo);
    $pdo->exec('DELETE FROM site_statistics_visitors');
    $pdo->exec('DELETE FROM site_statistics_events');
    $today = new DateTimeImmutable('2026-10-21', new DateTimeZone('Europe/Rome'));
    $pdo->exec("UPDATE site_statistics_meta SET started_on='2026-10-13', cleaned_on='2026-10-21' WHERE id=1");
    $record = static function(string $visitor, string $id, int $daysAgo) use ($pdo, $today): bool {
        return statistics_record($pdo, ['consent' => true, 'visitor' => str_repeat($visitor, 32), 'event' => str_repeat($id, 32), 'path' => '/'], $today->modify('-' . $daysAgo . ' days'));
    };
    stats_check($record('a', 'a', 0), 'First page view');
    stats_check(!$record('a', 'a', 0), 'Duplicate request must not count twice');
    stats_check($record('a', 'b', 0), 'Second page, same visitor');
    stats_check($record('a', 'c', 1), 'Same visitor returns next day');
    stats_check($record('b', 'd', 6), 'Second visitor in seven-day window');
    stats_check($record('c', 'e', 8), 'Third visitor in thirty-day window');
    $statistics = statistics_report($pdo, 7, $today);
    stats_check($statistics['totals'][1] === ['views' => 2, 'visitors' => 1], 'Daily views versus visitors');
    stats_check($statistics['totals'][7] === ['views' => 4, 'visitors' => 2], 'Deduplicate visitors over seven days');
    stats_check($statistics['totals'][30] === ['views' => 5, 'visitors' => 3], 'Deduplicate visitors over thirty days');
    stats_check(count($statistics['series']) === 7, 'Seven-day series');
    stats_check($statistics['series'][5]['views'] === 1 && $statistics['series'][6]['views'] === 2, 'Chronological daily series');
    $thirty = statistics_report($pdo, 30, $today);
    stats_check(count($thirty['series']) === 30 && !$thirty['series'][0]['available'], 'No fabricated historical data');
    stats_check($record('d', 'f', 40), 'Insert old disposable test fixture');
    $pdo->exec("UPDATE site_statistics_meta SET cleaned_on='2026-10-20' WHERE id=1");
    statistics_report($pdo, 30, $today);
    stats_check((int)$pdo->query("SELECT COUNT(*) FROM site_statistics_visitors WHERE visit_day < '2026-09-22'")->fetchColumn() === 0, 'Delete expired visitor data');
    stats_check((int)$pdo->query("SELECT COUNT(*) FROM site_statistics_events WHERE visit_day < '2026-10-20'")->fetchColumn() === 0, 'Delete expired replay identifiers');
    define('REVIEWS_ADMIN_PAGE', true);
    ob_start();
    require __DIR__ . '/../statistics-panel.php';
    $html = ob_get_clean();
    stats_check(str_contains($html, 'data-series="views"') && str_contains($html, 'data-series="visitors"'), 'Render both graph series');
    stats_check(str_contains($html, 'Ultimi 7 giorni') && str_contains($html, 'Ultimi 30 giorni'), 'Render period controls');
    $pdo->exec('DELETE FROM site_statistics_visitors');
    $statistics = statistics_report($pdo, 30, $today);
    ob_start();
    require __DIR__ . '/../statistics-panel.php';
    $empty = ob_get_clean();
    stats_check(str_contains($empty, 'Ancora nessuna visita registrata'), 'Honest empty state');
}
echo "Site statistics checks passed.\n";

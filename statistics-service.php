<?php
declare(strict_types=1);

function statistics_today(): DateTimeImmutable {
    return new DateTimeImmutable('today', new DateTimeZone('Europe/Rome'));
}

function statistics_schema(PDO $pdo): void {
    $pdo->exec('CREATE TABLE IF NOT EXISTS site_statistics_meta (
        id TINYINT UNSIGNED PRIMARY KEY,
        started_on DATE NOT NULL,
        cleaned_on DATE NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $today = statistics_today()->format('Y-m-d');
    $pdo->prepare('INSERT IGNORE INTO site_statistics_meta (id, started_on, cleaned_on) VALUES (1, ?, ?)')->execute([$today, $today]);
    $pdo->exec('CREATE TABLE IF NOT EXISTS site_statistics_visitors (
        visit_day DATE NOT NULL,
        visitor_hash CHAR(64) NOT NULL,
        views INT UNSIGNED NOT NULL DEFAULT 0,
        PRIMARY KEY (visit_day, visitor_hash),
        INDEX visitor_lookup (visitor_hash, visit_day)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    $pdo->exec('CREATE TABLE IF NOT EXISTS site_statistics_events (
        event_hash CHAR(64) PRIMARY KEY,
        visit_day DATE NOT NULL,
        INDEX event_day (visit_day)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
}

function statistics_clean(PDO $pdo, DateTimeImmutable $today): void {
    $day = $today->format('Y-m-d');
    $query = $pdo->prepare('SELECT cleaned_on FROM site_statistics_meta WHERE id=1');
    $query->execute();
    if ($query->fetchColumn() >= $day) return;
    $pdo->prepare('DELETE FROM site_statistics_visitors WHERE visit_day < ?')->execute([$today->modify('-29 days')->format('Y-m-d')]);
    $pdo->prepare('DELETE FROM site_statistics_events WHERE visit_day < ?')->execute([$today->modify('-1 day')->format('Y-m-d')]);
    $pdo->prepare('UPDATE site_statistics_meta SET cleaned_on=? WHERE id=1')->execute([$day]);
}

function statistics_valid_event(array $event): bool {
    $pages = ['/', '/index.html', '/chi-siamo.html', '/contatti.html', '/servizi.html', '/progetti.html', '/progetto-appartamento-frascati.html', '/progetto-locale-frascati.html', '/progetto-negozio-roma.html', '/ristrutturazioni-frascati.html'];
    return ($event['consent'] ?? false) === true
        && is_string($event['visitor'] ?? null) && preg_match('/^[a-f0-9]{32}$/D', $event['visitor']) === 1
        && is_string($event['event'] ?? null) && preg_match('/^[a-f0-9]{32}$/D', $event['event']) === 1
        && in_array($event['path'] ?? null, $pages, true);
}

function statistics_record(PDO $pdo, array $event, ?DateTimeImmutable $today = null): bool {
    if (!statistics_valid_event($event)) return false;
    $today ??= statistics_today();
    $day = $today->format('Y-m-d');
    // Hash random browser identifiers, never IP addresses, fingerprints or form data.
    $visitor = hash('sha256', $event['visitor']);
    $eventHash = hash('sha256', $event['event']);
    $pdo->beginTransaction();
    try {
        $insert = $pdo->prepare('INSERT IGNORE INTO site_statistics_events (event_hash, visit_day) VALUES (?, ?)');
        $insert->execute([$eventHash, $day]);
        if ($insert->rowCount() === 0) { $pdo->rollBack(); return false; }
        $pdo->prepare('INSERT INTO site_statistics_visitors (visit_day, visitor_hash, views) VALUES (?, ?, 1)
            ON DUPLICATE KEY UPDATE views=LEAST(views + 1, 10000)')->execute([$day, $visitor]);
        $pdo->commit();
        statistics_clean($pdo, $today);
        return true;
    } catch (Throwable $exception) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        throw $exception;
    }
}

function statistics_report(PDO $pdo, int $period = 30, ?DateTimeImmutable $today = null): array {
    $today ??= statistics_today();
    statistics_clean($pdo, $today);
    $meta = $pdo->query('SELECT started_on FROM site_statistics_meta WHERE id=1')->fetchColumn();
    $totals = [];
    foreach ([1, 7, 30] as $days) {
        $query = $pdo->prepare('SELECT COALESCE(SUM(views), 0) AS views, COUNT(DISTINCT visitor_hash) AS visitors FROM site_statistics_visitors WHERE visit_day BETWEEN ? AND ?');
        $query->execute([$today->modify('-' . ($days - 1) . ' days')->format('Y-m-d'), $today->format('Y-m-d')]);
        $row = $query->fetch();
        $totals[$days] = ['views' => (int)$row['views'], 'visitors' => (int)$row['visitors']];
    }
    $period = $period === 7 ? 7 : 30;
    $start = $today->modify('-' . ($period - 1) . ' days');
    $query = $pdo->prepare('SELECT visit_day, SUM(views) AS views, COUNT(*) AS visitors FROM site_statistics_visitors WHERE visit_day BETWEEN ? AND ? GROUP BY visit_day ORDER BY visit_day');
    $query->execute([$start->format('Y-m-d'), $today->format('Y-m-d')]);
    $indexed = [];
    foreach ($query->fetchAll() as $row) $indexed[$row['visit_day']] = $row;
    $series = [];
    for ($date = $start; $date <= $today; $date = $date->modify('+1 day')) {
        $day = $date->format('Y-m-d');
        $row = $indexed[$day] ?? [];
        $series[] = ['date' => $day, 'label' => $date->format('d/m'), 'available' => $day >= $meta, 'views' => (int)($row['views'] ?? 0), 'visitors' => (int)($row['visitors'] ?? 0)];
    }
    return ['started_on' => (string)$meta, 'period' => $period, 'totals' => $totals, 'series' => $series];
}

<?php
declare(strict_types=1);
header('Cache-Control: no-store, private');
header('X-Robots-Tag: noindex, nofollow');
// The endpoint only accepts same-origin JSON. It never exposes statistics.
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') { http_response_code(405); exit; }
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($origin !== 'https://www.ferriristrutturazioni.com' || !str_starts_with(strtolower($_SERVER['CONTENT_TYPE'] ?? ''), 'application/json')) { http_response_code(403); exit; }
if (isset($_SERVER['HTTP_SEC_FETCH_SITE']) && $_SERVER['HTTP_SEC_FETCH_SITE'] !== 'same-origin') { http_response_code(403); exit; }
if (($_SERVER['HTTP_DNT'] ?? '') === '1' || ($_SERVER['HTTP_SEC_GPC'] ?? '') === '1') { http_response_code(204); exit; }
if (preg_match('/bot|crawl|spider|headless|preview|lighthouse/i', $_SERVER['HTTP_USER_AGENT'] ?? '')) { http_response_code(204); exit; }
$raw = file_get_contents('php://input', false, null, 0, 2049);
if ($raw === false || strlen($raw) > 2048) { http_response_code(400); exit; }
require __DIR__ . '/reviews-service.php';
require __DIR__ . '/statistics-service.php';
try {
    $event = json_decode($raw, true, 16, JSON_THROW_ON_ERROR);
    if (!is_array($event) || !statistics_valid_event($event)) { http_response_code(400); exit; }
    $pdo = reviews_db();
    statistics_schema($pdo);
    statistics_record($pdo, $event);
    http_response_code(204);
} catch (JsonException $exception) {
    http_response_code(400);
} catch (Throwable $exception) {
    error_log('Site statistics unavailable: ' . get_class($exception));
    http_response_code(503);
}

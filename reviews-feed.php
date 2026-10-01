<?php
declare(strict_types=1);
require __DIR__ . '/reviews-service.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
try {
    $rows = reviews_db()->query('SELECT customer_name, rating, review_text, published_at FROM site_reviews WHERE status="published" ORDER BY published_at DESC LIMIT 30')->fetchAll();
    echo json_encode(['reviews' => $rows], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    http_response_code(503);
    echo json_encode(['reviews' => []]);
}

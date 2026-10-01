<?php
declare(strict_types=1);
require __DIR__ . '/reviews-service.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') review_redirect('errore');
if (!empty($_POST['_review_hp'])) review_redirect('ok');

$name = review_clean((string)($_POST['review_name'] ?? ''), 100);
$text = review_clean((string)($_POST['review_text'] ?? ''), 1200);
$rating = (int)($_POST['review_rating'] ?? 0);
$privacy = isset($_POST['review_privacy']);
if ($name === '' || mb_strlen($text, 'UTF-8') < 10 || $rating < 1 || $rating > 5 || !$privacy) review_redirect('errore');

try {
    $stmt = reviews_db()->prepare('INSERT INTO site_reviews (customer_name, rating, review_text) VALUES (?, ?, ?)');
    $stmt->execute([$name, $rating, $text]);
    review_redirect('ok');
} catch (Throwable $e) {
    error_log('submit-review: ' . $e->getMessage());
    review_redirect('errore');
}

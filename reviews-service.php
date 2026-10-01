<?php
declare(strict_types=1);

function reviews_db(): PDO {
    static $pdo;
    if ($pdo instanceof PDO) return $pdo;

    $configPath = __DIR__ . '/../reviews-config.php';
    if (!is_file($configPath)) throw new RuntimeException('Configurazione recensioni non disponibile.');
    $config = require $configPath;
    $pdo = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
        $config['db_user'],
        $config['db_pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
    $pdo->exec('CREATE TABLE IF NOT EXISTS site_reviews (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(100) NOT NULL,
        rating TINYINT UNSIGNED NOT NULL,
        review_text TEXT NOT NULL,
        status ENUM("pending", "published") NOT NULL DEFAULT "pending",
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        published_at TIMESTAMP NULL DEFAULT NULL,
        INDEX status_created (status, created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    return $pdo;
}

function review_clean(string $value, int $max): string {
    $value = trim(preg_replace('/\s+/', ' ', $value) ?? '');
    return mb_substr($value, 0, $max, 'UTF-8');
}

function review_redirect(string $status): never {
    header('Location: index.html?review_status=' . rawurlencode($status) . '#recensioni', true, 303);
    exit;
}

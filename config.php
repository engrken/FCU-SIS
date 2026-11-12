<?php
require_once __DIR__ . '/security.php';

$host = getenv('FCU_SIS_DB_HOST');
$user = getenv('FCU_SIS_DB_USER');
$password = getenv('FCU_SIS_DB_PASSWORD');
$database = getenv('FCU_SIS_DB_NAME');

if (!$host || !$user || !$password || !$database) {
    http_response_code(503);
    exit('This service is unavailable.');
}

try {
    $link = mysqli_connect($host, $user, $password, $database);
    if (!$link || !mysqli_set_charset($link, 'utf8mb4')) {
        throw new RuntimeException('Database unavailable');
    }
} catch (Throwable $error) {
    http_response_code(503);
    exit('This service is unavailable.');
}

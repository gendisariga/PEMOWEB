<?php

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

if ($path === '/' || $path === '') {
    require __DIR__ . '/index.php';
    exit;
}

$file = realpath(__DIR__ . $path);

if ($file !== false && str_starts_with($file, __DIR__) && is_file($file)) {
    return false;
}

http_response_code(404);
echo 'Halaman tidak ditemukan.';
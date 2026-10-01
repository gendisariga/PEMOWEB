<?php

$host = getenv('PGHOST');
$port = getenv('PGPORT') ?: '5432';
$database = getenv('PGDATABASE');
$username = getenv('PGUSER');
$password = getenv('PGPASSWORD');

$missing = [];

foreach ([
    'PGHOST' => $host,
    'PGDATABASE' => $database,
    'PGUSER' => $username,
    'PGPASSWORD' => $password,
] as $name => $value) {
    if ($value === false || $value === '') {
        $missing[] = $name;
    }
}

if ($missing) {
    http_response_code(500);
    exit(
        'Konfigurasi database belum lengkap. Isi variable: '
        . implode(', ', $missing)
    );
}

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$database;sslmode=require",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $exception) {
    http_response_code(500);
    exit(
        'Koneksi PostgreSQL gagal: ' . $exception->getMessage()
    );
}
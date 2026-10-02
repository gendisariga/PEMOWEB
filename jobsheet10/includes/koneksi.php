<?php

$neonUrl = getenv('NEON_DATABASE_URL');

if ($neonUrl !== false && trim($neonUrl) !== '') {
    $connection = parse_url(trim($neonUrl));

    if (
        !is_array($connection)
        || !in_array($connection['scheme'] ?? '', ['postgres', 'postgresql'], true)
        || empty($connection['host'])
        || empty($connection['user'])
        || empty($connection['pass'])
        || empty($connection['path'])
    ) {
        http_response_code(500);
        exit('Variabel NEON_DATABASE_URL tidak valid.');
    }

    $host = $connection['host'];
    $port = $connection['port'] ?? 5432;
    $database = rawurldecode(ltrim($connection['path'], '/'));
    $username = rawurldecode($connection['user']);
    $password = rawurldecode($connection['pass']);
} else {
    $host = getenv('PGHOST');
    $port = getenv('PGPORT') ?: '5432';
    $database = getenv('PGDATABASE');
    $username = getenv('PGUSER');
    $password = getenv('PGPASSWORD');
}

$missing = [];

foreach ([
    'host' => $host,
    'database' => $database,
    'username' => $username,
    'password' => $password,
] as $name => $value) {
    if ($value === false || $value === '') {
        $missing[] = $name;
    }
}

if ($missing) {
    http_response_code(500);
    exit(
        'Konfigurasi database belum lengkap. Isi NEON_DATABASE_URL atau variable PG*: '
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
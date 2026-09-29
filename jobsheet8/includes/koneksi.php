<?php
$host = getenv('PGHOST') ?: 'ep-ancient-fog-b49op6nd-pooler.c-6.us-east-2.aws.neon.tech';
$port = getenv('PGPORT') ?: '5432';
$database = getenv('PGDATABASE') ?: 'neondb';
$username = getenv('PGUSER') ?: 'neondb_owner';
$password = getenv('PGPASSWORD') ?: '';

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
    exit('Koneksi PostgreSQL gagal. Periksa service, database, driver pdo_pgsql, serta PGUSER dan PGPASSWORD.');
}
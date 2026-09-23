<?php
$databasePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'clinic.sqlite';

try {
    $pdo = new PDO('sqlite:' . $databasePath, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $pdo->exec(<<<'SQL'
CREATE TABLE IF NOT EXISTS paket (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_paket TEXT NOT NULL,
    jenis TEXT NOT NULL,
    harga INTEGER NOT NULL CHECK (harga >= 0),
    estimasi TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS pelanggan (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    no_pelanggan TEXT NOT NULL UNIQUE,
    nama TEXT NOT NULL,
    alamat TEXT NOT NULL,
    no_hp TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS transaksi (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pelanggan_id INTEGER NOT NULL,
    paket_id INTEGER NOT NULL,
    berat REAL NOT NULL CHECK (berat > 0),
    total INTEGER NOT NULL CHECK (total >= 0),
    status TEXT NOT NULL DEFAULT 'Menunggu',
    tanggal TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS hewan (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    no_hewan TEXT NOT NULL UNIQUE,
    nama TEXT NOT NULL,
    jenis TEXT NOT NULL,
    ras TEXT NOT NULL,
    pemilik TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT 'Sehat'
);
SQL);

    if ((int) $pdo->query('SELECT COUNT(*) FROM paket')->fetchColumn() === 0) {
        $pdo->exec("INSERT INTO paket (nama_paket, jenis, harga, estimasi) VALUES
            ('Vaksin Rabies', 'Kesehatan', 150000, '1 hari'),
            ('Check Up Rutin', 'Kesehatan', 120000, '1 hari'),
            ('Grooming Basic', 'Perawatan', 95000, '2 hari'),
            ('Sterilisasi', 'Bedah', 450000, '3 hari'),
            ('Scaling Gigi', 'Dental', 250000, '2 hari')");
    }

    if ((int) $pdo->query('SELECT COUNT(*) FROM pelanggan')->fetchColumn() === 0) {
        $pdo->exec("INSERT INTO pelanggan (no_pelanggan, nama, alamat, no_hp) VALUES
            ('P001', 'Siti Aminah', 'Malang', '081234567890'),
            ('P002', 'Budi Santoso', 'Batu', '081345678901')");
    }

    if ((int) $pdo->query('SELECT COUNT(*) FROM hewan')->fetchColumn() === 0) {
        $pdo->exec("INSERT INTO hewan (no_hewan, nama, jenis, ras, pemilik, status) VALUES
            ('H001', 'Snowy', 'Kucing', 'Persia', 'Siti Aminah', 'Sehat'),
            ('H002', 'Max', 'Anjing', 'Golden Retriever', 'Budi Santoso', 'Perlu kontrol')");
    }

    if ((int) $pdo->query('SELECT COUNT(*) FROM transaksi')->fetchColumn() === 0) {
        $pdo->exec("INSERT INTO transaksi (pelanggan_id, paket_id, berat, total, status)
            VALUES (1, 1, 1, 150000, 'Selesai')");
    }
} catch (PDOException $exception) {
    http_response_code(500);
    exit('Database lokal belum dapat digunakan. Jalankan server dengan driver SQLite PHP.');
}

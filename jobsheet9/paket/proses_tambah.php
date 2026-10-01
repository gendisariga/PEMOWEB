<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$namaPaket = trim($_POST['nama_paket'] ?? '');
$jenis = trim($_POST['jenis'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$estimasi = trim($_POST['estimasi'] ?? '');

if ($namaPaket === '' || $jenis === '' || $estimasi === '' || !is_numeric($harga) || (int) $harga < 0) {
    set_flash('danger', 'Semua data paket wajib diisi dan harga harus valid.');
} else {
    $stmt = $pdo->prepare('INSERT INTO paket (nama_paket, jenis, harga, estimasi) VALUES (:nama_paket, :jenis, :harga, :estimasi)');
    $stmt->execute([
        ':nama_paket' => $namaPaket,
        ':jenis' => $jenis,
        ':harga' => (int) $harga,
        ':estimasi' => $estimasi,
    ]);
    set_flash('success', 'Paket berhasil ditambahkan.');
}

header('Location: list.php');
exit;

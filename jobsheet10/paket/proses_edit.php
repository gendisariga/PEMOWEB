<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$namaPaket = trim($_POST['nama_paket'] ?? '');
$jenis = trim($_POST['jenis'] ?? '');
$harga = trim($_POST['harga'] ?? '');
$estimasi = trim($_POST['estimasi'] ?? '');

if (!$id || $namaPaket === '' || $jenis === '' || $estimasi === '' || !is_numeric($harga) || (int) $harga < 0) {
    set_flash('danger', 'Data layanan tidak valid.');
} else {
    $stmt = $pdo->prepare('UPDATE paket SET nama_paket = :nama_paket, jenis = :jenis, harga = :harga, estimasi = :estimasi WHERE id = :id');
    $stmt->execute([':nama_paket' => $namaPaket, ':jenis' => $jenis, ':harga' => (int) $harga, ':estimasi' => $estimasi, ':id' => $id]);
    set_flash('success', 'Layanan berhasil diperbarui.');
}

header('Location: list.php');
exit;
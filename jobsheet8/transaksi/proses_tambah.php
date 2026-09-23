<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$pelangganId = (int) ($_POST['pelanggan_id'] ?? 0);
$paketId = (int) ($_POST['paket_id'] ?? 0);
$berat = (float) ($_POST['berat'] ?? 0);
$total = (int) ($_POST['total'] ?? 0);

if ($pelangganId < 1 || $paketId < 1 || $berat <= 0 || $total < 0) {
    set_flash('danger', 'Data transaksi belum lengkap atau tidak valid.');
} else {
    $stmt = $pdo->prepare('INSERT INTO transaksi (pelanggan_id, paket_id, berat, total) VALUES (:pelanggan_id, :paket_id, :berat, :total)');
    $stmt->execute([
        ':pelanggan_id' => $pelangganId,
        ':paket_id' => $paketId,
        ':berat' => $berat,
        ':total' => $total,
    ]);
    set_flash('success', 'Transaksi berhasil ditambahkan.');
}

header('Location: list.php');
exit;

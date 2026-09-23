<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$fields = ['no_hewan', 'nama', 'jenis', 'ras', 'pemilik', 'status'];
$data = [];
foreach ($fields as $field) {
    $data[$field] = trim($_POST[$field] ?? '');
}

if (in_array('', $data, true)) {
    set_flash('danger', 'Semua data pasien hewan wajib diisi.');
} else {
    try {
        $stmt = $pdo->prepare('INSERT INTO hewan (no_hewan, nama, jenis, ras, pemilik, status) VALUES (:no_hewan, :nama, :jenis, :ras, :pemilik, :status)');
        $stmt->execute($data);
        set_flash('success', 'Pasien hewan berhasil ditambahkan.');
    } catch (PDOException $exception) {
        set_flash('danger', 'Nomor pasien sudah dipakai. Gunakan nomor lain.');
    }
}

header('Location: list.php');
exit;

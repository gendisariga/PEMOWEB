<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$noPelanggan = trim($_POST['no_pelanggan'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if ($noPelanggan === '' || $nama === '' || $alamat === '' || $noHp === '') {
    set_flash('danger', 'Semua data pelanggan wajib diisi.');
} else {
    try {
        $stmt = $pdo->prepare('INSERT INTO pelanggan (no_pelanggan, nama, alamat, no_hp) VALUES (:no_pelanggan, :nama, :alamat, :no_hp)');
        $stmt->execute([
            ':no_pelanggan' => $noPelanggan,
            ':nama' => $nama,
            ':alamat' => $alamat,
            ':no_hp' => $noHp,
        ]);
        set_flash('success', 'Pelanggan berhasil ditambahkan.');
    } catch (PDOException $exception) {
        set_flash('danger', 'Nomor pelanggan sudah dipakai. Gunakan nomor lain.');
    }
}

header('Location: list.php');
exit;

<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    set_flash('danger', 'ID layanan tidak valid.');
} else {
    try {
        $stmt = $pdo->prepare('DELETE FROM paket WHERE id = :id');
        $stmt->execute([':id' => $id]);
        set_flash('success', 'Layanan berhasil dihapus.');
    } catch (PDOException $exception) {
        set_flash('danger', 'Layanan tidak dapat dihapus karena sudah dipakai pada transaksi.');
    }
}

header('Location: list.php');
exit;
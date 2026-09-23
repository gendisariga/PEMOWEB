<?php
session_start();

$rootDir = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
$pageDir = realpath(dirname($_SERVER['SCRIPT_FILENAME'] ?? __FILE__));
$relativeDir = $pageDir && $rootDir ? trim(str_replace($rootDir, '', $pageDir), DIRECTORY_SEPARATOR) : '';
$depth = $relativeDir === '' ? 0 : count(array_filter(preg_split('/[\\\\\/]/', $relativeDir)));
$base = str_repeat('../', $depth);
$title = $title ?? 'Klinik Hewan Winadivet';
$active = $active ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body>
<header>
    <h1>Klinik Hewan Winadivet</h1>
    <button type="button" id="nav-toggle-btn" class="nav-toggle-btn" aria-label="Buka menu">☰</button>
    <nav><ul>
        <li><a href="<?= $base ?>index.php">Beranda</a></li>
        <li><a href="<?= $base ?>paket/list.php">Daftar Paket</a></li>
        <li><a href="<?= $base ?>paket/tambah.php">Tambah Paket</a></li>
        <li><a href="<?= $base ?>pelanggan/list.php">Daftar Pelanggan</a></li>
        <li><a href="<?= $base ?>hewan/list.php">Pasien Hewan</a></li>
        <li><a href="<?= $base ?>transaksi/list.php">Transaksi</a></li>
        <li><a href="<?= $base ?>logout.php">Logout</a></li>
    </ul></nav>
</header>

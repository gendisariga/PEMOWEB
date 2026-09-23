<?php
$title = 'Beranda | Klinik Hewan Winadivet';
$active = 'home';
require __DIR__ . '/includes/header.php';
?>
<main><section>
    <h2>Selamat Datang di Klinik Hewan Winadivet</h2>
    <p class="lead">Kelola paket laundry, pelanggan, dan transaksi dengan mudah.</p>
    <div class="row g-4">
        <div class="col-md-4"><article class="feature-card"><h3>Paket Laundry</h3><p>Kelola jenis layanan dan harga paket laundry.</p><a class="btn btn-primary" href="paket/list.php">Lihat Paket</a></article></div>
        <div class="col-md-4"><article class="feature-card"><h3>Pelanggan</h3><p>Kelola data pelanggan laundry secara terpusat.</p><a class="btn btn-primary" href="pelanggan/list.php">Lihat Pelanggan</a></article></div>
        <div class="col-md-4"><article class="feature-card"><h3>Transaksi</h3><p>Catat dan pantau transaksi laundry harian.</p><a class="btn btn-primary" href="transaksi/list.php">Lihat Transaksi</a></article></div>
    </div>
</section></main>
<?php require __DIR__ . '/includes/footer.php'; ?>

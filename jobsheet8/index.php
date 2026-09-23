<?php
$title = 'Beranda | Klinik Hewan Winadivet';
$active = 'home';
require __DIR__ . '/includes/koneksi.php';
require __DIR__ . '/includes/header.php';
$totalPaket = (int) $pdo->query('SELECT COUNT(*) FROM paket')->fetchColumn();
$totalPelanggan = (int) $pdo->query('SELECT COUNT(*) FROM pelanggan')->fetchColumn();
$totalTransaksi = (int) $pdo->query('SELECT COUNT(*) FROM transaksi')->fetchColumn();
$totalHewan = (int) $pdo->query('SELECT COUNT(*) FROM hewan')->fetchColumn();
?>
<main><section>
    <div class="dashboard-intro">
        <span class="eyebrow"><i class="bi bi-heart-pulse-fill" aria-hidden="true"></i> Perawatan penuh kasih</span>
        <h2>Selamat Datang di Klinik Hewan Winadivet</h2>
        <p class="lead">Kelola pasien, pemilik, layanan, dan kunjungan klinik dalam satu tempat.</p>
    </div>
    <div class="row g-4">
        <div class="col-md-6 col-xl-3"><article class="feature-card"><i class="bi bi-shield-plus feature-icon" aria-hidden="true"></i><h3>Layanan Klinik</h3><p>Kelola jenis layanan dan tarif pemeriksaan.</p><a class="btn btn-primary" href="paket/list.php"><i class="bi bi-arrow-right-circle" aria-hidden="true"></i> Lihat Layanan</a></article></div>
        <div class="col-md-6 col-xl-3"><article class="feature-card"><i class="bi bi-person-heart feature-icon" aria-hidden="true"></i><h3>Pemilik</h3><p>Kelola data pemilik pasien secara terpusat.</p><a class="btn btn-primary" href="pelanggan/list.php"><i class="bi bi-arrow-right-circle" aria-hidden="true"></i> Lihat Pemilik</a></article></div>
        <div class="col-md-6 col-xl-3"><article class="feature-card"><i class="bi bi-calendar2-check feature-icon" aria-hidden="true"></i><h3>Kunjungan</h3><p>Catat layanan dan pantau kunjungan klinik.</p><a class="btn btn-primary" href="transaksi/list.php"><i class="bi bi-arrow-right-circle" aria-hidden="true"></i> Lihat Kunjungan</a></article></div>
        <div class="col-md-6 col-xl-3"><article class="feature-card"><i class="bi bi-heart-pulse feature-icon" aria-hidden="true"></i><h3>Pasien Hewan</h3><p>Simpan profil dan status kesehatan setiap pasien.</p><a class="btn btn-primary" href="hewan/list.php"><i class="bi bi-arrow-right-circle" aria-hidden="true"></i> Lihat Pasien</a></article></div>
    </div>
    <h2 class="mt-5">Ringkasan</h2>
    <div class="row g-4">
        <div class="col-md-6 col-xl-3"><article class="stat-card stat-1 h-100"><i class="bi bi-clipboard2-pulse stat-icon" aria-hidden="true"></i><h3>Layanan</h3><p><?= $totalPaket ?></p></article></div>
        <div class="col-md-6 col-xl-3"><article class="stat-card stat-2 h-100"><i class="bi bi-people stat-icon" aria-hidden="true"></i><h3>Pemilik</h3><p><?= $totalPelanggan ?></p></article></div>
        <div class="col-md-6 col-xl-3"><article class="stat-card stat-3 h-100"><i class="bi bi-calendar-check stat-icon" aria-hidden="true"></i><h3>Kunjungan</h3><p><?= $totalTransaksi ?></p></article></div>
        <div class="col-md-6 col-xl-3"><article class="stat-card stat-4 h-100"><i class="bi bi-heart-pulse stat-icon" aria-hidden="true"></i><h3>Pasien Hewan</h3><p><?= $totalHewan ?></p></article></div>
    </div>
</section></main>
<?php require __DIR__ . '/includes/footer.php'; ?>

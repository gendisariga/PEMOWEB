<?php
$title = 'Pasien Hewan | Klinik Hewan Winadivet';
$active = 'hewan';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/flash.php';
$hewan = $pdo->query('SELECT id, no_hewan, nama, jenis, ras, pemilik, status FROM hewan ORDER BY id DESC')->fetchAll();
$flash = pull_flash();
?>
<main><section>
    <?php if ($flash): ?><div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>" role="alert"><?= htmlspecialchars($flash['message']) ?></div><?php endif; ?>
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2"><h2>Pasien Hewan</h2><a href="tambah.php" class="btn btn-primary">+ Tambah Pasien</a></div>
    <input type="search" class="search-box" data-target="#tabel-hewan" placeholder="Cari nama, jenis, atau pemilik..." autocomplete="off">
    <div class="table-responsive"><table id="tabel-hewan" class="table table-hover table-bordered align-middle"><thead><tr><th>No</th><th>No. Pasien</th><th>Nama</th><th>Jenis</th><th>Ras</th><th>Pemilik</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
    <?php if (!$hewan): ?><tr><td colspan="8" class="text-center">Belum ada data pasien hewan.</td></tr><?php else: ?><?php foreach ($hewan as $index => $item): ?><tr><td><?= $index + 1 ?></td><td><?= htmlspecialchars($item['no_hewan']) ?></td><td><?= htmlspecialchars($item['nama']) ?></td><td><?= htmlspecialchars($item['jenis']) ?></td><td><?= htmlspecialchars($item['ras']) ?></td><td><?= htmlspecialchars($item['pemilik']) ?></td><td><?= htmlspecialchars($item['status']) ?></td><td><button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">Cetak</button></td></tr><?php endforeach; ?><?php endif; ?>
    </tbody></table></div>
</section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

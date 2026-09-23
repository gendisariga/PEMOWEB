<?php
$title = 'Daftar Paket | Klinik Hewan Winadivet';
$active = 'paket';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/flash.php';
$paket = $pdo->query('SELECT id, nama_paket, jenis, harga, estimasi FROM paket ORDER BY id DESC')->fetchAll();
$flash = pull_flash();
?>
<main><section>
	<?php if ($flash): ?><div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>" role="alert"><?= htmlspecialchars($flash['message']) ?></div><?php endif; ?>
	<div class="d-flex justify-content-between align-items-center mb-3"><h2>Daftar Paket</h2><a href="tambah.php" class="btn btn-primary">+ Tambah Paket</a></div>
	<div class="table-responsive"><table class="table table-hover table-bordered"><thead><tr><th>No</th><th>Nama Paket</th><th>Jenis</th><th>Harga</th><th>Estimasi</th><th>Aksi</th></tr></thead><tbody>
	<?php if (!$paket): ?><tr><td colspan="6" class="text-center">Belum ada data paket.</td></tr><?php else: ?><?php foreach ($paket as $index => $item): ?><tr><td><?= $index + 1 ?></td><td><?= htmlspecialchars($item['nama_paket']) ?></td><td><?= htmlspecialchars($item['jenis']) ?></td><td>Rp<?= number_format((int) $item['harga'], 0, ',', '.') ?></td><td><?= htmlspecialchars($item['estimasi']) ?></td><td><button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">Cetak</button></td></tr><?php endforeach; ?><?php endif; ?>
	</tbody></table></div>
</section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

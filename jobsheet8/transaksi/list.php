<?php
$title = 'Transaksi | Klinik Hewan Winadivet';
$active = 'transaksi';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/flash.php';
$transaksi = $pdo->query('SELECT t.id, p.nama AS pelanggan, k.nama_paket, t.berat, t.total, t.status, t.tanggal FROM transaksi t JOIN pelanggan p ON p.id = t.pelanggan_id JOIN paket k ON k.id = t.paket_id ORDER BY t.id DESC')->fetchAll();
$flash = pull_flash();
?>
<main><section>
	<?php if ($flash): ?><div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>" role="alert"><?= htmlspecialchars($flash['message']) ?></div><?php endif; ?>
	<div class="d-flex justify-content-between align-items-center mb-3"><h2>Transaksi</h2><a href="tambah.php" class="btn btn-primary">+ Tambah Transaksi</a></div>
	<input type="search" class="search-box" data-target="#tabel-transaksi" placeholder="Cari transaksi..." autocomplete="off">
	<div class="table-responsive"><table id="tabel-transaksi" class="table table-hover table-bordered"><thead><tr><th>No</th><th>Pelanggan</th><th>Paket</th><th>Berat</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
	<?php if (!$transaksi): ?><tr><td colspan="7" class="text-center">Belum ada transaksi.</td></tr><?php else: ?><?php foreach ($transaksi as $index => $item): ?><tr><td><?= $index + 1 ?></td><td><?= htmlspecialchars($item['pelanggan']) ?></td><td><?= htmlspecialchars($item['nama_paket']) ?></td><td><?= htmlspecialchars($item['berat']) ?> kg</td><td>Rp<?= number_format((int) $item['total'], 0, ',', '.') ?></td><td><?= htmlspecialchars($item['status']) ?></td><td><button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">Cetak</button></td></tr><?php endforeach; ?><?php endif; ?>
	</tbody></table></div>
</section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

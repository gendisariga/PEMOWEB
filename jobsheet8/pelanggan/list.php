<?php
$title = 'Daftar Pelanggan | Klinik Hewan Winadivet';
$active = 'pelanggan';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/flash.php';
$pelanggan = $pdo->query('SELECT id, no_pelanggan, nama, alamat, no_hp FROM pelanggan ORDER BY id DESC')->fetchAll();
$flash = pull_flash();
?>
<main><section>
	<?php if ($flash): ?><div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>" role="alert"><?= htmlspecialchars($flash['message']) ?></div><?php endif; ?>
	<div class="d-flex justify-content-between align-items-center mb-3"><h2>Daftar Pelanggan</h2><a href="tambah.php" class="btn btn-primary">+ Tambah Pelanggan</a></div>
	<div class="table-responsive"><table class="table table-hover table-bordered"><thead><tr><th>No</th><th>No. Pelanggan</th><th>Nama</th><th>Alamat</th><th>No. HP</th></tr></thead><tbody>
	<?php if (!$pelanggan): ?><tr><td colspan="5" class="text-center">Belum ada data pelanggan.</td></tr><?php else: ?><?php foreach ($pelanggan as $index => $item): ?><tr><td><?= $index + 1 ?></td><td><?= htmlspecialchars($item['no_pelanggan']) ?></td><td><?= htmlspecialchars($item['nama']) ?></td><td><?= htmlspecialchars($item['alamat']) ?></td><td><?= htmlspecialchars($item['no_hp']) ?></td></tr><?php endforeach; ?><?php endif; ?>
	</tbody></table></div>
</section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

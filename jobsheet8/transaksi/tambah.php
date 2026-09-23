<?php
$title = 'Tambah Transaksi | Klinik Hewan Winadivet';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/header.php';
$pelanggan = $pdo->query('SELECT id, no_pelanggan, nama FROM pelanggan ORDER BY nama')->fetchAll();
$paket = $pdo->query('SELECT id, nama_paket, harga FROM paket ORDER BY nama_paket')->fetchAll();
?>
<main><section><h2>Tambah Transaksi</h2><form method="post" action="proses_tambah.php">
	<div class="mb-3"><label class="form-label" for="pelanggan_id">Pelanggan</label><select class="form-select" id="pelanggan_id" name="pelanggan_id" required><option value="">Pilih pelanggan</option><?php foreach ($pelanggan as $item): ?><option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['no_pelanggan'] . ' - ' . $item['nama']) ?></option><?php endforeach; ?></select></div>
	<div class="mb-3"><label class="form-label" for="paket_id">Paket</label><select class="form-select" id="paket_id" name="paket_id" required><option value="">Pilih paket</option><?php foreach ($paket as $item): ?><option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['nama_paket']) ?> - Rp<?= number_format((int) $item['harga'], 0, ',', '.') ?></option><?php endforeach; ?></select></div>
	<div class="mb-3"><label class="form-label" for="berat">Berat (kg)</label><input class="form-control" type="number" id="berat" name="berat" min="0.01" step="0.01" required></div>
	<div class="mb-3"><label class="form-label" for="total">Total</label><input class="form-control" type="number" id="total" name="total" min="0" required></div>
	<button class="btn btn-primary">Simpan</button> <a href="list.php" class="btn btn-secondary">Kembali</a>
</form></section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

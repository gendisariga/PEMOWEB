<?php
$title = 'Edit Layanan | Klinik Hewan Winadivet';
$active = 'paket';
require __DIR__ . '/../includes/koneksi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare('SELECT id, nama_paket, jenis, harga, estimasi FROM paket WHERE id = :id');
$stmt->execute([':id' => $id]);
$paket = $stmt->fetch();

if (!$paket) {
    header('Location: list.php');
    exit;
}

require __DIR__ . '/../includes/header.php';
?>
<main><section><h2>Edit Layanan Klinik</h2><form method="post" action="proses_edit.php"><input type="hidden" name="id" value="<?= (int) $paket['id'] ?>"><div class="mb-3"><label class="form-label" for="nama_paket">Nama Layanan</label><input class="form-control" id="nama_paket" name="nama_paket" value="<?= htmlspecialchars($paket['nama_paket']) ?>" required></div><div class="mb-3"><label class="form-label" for="jenis">Jenis</label><input class="form-control" id="jenis" name="jenis" value="<?= htmlspecialchars($paket['jenis']) ?>" required></div><div class="mb-3"><label class="form-label" for="harga">Tarif</label><input class="form-control" type="number" id="harga" name="harga" min="0" value="<?= (int) $paket['harga'] ?>" required></div><div class="mb-3"><label class="form-label" for="estimasi">Estimasi</label><input class="form-control" id="estimasi" name="estimasi" value="<?= htmlspecialchars($paket['estimasi']) ?>" required></div><button class="btn btn-primary">Simpan Perubahan</button> <a href="list.php" class="btn btn-secondary">Batal</a></form></section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>
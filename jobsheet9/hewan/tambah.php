<?php
$title = 'Tambah Pasien Hewan | Klinik Hewan Winadivet';
$active = 'hewan';
require __DIR__ . '/../includes/header.php';
?>
<main><section><h2>Tambah Pasien Hewan</h2><form method="post" action="proses_tambah.php">
    <div class="mb-3"><label class="form-label" for="no_hewan">No. Pasien</label><input class="form-control" id="no_hewan" name="no_hewan" placeholder="Contoh: H001" required></div>
    <div class="mb-3"><label class="form-label" for="nama">Nama Hewan</label><input class="form-control" id="nama" name="nama" placeholder="Contoh: Mochi" required></div>
    <div class="mb-3"><label class="form-label" for="jenis">Jenis Hewan</label><select class="form-select" id="jenis" name="jenis" required><option value="">Pilih jenis</option><option>Kucing</option><option>Anjing</option><option>Kelinci</option><option>Burung</option><option>Reptil</option><option>Lainnya</option></select></div>
    <div class="mb-3"><label class="form-label" for="ras">Ras</label><input class="form-control" id="ras" name="ras" placeholder="Contoh: Persia" required></div>
    <div class="mb-3"><label class="form-label" for="pemilik">Nama Pemilik</label><input class="form-control" id="pemilik" name="pemilik" required></div>
    <div class="mb-3"><label class="form-label" for="status">Status Kesehatan</label><select class="form-select" id="status" name="status"><option>Sehat</option><option>Dalam Perawatan</option><option>Kontrol Ulang</option></select></div>
    <button class="btn btn-primary" type="submit">Simpan Pasien</button> <a href="list.php" class="btn btn-secondary">Kembali</a>
</form></section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

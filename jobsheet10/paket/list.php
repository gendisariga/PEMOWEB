<?php
$title = 'Daftar Paket | Klinik Hewan Winadivet';
$active = 'paket';
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/flash.php';
$query = trim($_GET['q'] ?? '');
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 5;
$offset = ($page - 1) * $perPage;

$where = '';
$params = [];
if ($query !== '') {
	$where = ' WHERE LOWER(nama_paket) LIKE LOWER(:query) OR LOWER(jenis) LIKE LOWER(:query) OR LOWER(estimasi) LIKE LOWER(:query)';
    $params[':query'] = '%' . $query . '%';
}

$countStmt = $pdo->prepare('SELECT COUNT(*) FROM paket' . $where);
$countStmt->execute($params);
$totalRows = (int) $countStmt->fetchColumn();
$totalPages = max(1, (int) ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

$listStmt = $pdo->prepare('SELECT id, nama_paket, jenis, harga, estimasi FROM paket' . $where . ' ORDER BY id DESC LIMIT :limit OFFSET :offset');
foreach ($params as $name => $value) {
    $listStmt->bindValue($name, $value, PDO::PARAM_STR);
}
$listStmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$listStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$listStmt->execute();
$paket = $listStmt->fetchAll();
$flash = pull_flash();
?>
<main><section>
	<?php if ($flash): ?><div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>" role="alert"><?= htmlspecialchars($flash['message']) ?></div><?php endif; ?>
	<div class="d-flex justify-content-between align-items-center mb-3"><h2>Daftar Paket</h2><a href="tambah.php" class="btn btn-primary">+ Tambah Paket</a></div>
	<form method="get" class="server-search"><input type="search" name="q" class="search-box" value="<?= htmlspecialchars($query) ?>" placeholder="Cari layanan klinik..." autocomplete="off"><button class="btn btn-primary" type="submit"><i class="bi bi-search" aria-hidden="true"></i> Cari</button><?php if ($query !== ''): ?><a class="btn btn-outline-secondary" href="list.php">Reset</a><?php endif; ?></form>
	<div class="table-responsive"><table id="tabel-paket" class="table table-hover table-bordered"><thead><tr><th>No</th><th>Nama Paket</th><th>Jenis</th><th>Harga</th><th>Estimasi</th><th>Aksi</th></tr></thead><tbody>
	<?php if (!$paket): ?><tr><td colspan="6" class="text-center">Tidak ada layanan yang cocok.</td></tr><?php else: ?><?php foreach ($paket as $index => $item): ?><tr><td><?= $offset + $index + 1 ?></td><td><?= htmlspecialchars($item['nama_paket']) ?></td><td><?= htmlspecialchars($item['jenis']) ?></td><td>Rp<?= number_format((int) $item['harga'], 0, ',', '.') ?></td><td><?= htmlspecialchars($item['estimasi']) ?></td><td class="action-buttons"><a class="btn btn-warning btn-sm" href="edit.php?id=<?= (int) $item['id'] ?>">Edit</a><form method="post" action="hapus.php" class="form-hapus"><input type="hidden" name="id" value="<?= (int) $item['id'] ?>"><button type="submit" class="btn btn-danger btn-sm">Hapus</button></form></td></tr><?php endforeach; ?><?php endif; ?>
	</tbody></table></div>
	<?php if ($totalPages > 1): ?><nav aria-label="Pagination layanan"><ul class="pagination"><li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="?q=<?= urlencode($query) ?>&page=<?= $page - 1 ?>">Sebelumnya</a></li><?php for ($number = 1; $number <= $totalPages; $number++): ?><li class="page-item <?= $number === $page ? 'active' : '' ?>"><a class="page-link" href="?q=<?= urlencode($query) ?>&page=<?= $number ?>"><?= $number ?></a></li><?php endfor; ?><li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?q=<?= urlencode($query) ?>&page=<?= $page + 1 ?>">Berikutnya</a></li></ul></nav><?php endif; ?>
</section></main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

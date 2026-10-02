<?php
require __DIR__ . '/../includes/koneksi.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    exit('ID transaksi tidak valid.');
}

$stmt = $pdo->prepare('SELECT t.id, p.nama AS pelanggan, k.nama_paket, t.berat, t.total, t.status, t.tanggal FROM transaksi t JOIN pelanggan p ON p.id = t.pelanggan_id JOIN paket k ON k.id = t.paket_id WHERE t.id = :id');
$stmt->execute([':id' => $id]);
$transaksi = $stmt->fetch();

if (!$transaksi) {
    http_response_code(404);
    exit('Transaksi tidak ditemukan.');
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$tanggal = date('d/m/Y H:i', strtotime($transaksi['tanggal']));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk #<?= (int) $transaksi['id'] ?> | Klinik Hewan Winadivet</title>
    <style>
        @page { size: A5; margin: 12mm; }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; color: #172033; }
        .receipt { max-width: 380px; margin: 0 auto; }
        header { padding-bottom: 14px; border-bottom: 2px solid #0f766e; }
        h1 { margin: 0 0 3px; color: #0f766e; font-size: 22px; }
        header p { margin: 0; color: #64748b; font-size: 12px; }
        .meta { display: flex; justify-content: space-between; gap: 12px; margin: 14px 0; color: #64748b; font-size: 11px; }
        dl { margin: 0; border-top: 1px solid #cbd5e1; border-bottom: 1px solid #cbd5e1; padding: 10px 0; }
        dt { margin-top: 9px; color: #64748b; font-size: 11px; }
        dt:first-child { margin-top: 0; }
        dd { margin: 2px 0 0; font-weight: 700; font-size: 14px; }
        .total { display: flex; justify-content: space-between; margin-top: 14px; font-size: 16px; font-weight: 700; }
        .thanks { margin-top: 24px; text-align: center; color: #0f766e; font-size: 12px; font-weight: 700; }
        .print-button { display: block; margin: 24px auto 0; padding: 10px 18px; border: 0; border-radius: 6px; background: #0f766e; color: white; cursor: pointer; }
        @media print { .print-button { display: none; } .receipt { max-width: none; } }
    </style>
</head>
<body>
    <article class="receipt">
        <header>
            <h1>Klinik Hewan Winadivet</h1>
            <p>Struk pembayaran kunjungan klinik</p>
        </header>
        <div class="meta"><span>No. transaksi: <?= (int) $transaksi['id'] ?></span><span><?= e($tanggal) ?></span></div>
        <dl>
            <dt>Nama pemilik</dt><dd><?= e($transaksi['pelanggan']) ?></dd>
            <dt>Layanan</dt><dd><?= e($transaksi['nama_paket']) ?></dd>
            <dt>Berat / jumlah</dt><dd><?= e((string) $transaksi['berat']) ?> kg</dd>
            <dt>Status</dt><dd><?= e($transaksi['status']) ?></dd>
        </dl>
        <div class="total"><span>Total pembayaran</span><span>Rp<?= number_format((int) $transaksi['total'], 0, ',', '.') ?></span></div>
        <div class="thanks">Terima kasih telah menggunakan layanan kami.</div>
        <button class="print-button" type="button" onclick="window.print()">Cetak Halaman</button>
    </article>
    <script>window.addEventListener('load', function () { window.print(); });</script>
</body>
</html>
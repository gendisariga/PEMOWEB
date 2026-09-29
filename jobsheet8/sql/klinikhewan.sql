CREATE TABLE IF NOT EXISTS paket (
    id SERIAL PRIMARY KEY,
    nama_paket VARCHAR(100) NOT NULL,
    jenis VARCHAR(50) NOT NULL,
    harga INTEGER NOT NULL CHECK (harga >= 0),
    estimasi VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS pelanggan (
    id SERIAL PRIMARY KEY,
    no_pelanggan VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    alamat VARCHAR(255) NOT NULL,
    no_hp VARCHAR(30) NOT NULL
);

CREATE TABLE IF NOT EXISTS transaksi (
    id SERIAL PRIMARY KEY,
    pelanggan_id INTEGER NOT NULL REFERENCES pelanggan(id),
    paket_id INTEGER NOT NULL REFERENCES paket(id),
    berat NUMERIC(8, 2) NOT NULL CHECK (berat > 0),
    total INTEGER NOT NULL CHECK (total >= 0),
    status VARCHAR(30) NOT NULL DEFAULT 'Diproses',
    tanggal TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS hewan (
    id SERIAL PRIMARY KEY,
    no_hewan VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis VARCHAR(50) NOT NULL,
    ras VARCHAR(80) NOT NULL,
    pemilik VARCHAR(100) NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'Sehat'
);

INSERT INTO paket (nama_paket, jenis, harga, estimasi)
SELECT seed.nama_paket, seed.jenis, seed.harga, seed.estimasi
FROM (VALUES
    ('Vaksin Rabies', 'Kesehatan', 150000, '1 hari'),
    ('Check Up Rutin', 'Kesehatan', 120000, '1 hari'),
    ('Grooming Basic', 'Perawatan', 95000, '2 hari'),
    ('Sterilisasi', 'Bedah', 450000, '3 hari'),
    ('Scaling Gigi', 'Dental', 250000, '2 hari')
) AS seed(nama_paket, jenis, harga, estimasi)
WHERE NOT EXISTS (
    SELECT 1
    FROM paket
    WHERE paket.nama_paket = seed.nama_paket
);

INSERT INTO pelanggan (no_pelanggan, nama, alamat, no_hp)
VALUES
    ('P001', 'Siti Aminah', 'Malang', '081234567890'),
    ('P002', 'Budi Santoso', 'Batu', '081345678901')
ON CONFLICT (no_pelanggan) DO NOTHING;

INSERT INTO hewan (no_hewan, nama, jenis, ras, pemilik, status)
VALUES
    ('H001', 'Snowy', 'Kucing', 'Persia', 'Siti Aminah', 'Sehat'),
    ('H002', 'Max', 'Anjing', 'Golden Retriever', 'Budi Santoso', 'Perlu kontrol')
ON CONFLICT (no_hewan) DO NOTHING;

INSERT INTO transaksi (pelanggan_id, paket_id, berat, total, status)
SELECT
    pelanggan.id,
    paket.id,
    1,
    paket.harga,
    'Selesai'
FROM pelanggan
CROSS JOIN paket
WHERE pelanggan.no_pelanggan = 'P001'
  AND paket.nama_paket = 'Vaksin Rabies'
  AND NOT EXISTS (
      SELECT 1
      FROM transaksi
      WHERE transaksi.pelanggan_id = pelanggan.id
        AND transaksi.paket_id = paket.id
        AND transaksi.status = 'Selesai'
  );
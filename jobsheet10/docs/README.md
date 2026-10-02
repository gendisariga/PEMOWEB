# Jobsheet 10 - Klinik Hewan Winadivet

Aplikasi memakai PostgreSQL melalui PDO dan siap dijalankan di Railway dengan database Neon. File `data/clinic.sqlite` tidak digunakan oleh aplikasi.

## Menyiapkan Neon

Gunakan project Neon jobsheet8 yang sudah ada; tidak perlu membuat project baru. Skema jobsheet10 sama dengan jobsheet8. Jika tabelnya sudah tersedia, tidak perlu menjalankan SQL lagi. Jika belum, buka Neon SQL Editor dan jalankan `sql/klinikhewan.sql`.

Di Neon, buka **Connect**, pilih branch, database, dan role yang benar, lalu salin connection string PostgreSQL. Jangan membagikan connection string karena password ada di dalamnya.

## Deploy ke Railway

1. Buat service Railway dari repository GitHub yang berisi project ini.
2. Atur **Root Directory** menjadi `jobsheet10` agar Railway menggunakan Dockerfile di folder tersebut.
3. Tambahkan variabel `NEON_DATABASE_URL` di Railway, dengan connection string dari Neon. Aplikasi mendekode karakter khusus dalam username/password URL secara otomatis. Jika lebih nyaman, aplikasi tetap mendukung variabel terpisah berikut:

	- `PGHOST`
	- `PGPORT` (biasanya `5432`)
	- `PGDATABASE`
	- `PGUSER`
	- `PGPASSWORD`

4. Deploy service dan buka domain publik yang disediakan Railway.

Dockerfile memasang `pdo_pgsql` dan menjalankan server pada port yang diberikan Railway. Koneksi database menggunakan SSL.

## Menjalankan lokal

PHP 8.2 atau lebih baru dan ekstensi `pdo_pgsql` diperlukan. Atur `NEON_DATABASE_URL` atau variabel `PG*` di sesi PowerShell, lalu dari folder `jobsheet10` jalankan:

```powershell
Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
.\run.ps1
```

Buka `http://localhost:8000`. Jangan simpan kredensial database ke repository.

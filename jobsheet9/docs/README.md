# Jobsheet 9 - CRUD Klinik Hewan Winadivet

Aplikasi menggunakan PostgreSQL Neon melalui PDO. PHP harus memuat ekstensi `pdo_pgsql`.

## Menyiapkan database dan menjalankan

Buka PowerShell di folder utama proyek `js3,4,5`, lalu jalankan:

```powershell
$phpDir = Split-Path (Get-Command php).Source
$env:PGHOST = 'ep-ancient-fog-b49op6nd-pooler.c-6.us-east-2.aws.neon.tech'
$env:PGPORT = '5432'
$env:PGDATABASE = 'neondb'
$env:PGUSER = 'neondb_owner'
$securePassword = Read-Host 'Password Neon' -AsSecureString
$env:PGPASSWORD = [System.Net.NetworkCredential]::new('', $securePassword).Password

php -d "extension_dir=$phpDir\ext" -d extension=php_pdo_pgsql.dll -S localhost:8000 -t .\jobsheet9
```

Masukkan password Neon saat diminta; password hanya disimpan di environment terminal saat itu. Biarkan terminal server tetap terbuka, lalu buka `http://localhost:8000/index.php`.

## Fitur Jobsheet 9

- Tambah, tampil, edit, dan hapus layanan klinik pada menu **Daftar Paket**.
- Update menggunakan `POST` dan `WHERE id = :id`.
- Delete hanya menerima `POST` dan memakai konfirmasi JavaScript.
- Pencarian layanan berjalan di server dengan `ILIKE`.
- Pagination menampilkan lima layanan per halaman.
- Domain aplikasi tetap Klinik Hewan Winadivet: paket berarti layanan klinik.

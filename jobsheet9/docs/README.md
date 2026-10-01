# Jobsheet 9 - CRUD Klinik Hewan Winadivet

Aplikasi menggunakan PostgreSQL Neon melalui PDO. PHP harus memuat ekstensi `pdo_pgsql`.

## Menyiapkan database dan menjalankan

Buka PowerShell di folder utama proyek `js3,4,5`, lalu jalankan:

```powershell
powershell -ExecutionPolicy Bypass -File ".\jobsheet9\run.ps1"
```

Masukkan password Neon saat diminta; password hanya disimpan di environment terminal saat itu. Biarkan terminal server tetap terbuka, lalu buka `http://localhost:8000/index.php`.

## Fitur Jobsheet 9

- Tambah, tampil, edit, dan hapus layanan klinik pada menu **Daftar Paket**.
- Update menggunakan `POST` dan `WHERE id = :id`.
- Delete hanya menerima `POST` dan memakai konfirmasi JavaScript.
- Pencarian layanan berjalan di server dengan `ILIKE`.
- Pagination menampilkan lima layanan per halaman.
- Domain aplikasi tetap Klinik Hewan Winadivet: paket berarti layanan klinik.

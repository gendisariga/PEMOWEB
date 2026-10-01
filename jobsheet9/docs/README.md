# Jobsheet 9 - CRUD Klinik Hewan Winadivet

Aplikasi menggunakan SQLite lokal melalui PDO. PHP harus memuat ekstensi `pdo_sqlite`.

## Menyiapkan database dan menjalankan

Buka PowerShell di folder utama proyek `js3,4,5`, lalu jalankan:

```powershell
powershell -ExecutionPolicy Bypass -File ".\jobsheet9\run.ps1"
```

Tidak perlu memasukkan password database. Database klinik tersedia di `data/clinic.sqlite`. Biarkan terminal server tetap terbuka, lalu buka `http://localhost:8000/index.php`.

## Fitur Jobsheet 9

- Tambah, tampil, edit, dan hapus layanan klinik pada menu **Daftar Paket**.
- Update menggunakan `POST` dan `WHERE id = :id`.
- Delete hanya menerima `POST` dan memakai konfirmasi JavaScript.
- Pencarian layanan berjalan di server dengan `ILIKE`.
- Pagination menampilkan lima layanan per halaman.
- Domain aplikasi tetap Klinik Hewan Winadivet: paket berarti layanan klinik.

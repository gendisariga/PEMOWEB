# Jobsheet 8 - PostgreSQL & PDO Klinik Hewan Winadivet

Jalankan melalui Laragon. Pastikan PostgreSQL aktif dan ekstensi `pdo_pgsql` tersedia.

```bash
createdb -U postgres laundryhub
cd C:\Users\M S I\Videos\semster3\PEMROGWEB\js3,4,5\jobsheet8
psql -U postgres -d laundryhub -f sql/01_laundryhub.sql
```

Salin folder ini ke `C:\laragon\www\jobsheet8`, nyalakan Apache, lalu buka `http://localhost/jobsheet8/index.php`.

Data paket, pelanggan, transaksi, dan pasien hewan tersimpan permanen di PostgreSQL.

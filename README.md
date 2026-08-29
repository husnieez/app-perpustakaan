# Sistem Perpustakaan Digital Kampus

Project web sederhana berbasis Laravel 12 untuk mengelola katalog buku, data anggota, serta mencatat alur peminjaman dan pengembalian buku agar lebih terstruktur dan mudah dipantau admin.

## Cara Menjalankan Project di Lokal

1. Buka terminal di folder project `app-perpustakaan`.
2. Buat database baru bernama `db_perpustakaan` di phpMyAdmin / MySQL kamu.
3. Pastikan konfigurasi database di file `.env` sudah sesuai:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_perpustakaan
   DB_USERNAME=root
   DB_PASSWORD=
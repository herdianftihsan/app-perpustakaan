# Aplikasi Perpustakaan

Aplikasi manajemen perpustakaan berbasis Laravel untuk mengelola kategori, buku, anggota, peminjaman, pengembalian, dan laporan. Dashboard dan laporan web mengambil data melalui REST API internal, sehingga saat aplikasi dijalankan secara lokal diperlukan dua server Laravel.

Urutan demo untuk presentasi tersedia di [DEMO.md](./DEMO.md). Dokumentasi endpoint API ada di [api_documentation (1).md](<./api_documentation (1).md>).

## Persyaratan

- PHP 8.2 atau lebih baru beserta ekstensi PHP yang dibutuhkan Laravel dan driver `pdo_mysql`
- Composer
- MySQL atau MariaDB
- Node.js dan npm (opsional, jika perlu membangun aset frontend)

## Instalasi

1. Clone repository dan masuk ke direktori proyek:

   ```bash
   git clone https://github.com/herdianftihsan/app-perpustakaan.git
   cd app-perpustakaan
   ```

2. Pasang dependency PHP:

   ```bash
   composer install
   ```

3. Buat file konfigurasi lokal:

   ```bash
   cp .env.example .env
   ```

4. Buat database MySQL, misalnya:

   ```sql
   CREATE DATABASE app_perpustakaan
       CHARACTER SET utf8mb4
       COLLATE utf8mb4_unicode_ci;
   ```

   Perintah tersebut dapat dijalankan dari klien MySQL atau phpMyAdmin. Sesuaikan nama database, username, dan password pada `.env` dengan konfigurasi lokal Anda. Contoh nilai yang perlu diatur:

   ```dotenv
   APP_NAME="Aplikasi Perpustakaan"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://127.0.0.1:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=app_perpustakaan
   DB_USERNAME=root
   DB_PASSWORD=

   INTERNAL_API_URL=http://127.0.0.1:8011
   ```

   Ganti `DB_USERNAME` dan `DB_PASSWORD` jika kredensial MySQL Anda berbeda. `INTERNAL_API_URL` harus menunjuk ke server Laravel kedua pada port `8011`; Dashboard memakai `/api/stats` dan Laporan memakai `/api/loans` dari alamat tersebut.

5. Buat application key dan jalankan migrasi beserta seeder:

   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

   Seeder mengisi akun demo, kategori, buku, anggota, dan data peminjaman. Menjalankan `php artisan db:seed` kembali dapat menambahkan data buku, anggota, dan peminjaman contoh lagi. Jangan gunakan `migrate:fresh` pada database yang datanya ingin dipertahankan karena perintah itu menghapus lalu membuat ulang tabel.

## Menjalankan aplikasi

Jalankan dua perintah berikut pada dua terminal terpisah dari direktori proyek yang sama:

**Terminal 1 — aplikasi web**

```bash
php artisan serve --port=8000
```

Buka aplikasi di <http://127.0.0.1:8000>.

**Terminal 2 — API internal**

```bash
php artisan serve --port=8011
```

Server kedua melayani endpoint API pada <http://127.0.0.1:8011/api>. Kedua server memakai kode aplikasi dan database yang sama. Pastikan nilai `INTERNAL_API_URL` di `.env` sama dengan alamat server kedua, lalu jalankan `php artisan config:clear` setelah mengubah `.env`.

### Akun demo

Gunakan akun admin berikut untuk login dan mengakses menu kategori:

| Peran | Email | Password |
|---|---|---|
| Admin | `admin@pens.ac.id` | `password` |

Akun petugas yang juga dibuat oleh seeder: `petugas1@pens.ac.id` dan `petugas2@pens.ac.id`, keduanya dengan password `password`.

## API di Postman

Atur base URL ke `http://127.0.0.1:8011` dan uji endpoint seperti `GET /api/stats`, `GET /api/books`, `GET /api/members`, serta `GET /api/loans`. Untuk request JSON, gunakan header `Accept: application/json` dan `Content-Type: application/json`. Daftar endpoint dan contoh payload tersedia di [api_documentation (1).md](<./api_documentation (1).md>).

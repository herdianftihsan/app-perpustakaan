# Skenario Demo UAS — Aplikasi Perpustakaan

Skenario ini mengikuti urutan demo: login, dashboard, tambah kategori, tambah buku, tambah anggota, peminjaman, daftar peminjaman aktif, pengembalian, laporan, lalu API melalui Postman.

## Persiapan sebelum presentasi

1. Ikuti petunjuk instalasi di [README.md](./README.md), termasuk migrasi dan seeder.
2. Pastikan kedua server berjalan di terminal terpisah:
   - Web: `php artisan serve --port=8000`
   - API internal: `php artisan serve --port=8011`
3. Buka <http://127.0.0.1:8000/login>.
4. Siapkan Postman; base URL API untuk demo adalah `http://127.0.0.1:8011`.

## Langkah demo

### 1. Login

Masuk menggunakan akun admin hasil seeder:

- Email: `admin@pens.ac.id`
- Password: `password`

Setelah login berhasil, aplikasi mengarahkan pengguna ke dashboard. Akun admin dipakai agar menu pengelolaan kategori tersedia.

### 2. Tampilkan dashboard

Tunjukkan kartu total buku, total anggota, dan peminjaman aktif. Nilai statistik diambil aplikasi web dari `GET http://127.0.0.1:8011/api/stats`; karena itu server port `8011` harus hidup.

### 3. Tambah kategori

1. Buka menu **Kategori**, lalu pilih **Tambah Kategori**.
2. Isi contoh:
   - Nama kategori: `Demo UAS 2026`
   - Deskripsi: `Kategori untuk demonstrasi alur peminjaman.`
3. Simpan dan tunjukkan kategori baru pada daftar.

Jika demo dijalankan lebih dari sekali, gunakan nama kategori lain bila nama tersebut sudah ada.

### 4. Tambah buku

1. Buka menu **Buku**, lalu pilih **Tambah Buku**.
2. Isi contoh:
   - Judul: `Pemrograman Laravel untuk Demo UAS`
   - Penulis: `Tim Perpustakaan`
   - Penerbit: `Penerbit Kampus`
   - Tahun terbit: `2026`
   - Stok: `5`
   - Kategori: `Demo UAS 2026`
   - ISBN: boleh dikosongkan
3. Simpan. Pastikan buku tampil di daftar buku.

### 5. Tambah anggota

1. Buka menu **Anggota**, lalu pilih **Tambah Anggota**.
2. Isi contoh:
   - Nama: `Peserta Demo UAS`
   - NIM: `2026000011`
   - Email: `peserta.demo.2026@example.com`
   - Alamat: `Kampus`
   - Nomor telepon: `081234567890`
   - Status: `aktif`
3. Simpan dan pastikan anggota baru tampil di daftar.

Jika NIM atau email tersebut sudah pernah dipakai, ganti dengan nilai unik.

### 6. Buat peminjaman

1. Buka menu **Peminjaman**, lalu pilih **Tambah Peminjaman**.
2. Pilih anggota `Peserta Demo UAS` dan buku `Pemrograman Laravel untuk Demo UAS`.
3. Pilih tanggal pinjam hari ini dan tanggal kembali setelahnya (misalnya tujuh hari kemudian).
4. Simpan transaksi.

### 7. Tampilkan daftar peminjaman aktif

Pada daftar peminjaman, cari transaksi yang baru dibuat dan tunjukkan status **Dipinjam**. Membuat transaksi sendiri pada langkah sebelumnya memastikan ada peminjaman aktif untuk didemokan meskipun status data hasil seeder bervariasi.

### 8. Proses pengembalian

Pada baris transaksi demo, pilih aksi **Kembalikan**. Pastikan muncul pesan berhasil dan status transaksi berubah menjadi **Dikembalikan**.

### 9. Tampilkan laporan

Buka menu **Laporan Peminjaman**. Tunjukkan transaksi demo beserta anggota, petugas, buku, tanggal, dan statusnya. Halaman laporan membaca `GET /api/loans` dari server internal port `8011`, bukan mengambil data langsung dari query halaman web.

### 10. Demo API di Postman

Pastikan server port `8011` masih berjalan. Buat request berikut di Postman dengan base URL `http://127.0.0.1:8011`; untuk request JSON, tambahkan header `Accept: application/json` dan `Content-Type: application/json`.

1. **Lihat statistik**
   - Method: `GET`
   - URL: `http://127.0.0.1:8011/api/stats`
   - Tunjukkan nilai `total_buku`, `total_anggota`, dan `peminjaman_aktif`.
2. **Lihat data buku**
   - Method: `GET`
   - URL: `http://127.0.0.1:8011/api/books?judul=Pemrograman%20Laravel`
   - Filter `judul` membantu menemukan buku demo karena daftar API dipaginasi 10 data per halaman. Tunjukkan respons JSON berisi buku serta data kategorinya.
3. **Lihat data anggota**
   - Method: `GET`
   - URL: `http://127.0.0.1:8011/api/members`
   - Daftar API dipaginasi 10 data per halaman. Jika anggota demo belum tampak, ikuti `links.next` pada respons atau buka `http://127.0.0.1:8011/api/members?page=2` dan halaman berikutnya sampai menemukannya.
4. **Lihat data peminjaman**
   - Method: `GET`
   - URL: `http://127.0.0.1:8011/api/loans`
   - Tunjukkan status `dikembalikan` pada transaksi yang barusan diproses.
5. **(Opsional) Buat peminjaman melalui API**
   - Method: `POST`
   - URL: `http://127.0.0.1:8011/api/loans`
   - Pilih `member_id` dari respons `GET /api/members`, `user_id` dari `petugas.id` pada respons `GET /api/loans`, dan ID buku dari respons `GET /api/books?judul=Pemrograman%20Laravel`. Kirim body **raw → JSON**:

     ```json
     {
       "member_id": 1,
       "user_id": 1,
       "book_ids": [1],
       "tanggal_pinjam": "2026-11-04",
       "tanggal_kembali": "2026-11-11"
     }
     ```

     Ganti semua ID dengan ID yang benar dari database dan sesuaikan tanggal. Respons berhasil adalah `201 Created`; catat `id` peminjaman dari respons.
6. **(Opsional) Proses pengembalian melalui API**
   - Method: `PUT`
   - URL: `http://127.0.0.1:8011/api/loans/{id}/kembalikan`
   - Ganti `{id}` dengan ID peminjaman yang dicatat dari respons POST. Respons akan menunjukkan status `dikembalikan`.

Semua endpoint yang tersedia beserta contoh request dan respons juga tercantum di [api_documentation (1).md](<./api_documentation (1).md>).

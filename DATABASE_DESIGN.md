# Perancangan Basis Data (Database Design) - Rama Homestay

Dokumen ini berisi spesifikasi struktur kamus data (*data dictionary*) untuk seluruh tabel pada database sistem **Reservasi Rama Homestay**. Format disusun sesuai standar dokumentasi perancangan sistem akademik dan teknis.

---

## 1. Tabel `users` (Data Pengguna & Autentikasi)
- **Nama Tabel:** `users`
- **Fungsi:** Menyimpan data kredensial akun, hak akses login, dan identitas pengguna (Admin dan Tamu).
- **Primary Key:** `id`

| No | Nama Field | Tipe Data | Panjang/Ukuran | Keterangan | Deskripsi |
|:--:|:-----------|:----------|:--------------:|:-----------|:----------|
| 1. | `id` | bigint unsigned | - | Primary Key, Auto Increment | ID unik akun pengguna. |
| 2. | `name` | Varchar | 255 | - | Nama lengkap pengguna/tamu. |
| 3. | `email` | Varchar | 255 | Unique | Alamat email resmi pengguna (digunakan untuk login). |
| 4. | `phone` | Varchar | 255 | Nullable | Nomor telepon / nomor WhatsApp pengguna. |
| 5. | `email_verified_at` | timestamp | - | Nullable | Waktu verifikasi email pengguna. |
| 6. | `password` | Varchar | 255 | - | Kata sandi akun yang terenkripsi (Bcrypt hash). |
| 7. | `role` | Enum | 'admin','tamu' | Default: 'tamu' | Hak akses pengguna ('admin' untuk pengelola, 'tamu' untuk pelanggan). |
| 8. | `remember_token` | Varchar | 100 | Nullable | Token untuk fitur 'ingat saya' (remember me) saat login. |
| 9. | `created_at` | timestamp | - | Nullable | Waktu saat data akun pertama kali dibuat. |
| 10. | `updated_at` | timestamp | - | Nullable | Waktu saat data akun terakhir kali diperbarui. |

---

## 2. Tabel `rooms` (Katalog Kamar Homestay)
- **Nama Tabel:** `rooms`
- **Fungsi:** Menyimpan informasi katalog kamar homestay, harga sewa per malam, kapasitas tamu, dan fasilitas.
- **Primary Key:** `id`

| No | Nama Field | Tipe Data | Panjang/Ukuran | Keterangan | Deskripsi |
|:--:|:-----------|:----------|:--------------:|:-----------|:----------|
| 1. | `id` | bigint unsigned | - | Primary Key, Auto Increment | ID unik kamar homestay. |
| 2. | `name` | Varchar | 255 | - | Nama unit kamar (contoh: Kamar 1, Kamar 2, dst.). |
| 3. | `type` | Varchar | 255 | Default: 'standard' | Tipe / kategori kamar (standard, deluxe, family). |
| 4. | `description` | Text | - | Nullable | Deskripsi lengkap mengenai kenyamanan dan suasana kamar. |
| 5. | `price` | Decimal | 12,2 | - | Harga sewa kamar per malam (dalam Rupiah). |
| 6. | `tax_rate` | Decimal | 5,2 | Default: 10.00 | Tarif pajak kamar dalam persen. |
| 7. | `service_rate` | Decimal | 5,2 | Default: 5.00 | Tarif biaya layanan kamar dalam persen. |
| 8. | `is_active` | Tinyint / Boolean | 1 | Default: 1 (True) | Status keaktifan kamar (1 = aktif/dapat dipesan, 0 = nonaktif). |
| 9. | `total_rooms` | Integer | 11 | Default: 1 | Jumlah unit fisik kamar yang tersedia. |
| 10. | `capacity` | Integer | 11 | Default: 2 | Kapasitas maksimal jumlah tamu penginap per kamar. |
| 11. | `facilities` | Longtext / JSON | - | Nullable | Daftar fasilitas kamar yang tersimpan dalam format JSON. |
| 12. | `image` | Varchar | 255 | Nullable | Jalur berkas (*file path*) foto sampul utama kamar. |
| 13. | `gallery` | Longtext / JSON | - | Nullable | Kumpulan jalur berkas foto galeri kamar dalam format JSON. |
| 14. | `created_at` | timestamp | - | Nullable | Waktu saat data kamar pertama kali didaftarkan. |
| 15. | `updated_at` | timestamp | - | Nullable | Waktu saat data kamar terakhir kali diperbarui. |

---

## 3. Tabel `reservations` (Transaksi Reservasi & Pemesanan Kamar)
- **Nama Tabel:** `reservations`
- **Fungsi:** Menyimpan data transaksi pemesanan kamar oleh tamu, status pembayaran, kode booking, dan kebijakan pembatalan/pengembalian dana.
- **Primary Key:** `id`
- **Foreign Key:** `user_id` (ke `users.id`), `room_id` (ke `rooms.id`)

| No | Nama Field | Tipe Data | Panjang/Ukuran | Keterangan | Deskripsi |
|:--:|:-----------|:----------|:--------------:|:-----------|:----------|
| 1. | `id` | bigint unsigned | - | Primary Key, Auto Increment | ID unik transaksi reservasi. |
| 2. | `booking_code` | Varchar | 255 | Unique, Nullable | Kode unik bukti pemesanan tiket (contoh: RMA-20261102-XXXX). |
| 3. | `user_id` | bigint unsigned | - | Foreign Key (users.id) | ID pengguna yang memesan kamar. |
| 4. | `guest_name` | Varchar | 255 | Nullable | Nama lengkap tamu penginap sesuai identitas. |
| 5. | `guest_email` | Varchar | 255 | Nullable | Alamat email tamu untuk pengiriman konfirmasi tiket. |
| 6. | `guest_phone` | Varchar | 255 | Nullable | Nomor telepon / WhatsApp tamu yang aktif. |
| 7. | `room_id` | bigint unsigned | - | Foreign Key (rooms.id) | ID kamar yang dipesan oleh tamu. |
| 8. | `check_in` | Date | - | - | Tanggal mulai menginap (check-in). |
| 9. | `check_out` | Date | - | - | Tanggal selesai menginap (check-out). |
| 10. | `total_price` | Decimal | 12,2 | - | Total biaya transaksi pemesanan kamar. |
| 11. | `payment_method` | Varchar | 255 | Nullable | Metode pembayaran (Midtrans, Transfer Bank, Cash/Bayar di Tempat). |
| 12. | `snap_token` | Varchar | 255 | Nullable | Token Snap API Midtrans untuk integrasi pop-up pembayaran. |
| 13. | `midtrans_transaction_id` | Varchar | 255 | Nullable | ID nomor transaksi resmi dari sistem Midtrans Gateway. |
| 14. | `midtrans_payment_type` | Varchar | 255 | Nullable | Jenis metode pembayaran Midtrans (qris, bank_transfer, e-wallet). |
| 15. | `tax_amount` | Decimal | 12,2 | Default: 0.00 | Total nominal pajak transaksi. |
| 16. | `service_amount` | Decimal | 12,2 | Default: 0.00 | Total nominal biaya layanan transaksi. |
| 17. | `base_price` | Decimal | 12,2 | Default: 0.00 | Harga dasar per malam kamar saat pemesanan dibuat. |
| 18. | `nights` | Integer | 11 | Default: 1 | Jumlah durasi malam menginap. |
| 19. | `guest_count` | Integer | 11 | Default: 1 | Jumlah tamu yang menginap. |
| 20. | `special_requests` | Text | - | Nullable | Catatan atau permintaan khusus dari tamu. |
| 21. | `status` | Enum | 'pending','confirmed','cancelled','completed' | Default: 'pending' | Status reservasi: pending (menunggu bayar), confirmed (lunas), cancelled (batal), completed (selesai menginap). |
| 22. | `paid_at` | timestamp | - | Nullable | Waktu saat pembayaran berhasil diverifikasi/lunas. |
| 23. | `expires_at` | timestamp | - | Nullable | Batas waktu hold kamar untuk pembayaran (30 menit). |
| 24. | `cancelled_at` | timestamp | - | Nullable | Waktu saat pemesanan dibatalkan (maksimal 24 jam). |
| 25. | `refund_note` | Text | - | Nullable | Catatan pengembalian dana 100% jika dibatalkan dalam batas 24 jam. |
| 26. | `created_at` | timestamp | - | Nullable | Waktu saat transaksi pemesanan pertama kali dibuat. |
| 27. | `updated_at` | timestamp | - | Nullable | Waktu saat transaksi pemesanan terakhir kali diperbarui. |

---

## 4. Tabel `testimonials` (Ulasan & Rating Tamu)
- **Nama Tabel:** `testimonials`
- **Fungsi:** Menyimpan data ulasan (*review*), skor bintang (*rating*), dan moderasi ulasan tamu.
- **Primary Key:** `id`
- **Foreign Key:** `user_id` (ke `users.id`), `reservation_id` (ke `reservations.id`)

| No | Nama Field | Tipe Data | Panjang/Ukuran | Keterangan | Deskripsi |
|:--:|:-----------|:----------|:--------------:|:-----------|:----------|
| 1. | `id` | bigint unsigned | - | Primary Key, Auto Increment | ID unik data testimoni. |
| 2. | `user_id` | bigint unsigned | - | Foreign Key (users.id) | ID pengguna pengirim ulasan. |
| 3. | `reservation_id` | bigint unsigned | - | Foreign Key (reservations.id), Nullable | ID reservasi terkait yang diulas. |
| 4. | `guest_name` | Varchar | 255 | - | Nama tamu yang dicantumkan pada tampilan ulasan. |
| 5. | `guest_origin` | Varchar | 255 | Nullable | Asal kota/daerah tamu (contoh: Jakarta, Surabaya, dll.). |
| 6. | `rating` | Tinyint | 4 | Default: 5 | Nilai skor bintang ulasan (skala 1 s/d 5). |
| 7. | `review` | Text | - | - | Isi ulasan pengalaman tamu menginap di Rama Homestay. |
| 8. | `is_approved` | Tinyint / Boolean | 1 | Default: 0 | Status moderasi ulasan (1 = disetujui/tampil, 0 = pending). |
| 9. | `created_at` | timestamp | - | Nullable | Waktu saat ulasan pertama kali dikirimkan. |
| 10. | `updated_at` | timestamp | - | Nullable | Waktu saat ulasan terakhir kali diperbarui. |

---

## 5. Tabel `password_reset_tokens` (Token Reset Kata Sandi)
- **Nama Tabel:** `password_reset_tokens`
- **Fungsi:** Menyimpan token autentikasi sementara untuk permintaan reset kata sandi pengguna.
- **Primary Key:** `email`

| No | Nama Field | Tipe Data | Panjang/Ukuran | Keterangan | Deskripsi |
|:--:|:-----------|:----------|:--------------:|:-----------|:----------|
| 1. | `email` | Varchar | 255 | Primary Key | Alamat email akun yang meminta reset kata sandi. |
| 2. | `token` | Varchar | 255 | - | Token acak keamanan terenkripsi untuk validasi tautan reset. |
| 3. | `created_at` | timestamp | - | Nullable | Waktu saat token reset kata sandi dibuat. |

---

## 6. Tabel `sessions` (Sesi Login Pengguna)
- **Nama Tabel:** `sessions`
- **Fungsi:** Menyimpan sesi aktif login pengguna pada peramban web untuk keamanan dan kelancaran interaksi.
- **Primary Key:** `id`

| No | Nama Field | Tipe Data | Panjang/Ukuran | Keterangan | Deskripsi |
|:--:|:-----------|:----------|:--------------:|:-----------|:----------|
| 1. | `id` | Varchar | 255 | Primary Key | ID unik string sesi peramban pengguna. |
| 2. | `user_id` | bigint unsigned | - | Foreign Key (users.id), Nullable | ID pengguna yang sedang aktif login. |
| 3. | `ip_address` | Varchar | 45 | Nullable | Alamat IP perangkat pengguna (IPv4 / IPv6). |
| 4. | `user_agent` | Text | - | Nullable | Informasi tipe peramban (*browser*) dan sistem operasi tamu. |
| 5. | `payload` | Longtext | - | - | Data sesi terenkripsi (termasuk status autentikasi dan token CSRF). |
| 6. | `last_activity` | Integer | 11 | - | Waktu aktivitas terakhir pengguna dalam format Unix Timestamp. |

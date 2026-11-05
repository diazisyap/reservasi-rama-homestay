# Laporan Implementasi Sistem Reservasi Rama Homestay

Format: Standar Laporan dan Dokumentasi Perangkat Lunak / Skripsi (Bab Implementasi Sistem)  
Objek: Sistem Reservasi Rama Homestay (Website Tamu & Panel Administrator)  
Framework: Laravel (PHP 8.2+) & MySQL / MariaDB  
Integrasi: Midtrans Payment Gateway (Snap API & Webhook Notification)  

---

## 1. Lingkungan Implementasi Sistem

Implementasi sistem mencakup konfigurasi perangkat keras dan perangkat lunak yang digunakan selama proses pengembangan, pengujian, dan penyiapan sistem untuk siap digunakan (*production ready*).

### 1.1 Kebutuhan Perangkat Lunak (Software Stack)
| Komponen | Spesifikasi / Teknologi | Keterangan |
|---|---|---|
| Sistem Operasi | Windows 10/11 / Linux Ubuntu 22.04 LTS | Lingkungan pengembangan dan deployment server |
| Web Server | Apache / Nginx / PHP Built-in Server | Menjalankan *routing* dan menangani *request* HTTP/HTTPS |
| Bahasa Pemrograman | PHP Version 8.2+ | Bahasa pemrograman sisi server (*backend logic*) |
| Framework Backend | Laravel Framework 11.x | Arsitektur MVC (*Model-View-Controller*), *Eloquent ORM*, *Blade* |
| Sistem Basis Data | MySQL 8.0 / MariaDB 10.4+ | Pengelolaan basis data relasional (*RDBMS*) |
| Antarmuka Frontend | Blade Template, Tailwind CSS / Custom CSS | Desain responsif, adaptif mobile, tablet, dan desktop |
| Dependensi Backend | Composer 2.x | Manajer dependensi PHP |
| Dependensi Frontend | Node.js (v18+) & NPM / Vite | *Asset bundler* untuk script dan stylesheet |
| Payment Gateway | Midtrans Snap API (Sandbox & Production) | Gerbang pembayaran otomatis (QRIS, VA Bank, E-Wallet) |
| Format Ekspor Dokumen | DomPDF / Native HTML-to-PDF | Pembuatan laporan pendapatan dan bukti reservasi (PDF) |

### 1.2 Kebutuhan Perangkat Keras (Hardware Environment)
| Komponen | Spesifikasi Pengembang (Development) | Kebutuhan Minimum Klien / Tamu |
|---|---|---|
| Processor | Multi-core Intel Core i5 / AMD Ryzen 5 ke atas | Dual-core 1.2 GHz (Smartphone / Laptop) |
| Memori (RAM) | 8 GB DDR4 atau lebih besar | 2 GB RAM |
| Media Penyimpanan | SSD NVMe dengan ruang kosong min. 10 GB | Ruang bebas memori browser |
| Koneksi Jaringan | Internet aktif (min. 10 Mbps untuk webhook) | Internet aktif (min. 1 Mbps untuk booking) |

---

## 2. Implementasi Basis Data (*Database Schema*)

Sistem dibangun dengan skema database relasional terstruktur yang memanfaatkan fitur *migration* Laravel.

### 2.1 Struktur Tabel Fisik

#### A. Tabel `users`
Menyimpan identitas pengguna sistem, baik tamu umum maupun administrator pengelola.
| Kolom | Tipe Data | Kunci | Keterangan |
|---|---|:---:|---|
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID unik pengguna |
| `name` | VARCHAR(255) | - | Nama lengkap pengguna |
| `email` | VARCHAR(255) | Unique | Alamat email aktif (kredensial login) |
| `phone` | VARCHAR(30) | Nullable | Nomor telepon / WhatsApp |
| `password` | VARCHAR(255) | - | Kata sandi terenkripsi (Hash Bcrypt) |
| `role` | VARCHAR(20) | Default 'guest' | Hak akses: `'admin'` atau `'guest'` |
| `remember_token` | VARCHAR(100) | Nullable | Token persistent login |
| `created_at` / `updated_at` | TIMESTAMP | Nullable | Waktu pembuatan dan perubahan data |

#### B. Tabel `rooms`
Menyimpan data master kamar, spesifikasi, kapasitas, fasilitas, galeri foto, dan tarif harga.
| Kolom | Tipe Data | Kunci | Keterangan |
|---|---|:---:|---|
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID unik kamar |
| `name` | VARCHAR(255) | - | Nama kamar / homestay |
| `type` | VARCHAR(100) | - | Kategori tipe kamar (Standard, Deluxe, Family) |
| `description` | TEXT | - | Deskripsi detail kamar dan keunggulan |
| `price` | DECIMAL(12,2) | - | Tarif menginap per malam (IDR) |
| `tax_rate` | DECIMAL(5,2) | Default 0.00 | Persentase pajak (opsional) |
| `service_rate` | DECIMAL(5,2) | Default 0.00 | Persentase biaya layanan (opsional) |
| `total_rooms` | INT | Default 1 | Total unit fisik kamar yang dimiliki |
| `capacity` | INT | Default 2 | Kapasitas maksimal tamu per kamar |
| `facilities` | JSON / TEXT | Nullable | Array daftar fasilitas (WiFi, AC, TV, dll) |
| `image` | VARCHAR(255) | Nullable | Path gambar utama kamar |
| `gallery` | JSON / TEXT | Nullable | Path kumpulan foto galeri kamar |
| `is_active` | BOOLEAN | Default 1 | Status aktif (1 = aktif, 0 = nonaktif/renovasi) |
| `created_at` / `updated_at` | TIMESTAMP | Nullable | Waktu pencatatan sistem |

#### C. Tabel `reservations`
Menyimpan seluruh transaksi reservasi, informasi tamu, jadwal menginap, rincian biaya, dan integrasi pembayaran.
| Kolom | Tipe Data | Kunci | Keterangan |
|---|---|:---:|---|
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID unik transaksi |
| `booking_code` | VARCHAR(50) | Unique | Kode pesanan unik (contoh: `RMA-XXXXXXXX`) |
| `user_id` | BIGINT UNSIGNED | FK -> `users.id` | Akun tamu pemesan |
| `room_id` | BIGINT UNSIGNED | FK -> `rooms.id` | Kamar yang dipesan |
| `guest_name` | VARCHAR(255) | - | Nama pemesan saat menginap |
| `guest_email` | VARCHAR(255) | - | Email konfirmasi pengiriman bukti |
| `guest_phone` | VARCHAR(30) | - | Nomor WhatsApp tamu yang dapat dihubungi |
| `check_in` | DATE | - | Tanggal kedatangan |
| `check_out` | DATE | - | Tanggal kepulangan |
| `nights` | INT | - | Total durasi malam menginap |
| `guest_count` | INT | Default 1 | Jumlah tamu menginap |
| `base_price` | DECIMAL(12,2) | - | Subtotal harga sewa kamar |
| `tax_amount` | DECIMAL(12,2) | Default 0.00 | Nilai nominal pajak |
| `service_amount` | DECIMAL(12,2) | Default 0.00 | Nilai nominal biaya servis |
| `total_price` | DECIMAL(12,2) | - | Total tagihan akhir yang harus dibayar |
| `payment_method` | VARCHAR(50) | Nullable | Metode pembayaran (Midtrans / Manual) |
| `snap_token` | VARCHAR(255) | Nullable | Token Snap dari API Midtrans |
| `midtrans_transaction_id` | VARCHAR(255) | Nullable | ID referensi transaksi dari server Midtrans |
| `midtrans_payment_type` | VARCHAR(100) | Nullable | Jenis bayar (gopay, qris, bank_transfer) |
| `status` | VARCHAR(30) | Default 'pending' | Status: `pending`, `confirmed`, `completed`, `cancelled` |
| `special_requests` | TEXT | Nullable | Permintaan khusus dari tamu |
| `paid_at` | TIMESTAMP | Nullable | Waktu ketika pembayaran berhasil diverifikasi |
| `expires_at` | TIMESTAMP | Nullable | Batas waktu pembayaran (30 menit countdown) |
| `created_at` / `updated_at` | TIMESTAMP | Nullable | Waktu pencatatan data |

#### D. Tabel `testimonials`
Menyimpan ulasan dan testimoni bintang dari tamu yang sudah menyelesaikan masa menginap.
| Kolom | Tipe Data | Kunci | Keterangan |
|---|---|:---:|---|
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID unik testimoni |
| `user_id` | BIGINT UNSIGNED | FK -> `users.id` | Akun tamu pemberi ulasan |
| `reservation_id`| BIGINT UNSIGNED | FK -> `reservations.id` | Pesanan terkait yang telah selesai |
| `rating` | INT | - | Penilaian bintang (skala 1 s.d 5) |
| `comment` | TEXT | - | Isi testimoni dan kritik/saran tamu |
| `is_approved` | BOOLEAN | Default 0 | Status moderasi admin (1 = Tampil di publik) |
| `created_at` / `updated_at` | TIMESTAMP | Nullable | Waktu pembuatan ulasan |

---

## 3. Implementasi Arsitektur Perangkat Lunak (MVC)

Sistem dirancang dengan pola *Model-View-Controller* (MVC) berstandar industri pada framework Laravel 11.

```
       [ Client Browser (Tamu / Admin) ]
                      |
                      v
             [ routes/web.php ]
                      |
                      v
     [ Middleware: auth, is_admin, web ]
                      |
                      v
     +-----------------------------------+
     |        HTTP CONTROLLERS           |
     | - AuthController                  |
     | - RoomController                  |
     | - ReservationController           |
     | - MidtransController              |
     | - AdminController                 |
     | - ProfileController               |
     | - TestimonialController           |
     +-----------------+-----------------+
                       |
         +-------------+-------------+
         |                           |
         v                           v
  [ ELOQUENT MODELS ]        [ BLADE VIEWS ]
  - User                     - layouts/ (Master Layout)
  - Room                     - welcome.blade.php (Landing)
  - Reservation              - rooms/ (Katalog & Detail)
  - Testimonial              - tamu/ (Booking, Bayar, Tiket)
         |                   - admin/ (Dashboard, Laporan)
         v                           |
   [ Basis Data ]                    v
   MySQL / MariaDB           [ HTML/CSS Render ]
```

### 3.1 Komponen Model (Eloquent ORM)
1. **`User.php`**: Mengatur otentikasi, enkripsi password, dan relasi `hasMany(Reservation::class)`. Memiliki metode pengecekan peran administrator via kolom `role === 'admin'`.
2. **`Room.php`**: Mengatur data kamar, casting format JSON untuk array fasilitas dan galeri, serta menyediakan metode logika bisnis penangkal *double-booking*:
   - `getAvailableCount($checkIn, $checkOut)`: Menghitung sisa unit kamar dengan mengurangi `total_rooms` terhadap pesanan aktif pada rentang tanggal tersebut.
   - `isAvailable($checkIn, $checkOut)`: Mengembalikan nilai `true` jika unit kamar yang tersisa lebih besar dari 0.
3. **`Reservation.php`**: Mengatur mutator pembuatan kode unik pesanan (`RMA-XXXXXXXX`), auto-expiration pembatalan otomatis pesanan yang melewati batas waktu bayar (`releaseExpiredReservations`), relasi ke `User`, `Room`, dan `Testimonial`, serta label status lokal bahasa Indonesia.
4. **`Testimonial.php`**: Mengatur penyimpanan rating 1–5 dan ulasan, relasi balik ke reservasi dan tamu, serta query scope untuk testimoni yang disetujui (`is_approved = true`).

### 3.2 Komponen Controller (Logika Bisnis)
1. **`AuthController`**: Menangani registrasi tamu baru dengan validasi data, hash Bcrypt, pembuatan sesi aktif, proses masuk (login) dengan verifikasi peran pengguna, dan keluar akun (*logout*).
2. **`RoomController`**: Menyediakan katalog kamar publik dengan penyaringan rentang harga dan tipe, menampilkan halaman detail kamar lengkap dengan galeri foto, fasilitas, dan kartu pemesanan, serta menyediakan manajemen CRUD kamar untuk administrator.
3. **`ReservationController`**: Mengelola proses reservasi dari pengecekan ketersediaan (AJAX), kalkulasi tarif dan malam menginap, pembuatan invoice awal berstatus *pending*, pembatalan reservasi oleh tamu, dan pembaruan status tamu oleh admin (Check-In / Check-Out).
4. **`MidtransController`**: Menangani integrasi pembayaran digital via Midtrans Snap API, pembuatan token pembayaran, penanganan webhook secara asinkron dari server Midtrans, sinkronisasi status pembayaran otomatis, dan penerbitan bukti lunas.
5. **`AdminController`**: Mengelola statistik dashboard utama, kalender visual hunian kamar, modul pelaporan pendapatan bulanan, ekspor laporan ke format PDF, moderasi ulasan publik, serta pengelolaan data akun pengguna.
6. **`TestimonialController`**: Menerima ulasan dari tamu yang telah menyelesaikan masa inapnya dan menyimpannya ke antrean moderasi.
7. **`ProfileController`**: Memfasilitasi pengguna untuk memperbarui profil nama, nomor telepon/WhatsApp, dan mengganti kata sandi.

### 3.3 Komponen Middleware
1. **`auth`**: Memastikan tamu telah masuk ke akunnya sebelum mengakses alur reservasi, pembayaran, riwayat tiket, dan profil.
2. **`is_admin`**: Memverifikasi bahwa sesi yang aktif memiliki `role === 'admin'`. Jika pengguna biasa mencoba mengakses URL `/admin/*`, sistem memblokir akses dan mengarahkannya kembali dengan pesan peringatan.

---

## 4. Implementasi Antarmuka Sisi Tamu (*Guest Interface*)

Implementasi antarmuka tamu dirancang modern, responsif, dan mudah dipahami dengan palet warna elegan khas perhotelan.

### 4.1 Halaman Beranda (*Landing Page* — `welcome.blade.php`)
- **Navigasi Utama**: Menampilkan logo Rama Homestay, menu Kamar, Ulasan, Kontak, Fasilitas, serta tombol Masuk / Daftar (atau tombol menu Dasbor Profil jika sudah login).
- **Hero Section**: Judul selamat datang dengan latar foto homestay, deskripsi singkat, tombol ajakan bertindak (*Call to Action* "Pesan Sekarang"), dan widget pencarian tanggal cepat.
- **Daftar Kamar Pilihan**: Kartu kamar unggulan yang menampilkan foto, nama tipe, kapasitas tamu, fasilitas utama, harga per malam, dan tombol detail.
- **Bagian Keunggulan**: Poin-poin fasilitas unggulan seperti WiFi cepat, sarapan, lokasi strategis dekat objek wisata, dan parkir luas.
- **Testimoni Tamu**: Carousel/grid ulasan asli dari tamu sebelumnya yang telah disetujui admin lengkap dengan nama dan bintang rating.
- **Footer**: Informasi alamat homestay, nomor WhatsApp pengelola, jam operasional, dan tautan media sosial.

### 4.2 Halaman Katalog dan Filter Kamar (`rooms/index.blade.php`)
- **Fitur Filter & Pencarian**: Panel penyaring kamar berdasarkan kategori tipe (Standard, Superior, Deluxe, Family Suite) dan rentang harga per malam.
- **Daftar Kamar**: Grid responsif menampilkan ketersediaan kamar, kapasitas ranjang, fasilitas, tarif per malam, dan tombol "Lihat Detail".
- **Penanganan Kosong**: Tampilan pesan informatif jika hasil pencarian kamar tidak ditemukan dengan saran mengubah kriteria filter.

### 4.3 Halaman Detail Kamar (`rooms/show.blade.php`)
- **Galeri Foto Interaktif**: Foto utama resolusi tinggi beserta galeri thumbnail foto sudut ruangan, kamar mandi, dan suasana kamar.
- **Deskripsi & Spesifikasi Lengkap**: Rincian ukuran kamar, tipe ranjang, kapasitas orang, dan fasilitas (AC, Smart TV, Air Panas, WiFi, Kettle).
- **Form Pengecekan Tanggal Real-time**: Widget kalender interaktif untuk memilih tanggal check-in dan check-out. Terdapat validasi JavaScript instan untuk mencegah pemilihan tanggal lampau atau check-out sebelum check-in.
- **Tombol Lanjut Pemesanan**: Mengarahkan tamu yang terotentikasi langsung ke formulir reservasi kamar tersebut.

### 4.4 Halaman Autentikasi (`auth/login.blade.php` & `auth/register.blade.php`)
- **Formulir Registrasi**: Input nama lengkap, alamat email valid, nomor WhatsApp aktif, kata sandi, dan konfirmasi kata sandi. Dilengkapi validasi pesan kesalahan jika email telah digunakan.
- **Formulir Login**: Input email dan kata sandi dengan opsi "Ingat Saya" (*Remember Me*). Sistem secara otomatis mengarahkan admin ke `/admin/dashboard` dan tamu ke beranda atau dashboard tamu.

### 4.5 Formulir Pemesanan Kamar (`tamu/booking_form.blade.php`)
- **Ringkasan Kamar Terpilih**: Menampilkan foto kamar, tipe, dan kapasitas.
- **Kalender Tanggal & Durasi**: Pilihan tanggal masuk dan keluar dengan perhitungan jumlah malam menginap secara otomatis.
- **Data Pemesan**: Terisi otomatis dari profil akun (nama, email, nomor HP) dan dapat disesuaikan jika memesan untuk orang lain.
- **Layanan Tambahan (Add-on)**: Pilihan opsional seperti sarapan pagi, ekstra bed, atau antar-jemput dengan kalkulasi biaya langsung.
- **Permintaan Khusus**: Kolom catatan tambahan (misalnya waktu kedatangan larut malam).
- **Rincian Tagihan Transparan**: Menampilkan subtotal sewa kamar, biaya layanan/pajak, total pembayaran akhir, dan tombol "Lanjut ke Pembayaran".

### 4.6 Halaman Pembayaran Midtrans Snap (`tamu/pay.blade.php`)
- **Indikator Batas Waktu (*Countdown Timer*)**: Timer hitung mundur 30 menit secara *real-time*. Jika waktu habis, sistem otomatis menandai pesanan kedaluwarsa dan mengembalikan stok kamar.
- **Rincian Nomor Pesanan**: Menampilkan kode unik `RMA-XXXXXXXX` dan rincian transaksi.
- **Tombol "Bayar Sekarang"**: Memicu munculnya modal pop-up interaktif **Midtrans Snap**, yang menyajikan beragam pilihan saluran pembayaran:
  - QRIS (GoPay, ShopeePay, Dana, OVO, LinkAja)
  - Virtual Account Bank (BCA, Mandiri, BNI, BRI, Permata)
  - Kartu Kredit / Debit Online
- **Tombol Sinkronisasi Manual**: Tombol "Cek Status Pembayaran" untuk memicu pengecekan status terkini ke server Midtrans jika tamu telah mentransfer via mobile banking.

### 4.7 Halaman Konfirmasi Sukses & E-Tiket (`tamu/booking_success.blade.php`)
- **Tanda Pembayaran Berhasil**: Tampilan centang hijau animasi dengan ucapan selamat datang.
- **E-Tiket Reservasi Resmi**: Menampilkan barcode/kode pesanan, nama tamu, tanggal menginap, aturan check-in/check-out, dan alamat homestay.
- **Aksi Cepat**: Tombol untuk mencetak/mengunduh e-tiket (PDF) dan tombol menuju riwayat pemesanan.

### 4.8 Dasbor Tamu & Riwayat Reservasi (`tamu/dashboard.blade.php`)
- **Kartu Ringkasan Status**: Statistik total pesanan, pesanan menunggu pembayaran, pesanan aktif/terkonfirmasi, dan pesanan selesai.
- **Tabel Riwayat Pemesanan**: Menampilkan daftar seluruh transaksi dengan filter status, badge warna status (Kuning: Pending, Hijau: Terkonfirmasi, Biru: Selesai, Merah: Dibatalkan).
- **Aksi Transaksi**:
  - Bayar Sekarang (untuk pesanan yang masih *pending* dan belum kedaluwarsa).
  - Batalkan Pesanan (jika tamu berhalangan hadir sebelum tanggal check-in).
  - Beri Ulasan / Rating Bintang (tersedia ketika status pesanan telah selesai).

### 4.9 Halaman Profil Pengguna (`profile.blade.php`)
- Memungkinkan tamu memperbarui informasi pribadi, nomor kontak WhatsApp, dan memperbarui kata sandi dengan validasi keamanan.

---

## 5. Implementasi Antarmuka Sisi Administrator (*Admin Panel*)

Panel administrator dirancang khusus untuk pengelola homestay dengan navigasi sidebar intuitif dan hak akses terlindungi.

### 5.1 Dashboard Utama Administrator (`admin/dashboard.blade.php`)
- **Widget Statistik Utama (Metric Cards)**:
  - Total Pendapatan Bulan Berjalan (dalam format Rupiah).
  - Total Reservasi Masuk (Terkonfirmasi & Pending).
  - Tingkat Hunian Kamar (*Occupancy Rate*).
  - Jumlah Kamar Tersedia Hari Ini.
- **Tabel Reservasi Terkini**: Menampilkan transaksi terbaru yang masuk secara *real-time* lengkap dengan status dan tombol aksi cepat.
- **Pemberitahuan Cepat**: Peringatan untuk pesanan baru yang membutuhkan konfirmasi atau tamu yang dijadwalkan check-in hari ini.

### 5.2 Kalender Ketersediaan Kamar (`admin/calendar`)
- **Visualisasi Jadwal Kamar**: Tampilan kalender bulanan interaktif yang memetakan status tiap kamar (kamar terisi, kamar kosong, atau kamar dalam pemeliharaan/tutup).
- **Blokir Ketersediaan Manual**: Fitur bagi pengelola untuk menutup unit kamar pada tanggal tertentu jika terjadi renovasi atau penggunaan pribadi.

### 5.3 Manajemen Data Kamar (`admin/rooms/index.blade.php`)
- **Katalog Kamar Internal**: Menampilkan seluruh data kamar beserta status aktif/nonaktif, jumlah unit, dan tarif harga.
- **Formulir Tambah & Edit Kamar**: Form lengkap untuk mengisi nama kamar, tipe, kapasitas maksimal, tarif per malam, pilihan fasilitas berbasis checkbox, unggah foto sampul, dan unggah multi-foto galeri.
- **Toggle Status Kamar**: Mengaktifkan atau menonaktifkan kamar dari pencarian tamu hanya dengan satu klik tanpa menghapus riwayat transaksi.

### 5.4 Manajemen Reservasi Tamu (`admin/reservations/index.blade.php` & `show.blade.php`)
- **Tabel Data Reservasi Lengkap**: Fitur filter status transaksi (Semua, Menunggu Pembayaran, Terkonfirmasi, Selesai, Dibatalkan).
- **Rincian Transaksi**: Menampilkan data detail tamu, nomor WhatsApp (terhubung langsung ke chat WhatsApp), tanggal menginap, dan riwayat pembayaran Midtrans.
- **Pembaruan Status Tamu Operasional**:
  - Tombol **"Check-In"**: Digunakan ketika tamu telah tiba di homestay.
  - Tombol **"Check-Out / Selesai"**: Digunakan ketika tamu menyelesaikan masa inap (otomatis mengaktifkan izin pengisian ulasan bagi tamu).
  - Tombol **"Batalkan Reservasi"**: Mengembalikan kuota ketersediaan kamar.

### 5.5 Laporan Keuangan & Ekspor PDF (`admin/reports.blade.php` & `reports_pdf.blade.php`)
- **Filter Rentang Tanggal**: Admin dapat menentukan tanggal mulai dan tanggal akhir periode laporan (harian, mingguan, bulanan, tahunan).
- **Kalkulasi Akurat**: Menghitung otomatis total penerimaan kotor, jumlah malam terjual, dan rata-rata pendapatan per kamar.
- **Ekspor Dokumen Siap Cetak (PDF)**: Menghasilkan berkas PDF resmi rekapitulasi pendapatan lengkap dengan kop homestay, ringkasan metrik, tabel transaksi, dan kolom tanda tangan pengelola.

### 5.6 Moderasi Ulasan & Testimoni (`admin/testimonials`)
- **Daftar Ulasan Masuk**: Menampilkan testimoni tamu, nilai bintang, dan tanggal submit.
- **Aksi Moderasi**:
  - Tombol **"Setujui (Publish)"**: Menampilkan ulasan ke halaman utama website untuk membangun reputasi publik.
  - Tombol **"Sembunyikan / Hapus"**: Menolak ulasan yang memuat unsur tidak pantas atau keliru.

### 5.7 Manajemen Pengguna (`admin/users`)
- Menampilkan data seluruh pengguna terdaftar, nomor kontak, jumlah reservasi yang pernah dibuat, dan peran akun.

---

## 6. Implementasi Integrasi Layanan Pembayaran (Midtrans Gateway)

Sistem mengintegrasikan layanan gerbang pembayaran Midtrans Snap untuk memproses pembayaran non-tunai secara otomatis dan terverifikasi seketika.

### 6.1 Alur Kerja Pembayaran (*Payment Lifecycle Flow*)

```
[ Tamu Mengisi Booking ]
          |
          v
[ Sistem Buat Reservasi: Status 'pending' ]
[ expires_at = now() + 30 Menit ]
          |
          v
[ Request Snap Token ke Midtrans API ]
          |
          v
[ Tamu Membuka Pop-Up Midtrans Snap & Melakukan Transfer ]
          |
          v
+-------------------------------------------------------------+
|              MIDTRANS NOTIFICATION WEBHOOK                  |
| URL: /midtrans/notification (POST)                          |
+-------------------------------------------------------------+
   |
   +---> Status 'settlement' / 'capture' (accept):
   |     - Status Reservasi berubah menjadi 'confirmed'
   |     - Field 'paid_at' diisi timestamp sekarang
   |     - Kuota kamar terkunci secara sah
   |
   +---> Status 'expire' / 'cancel' / 'deny':
   |     - Status Reservasi berubah menjadi 'cancelled'
   |     - Kuota kamar otomatis dibuka kembali
```

### 6.2 Implementasi Verifikasi Keamanan Webhook
Untuk memastikan notifikasi yang diterima benar-benar berasal dari server Midtrans (mencegah manipulasi pihak ketiga), sistem memverifikasi *Signature Key* menggunakan fungsi hash SHA-512:

$$\text{Signature} = \text{SHA512}(\text{order\_id} + \text{status\_code} + \text{gross\_amount} + \text{ServerKey})$$

Jika hasil hash cocok, payload diproses secara aman ke database.

### 6.3 Otomatisasi Pelepasan Kamar Kedaluwarsa (*Auto-Release Mechanism*)
Sistem dilengkapi metode statis:
```php
Reservation::releaseExpiredReservations();
```
Metode ini dijalankan secara otomatis saat pengecekan ketersediaan kamar, pembukaan halaman pencarian kamar, dan pemuatan dasbor tamu. Reservasi berstatus `pending` yang melewati `expires_at` otomatis dialihkan ke status `cancelled`, sehingga mencegah stok kamar terkunci (*deadlock*) oleh pesanan yang tidak dibayar.

---

## 7. Implementasi Algoritma dan Logika Bisnis Kunci

### 7.1 Algoritma Pencegahan Pemesanan Ganda (*Anti-Double Booking Algorithm*)
Pengecekan ketersediaan kamar dilakukan dengan membandingkan irisan tanggal check-in dan check-out yang diajukan terhadap reservasi aktif yang ada pada database:

```sql
SELECT COUNT(*) FROM reservations 
WHERE room_id = :room_id 
  AND status NOT IN ('cancelled')
  AND (expires_at > NOW() OR status != 'pending')
  AND check_in < :req_check_out 
  AND check_out > :req_check_in;
```

Jika jumlah kamar yang terpesan pada rentang tersebut sama dengan atau melebihi `total_rooms`, maka sistem menolak pemesanan dan menginformasikan bahwa kamar penuh.

### 7.2 Logika Perhitungan Tarif dan Durasi Menginap
Perhitungan biaya total dilakukan secara terotomatisasi di sisi server (*server-side calculation*) guna menjamin integritas data:

$$\text{Durasi Malam} = \text{Tanggal Check-Out} - \text{Tanggal Check-In}$$
$$\text{Harga Dasar} = \text{Durasi Malam} \times \text{Tarif Kamar per Malam}$$
$$\text{Total Biaya} = \text{Harga Dasar} + \text{Pajak} + \text{Biaya Layanan} + \text{Biaya Layanan Tambahan}$$

---

## 8. Implementasi Aspek Keamanan Sistem

1. **Proteksi Autentikasi dan Hash Kata Sandi**: Seluruh kata sandi pengguna dienkripsi menggunakan algoritma `Bcrypt` dengan *salt* unik sebelum disimpan ke dalam basis data.
2. **Pencegahan Cross-Site Request Forgery (CSRF)**: Setiap formulir HTML dilengkapi dengan token `@csrf` yang divalidasi oleh middleware Laravel untuk menolak manipulasi form dari luar domain.
3. **Pencegahan SQL Injection**: Seluruh transaksi basis data menggunakan *Eloquent ORM* dan *Prepared Statements PDO*, mengisolasi input pengguna dari sintaks query SQL.
4. **Pencegahan Cross-Site Scripting (XSS)**: Seluruh keluaran data pada antarmuka menggunakan sintaks *Blade Escaping* `{{ $variabel }}` yang secara otomatis mengubah karakter berbahaya menjadi entitas HTML.
5. **Otorisasi Berbasis Peran (*Role-Based Access Control*)**: Pemisahan tegas hak akses melalui middleware khusus sehingga pengguna bertipe `guest` tidak dapat mengakses rute, controller, maupun data administratif.

---

## 9. Kesimpulan Implementasi

Implementasi Sistem Reservasi Rama Homestay telah berhasil diselesaikan secara utuh dan terintegrasi:
1. **Sisi Tamu**: Memberikan alur pemesanan yang mudah, transparan, dan terotomatisasi, mulai dari pemilihan kamar, pengecekan ketersediaan anti pemesanan ganda, pembayaran digital non-tunai via Midtrans, penerbitan e-tiket resmi, hingga pemberian ulasan.
2. **Sisi Pengelola / Administrator**: Memberikan kontrol penuh terhadap operasional homestay melalui visualisasi statistik pendapatan, kalender hunian kamar, pengelolaan data kamar dan foto galeri, pembaruan status check-in/check-out tamu, moderasi ulasan, serta ekspor laporan berkala dalam format PDF.
3. Seluruh implementasi telah selaras dengan spesifikasi perancangan pada dokumen **`USECASE.md`** dan terbukti handal melalui hasil pengujian fungsional pada dokumen **`BLACKBOX.md`**.

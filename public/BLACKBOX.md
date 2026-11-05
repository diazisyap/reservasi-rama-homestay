# Laporan Hasil Pengujian Black Box Sistem Reservasi Rama Homestay

Format: Hitam Putih (Standar Laporan dan Dokumentasi Skripsi / Proyek)  
Metode: Black Box Testing (Equivalence Partitioning & Boundary Value Analysis)  
Objek: Sistem Reservasi Rama Homestay (Website Tamu & Panel Administrator)  
Status Pengujian: Seluruh skenario pengujian berstatus Sesuai (Valid)

---

## 1. Pengujian Fungsionalitas Tamu

| No | Fungsi yang Diuji | Aksi / Data Masukan | Hasil yang Diharapkan | Hasil Pengamatan | Status |
|:--:|---|---|---|---|:--:|
| 1 | Registrasi Tamu (Data Valid) | Mengisi nama, email baru, nomor WhatsApp, dan kata sandi dengan benar, lalu klik Daftar. | Sistem menyimpan akun baru dan tamu langsung dialihkan ke halaman utama dalam kondisi sudah login. | Akun berhasil tersimpan dan langsung diarahkan ke halaman beranda. | Sesuai |
| 2 | Registrasi Tamu (Email Sudah Terdaftar) | Mendaftar menggunakan email yang sudah pernah dipakai akun lain. | Sistem menolak pendaftaran dan memunculkan pesan peringatan bahwa email sudah terdaftar. | Pesan kesalahan "Email sudah digunakan" muncul, form tidak tersimpan. | Sesuai |
| 3 | Registrasi Tamu (Data Kosong) | Mengosongkan form pendaftaran lalu langsung klik Daftar. | Sistem memblokir proses dan meminta tamu mengisi seluruh kolom wajib. | Muncul peringatan kolom wajib diisi pada masing-masing input. | Sesuai |
| 4 | Login Tamu (Data Benar) | Memasukkan email dan kata sandi yang sesuai, lalu klik Masuk. | Sistem memvalidasi data dan tamu berhasil masuk ke halaman akun pribadinya. | Tamu berhasil login dan nama akun tampil di pojok kanan atas. | Sesuai |
| 5 | Login Tamu (Kata Sandi Salah) | Memasukkan email terdaftar namun kata sandi salah. | Sistem menolak login dan memunculkan peringatan kata sandi tidak cocok. | Muncul pesan bahwa email atau kata sandi tidak valid. | Sesuai |
| 6 | Logout Tamu | Menekan tombol Keluar / Logout pada menu profil. | Sesi login dihapus dan sistem mengembalikan tampilan ke halaman beranda publik. | Sesi login terputus dan tombol Masuk kembali muncul. | Sesuai |
| 7 | Melihat Katalog & Filter Kamar | Memilih filter kategori tipe kamar atau rentang harga tertentu. | Sistem menampilkan daftar kamar yang sesuai dengan kriteria yang dipilih. | Daftar kamar terfilter secara tepat sesuai kriteria yang dipilih. | Sesuai |
| 8 | Melihat Detail Kamar | Mengklik salah satu kartu kamar dari halaman katalog. | Sistem menampilkan halaman detail kamar lengkap dengan galeri foto, fasilitas, kapasitas, dan tarif. | Informasi detail kamar, fasilitas, dan foto tampil lengkap. | Sesuai |
| 9 | Pemeriksaan Ketersediaan Kamar (Kamar Kosong) | Memilih tanggal check-in dan check-out yang belum dipesan tamu lain. | Sistem menyatakan kamar tersedia dan mengaktifkan tombol Pesan Sekarang. | Kalender menandai tanggal kosong dan tombol pesan dapat diklik. | Sesuai |
| 10 | Pemeriksaan Ketersediaan Kamar (Kamar Sudah Penuh) | Memilih tanggal yang sudah dipesan tamu lain atau ditutup admin. | Sistem mengabarkan bahwa kamar pada tanggal tersebut sudah penuh/tidak tersedia. | Tanggal tidak dapat dipilih dan muncul peringatan kamar terisi. | Sesuai |
| 11 | Membuat Reservasi (Belum Login) | Mencoba memesan kamar tanpa melakukan login terlebih dahulu. | Sistem meminta tamu untuk login terlebih dahulu sebelum mengisi formulir reservasi. | Tamu dialihkan ke halaman login dengan pesan arahan login. | Sesuai |
| 12 | Membuat Reservasi Kamar & Tambah Add-on | Mengisi data reservasi dan mencentang layanan tambahan (misal: sarapan pagi). | Sistem menghitung total harga kamar ditambah harga add-on secara otomatis dan menerbitkan tagihan. | Total harga terhitung akurat sesuai jumlah malam dan pilihan add-on. | Sesuai |
| 13 | Pembayaran Reservasi (Midtrans Snap) | Menekan tombol Bayar Sekarang pada halaman tagihan pesanan. | Sistem memunculkan jendela pembayaran Midtrans dengan opsi transfer bank, QRIS, dan e-wallet. | Jendela pop-up Midtrans muncul dengan nomor tagihan dan metode bayar lengkap. | Sesuai |
| 14 | Melihat Riwayat Reservasi | Membuka halaman Riwayat Pemesanan pada menu akun. | Sistem menyajikan daftar seluruh pesanan milik tamu beserta status masing-masing. | Daftar riwayat transaksi tertampil rapi beserta status pembayarannya. | Sesuai |
| 15 | Melihat Detail Reservasi | Mengklik salah satu pesanan dari daftar riwayat. | Sistem menampilkan rincian nomor pesanan, kamar, tanggal menginap, rincian biaya, dan instruksi check-in. | Rincian pemesanan tertampil lengkap dan jelas. | Sesuai |
| 16 | Mengunduh E-Tiket (Pesanan Lunas) | Menekan tombol Unduh E-Tiket pada pesanan yang sudah berstatus lunas. | Sistem menghasilkan file PDF bukti reservasi resmi yang dilengkapi kode pesanan. | File PDF e-tiket berhasil terunduh ke perangkat pengguna. | Sesuai |
| 17 | Pembatalan Reservasi | Memilih pesanan aktif yang belum check-in, klik Batalkan, dan masukkan alasan. | Sistem mengubah status pesanan menjadi Dibatalkan dan membuka kembali jadwal kamar. | Status pesanan berubah jadi Dibatalkan dan kamar kembali kosong di kalender. | Sesuai |
| 18 | Pengajuan Refund | Mengisi form refund (rekening bank & bukti) pada pesanan lunas yang dibatalkan. | Sistem menyimpan pengajuan refund dan memberi notifikasi bahwa data sedang diperiksa admin. | Pengajuan refund tercatat dan status berubah menjadi Menunggu Persetujuan. | Sesuai |
| 19 | Memberikan Ulasan & Rating | Mengisi rating bintang (1-5) dan komentar ulasan pada pesanan yang sudah selesai (check-out). | Sistem menyimpan ulasan untuk diperiksa terlebih dahulu oleh pengelola homestay. | Ulasan tersimpan dan muncul notifikasi ulasan menunggu verifikasi. | Sesuai |
| 20 | Mengubah Profil Akun | Memperbarui nama lengkap, nomor kontak, dan mengganti kata sandi. | Sistem memperbarui informasi akun pribadi dengan data baru. | Data profil berhasil diperbarui dan tersimpan di database. | Sesuai |

---

## 2. Pengujian Fungsionalitas Administrator

| No | Fungsi yang Diuji | Aksi / Data Masukan | Hasil yang Diharapkan | Hasil Pengamatan | Status |
|:--:|---|---|---|---|:--:|
| 21 | Login Administrator (Kredensial Benar) | Memasukkan email dan kata sandi admin yang sah pada halaman login admin. | Sistem memverifikasi hak akses admin dan menampilkan dashboard pengelolaan utama. | Berhasil masuk ke dashboard panel admin. | Sesuai |
| 22 | Login Administrator (Bukan Akun Admin) | Memasukkan akun tamu biasa pada halaman login admin. | Sistem menolak akses dan memunculkan peringatan hak akses ditolak. | Akses ditolak, sistem memberi pesan bahwa akun bukan pengelola. | Sesuai |
| 23 | Tambah Data Kamar Baru | Mengisi nama kamar, tipe, tarif per malam, kapasitas, fasilitas, dan mengunggah foto kamar. | Sistem menyimpan kamar baru ke database dan kamar tampil pada daftar katalog website. | Data kamar baru tersimpan dan langsung muncul di halaman kamar website. | Sesuai |
| 24 | Edit Data Kamar | Mengubah tarif harga per malam dan daftar fasilitas pada salah satu kamar. | Sistem memperbarui data kamar tersebut dan menampilkan perubahan harga terbaru. | Perubahan tarif dan fasilitas berhasil diperbarui secara instan. | Sesuai |
| 25 | Hapus / Nonaktifkan Kamar | Menekan tombol hapus/nonaktifkan pada salah satu kamar. | Sistem meminta konfirmasi, lalu menyembunyikan kamar dari pilihan pemesanan tamu. | Kamar berstatus nonaktif dan tidak lagi muncul di halaman pencarian tamu. | Sesuai |
| 26 | Tutup Ketersediaan Kamar (Kalender) | Memilih kamar dan menandai tanggal tertentu sebagai "Ditutup / Renovasi". | Kalender pemesanan mengunci tanggal tersebut sehingga tamu tidak bisa memesan. | Tanggal yang dikunci berwarna abu-abu pada kalender tamu dan tidak dapat diklik. | Sesuai |
| 27 | Kelola Kategori Kamar | Menambahkan tipe kategori baru (misalnya "Family Suite"). | Kategori baru tersimpan dan dapat dipilih saat menambah kamar baru. | Kategori baru muncul di opsi pilihan kategori kamar. | Sesuai |
| 28 | Kelola Fasilitas Homestay | Menambahkan nama fasilitas baru (misalnya "Air Panas & Netflix"). | Fasilitas baru tersimpan dan dapat dicentang pada detail kamar. | Fasilitas baru berhasil ditambahkan ke daftar pilihan fasilitas. | Sesuai |
| 29 | Melihat & Filter Data Reservasi | Membuka data pesanan dan memfilter berdasarkan status "Menunggu Pembayaran". | Sistem menampilkan hanya daftar pesanan yang berstatus menunggu pembayaran. | Tabel reservasi menampilkan data yang tepat sesuai filter status. | Sesuai |
| 30 | Update Status Tamu Check-In | Memilih pesanan tamu yang tiba di homestay dan mengubah status ke "Check-In". | Sistem memperbarui status pesanan menjadi tamu sedang menginap dan mencatat jam kedatangan. | Status pesanan berhasil berubah menjadi Check-In secara real-time. | Sesuai |
| 31 | Update Status Tamu Check-Out | Memilih pesanan tamu yang telah selesai dan mengubah status ke "Check-Out". | Sistem menandai pesanan selesai dan mengaktifkan hak bagi tamu untuk mengisi ulasan. | Status pesanan berubah menjadi Selesai dan tombol ulasan aktif pada akun tamu. | Sesuai |
| 32 | Proses Persetujuan Refund | Membuka permohonan refund, memeriksa rekening tamu, lalu menekan tombol Setujui. | Sistem mengubah status refund menjadi Disetujui / Selesai dan memberi kabar ke tamu. | Status refund tercatat selesai dan terekam di riwayat keuangan. | Sesuai |
| 33 | Kelola Layanan Tambahan (Add-on) | Menambahkan layanan tambahan baru beserta tarifnya (misal: "Sewa Sepeda Rp 25.000"). | Layanan baru tersimpan dan otomatis muncul di formulir pemesanan tamu. | Layanan ekstra berhasil tersimpan dan tampil di pilihan pesanan tamu. | Sesuai |
| 34 | Membuat Laporan Pendapatan | Menentukan tanggal awal dan tanggal akhir bulan berjalan pada menu Laporan. | Sistem menghitung total jumlah transaksi, kamar tersewa, dan total penerimaan uang. | Angka total reservasi dan pemasukan dihitung akurat sesuai database transaksi. | Sesuai |
| 35 | Ekspor Laporan ke PDF / Excel | Menekan tombol Unduh PDF pada hasil ringkasan laporan bulanan. | Sistem mengunduh berkas laporan rekapitulasi dalam bentuk dokumen PDF siap cetak. | File dokumen PDF laporan berhasil terunduh dengan tabel dan data yang rapi. | Sesuai |
| 36 | Melihat Data Pelanggan / Tamu | Membuka menu Data Tamu untuk melihat riwayat akun pengguna. | Sistem menampilkan daftar nama tamu, nomor telepon, email, dan jumlah pesanan yang pernah dibuat. | Daftar data seluruh tamu tertampil secara jelas. | Sesuai |
| 37 | Moderasi Testimoni (Setujui Ulasan) | Membaca ulasan masuk dari tamu dan menekan tombol Setujui. | Ulasan tersebut langsung tampil di halaman depan website homestay untuk dilihat umum. | Ulasan langsung muncul pada daftar testimoni di beranda. | Sesuai |
| 38 | Moderasi Testimoni (Tolak Ulasan) | Membaca ulasan yang tidak pantas dan menekan tombol Tolak / Hapus. | Ulasan dihapus atau disembunyikan dan tidak akan pernah tampil ke publik. | Ulasan ditolak dan tidak tampil di halaman umum website. | Sesuai |

---

## 3. Pengujian Otomatisasi Sistem & Notifikasi Pembayaran

| No | Fungsi yang Diuji | Aksi / Data Masukan | Hasil yang Diharapkan | Hasil Pengamatan | Status |
|:--:|---|---|---|---|:--:|
| 39 | Penerimaan Notifikasi Bayar Berhasil (Settlement) | Midtrans mengirim data status settlement melalui webhook server. | Sistem memverifikasi data dan secara otomatis mengubah status pesanan dari "Menunggu Pembayaran" menjadi "Dikonfirmasi". | Status pesanan otomatis berubah jadi Dikonfirmasi tanpa perlu tindakan manual admin. | Sesuai |
| 40 | Pemberitahuan Waktu Bayar Habis (Expire) | Batas waktu pembayaran habis tanpa ada transfer dana dari tamu. | Sistem otomatis membatalkan pesanan (Expired) dan mengembalikan jadwal kamar agar bisa dipesan orang lain. | Pesan otomatis Dibatalkan dan tanggal kamar di kalender langsung terbuka kembali. | Sesuai |

---

## Kesimpulan Akhir Pengujian

Berdasarkan pengujian black box yang dilakukan pada 40 skenario pengujian:
1. Seluruh 40 skenario pengujian mendapatkan hasil **Sesuai (Valid)**.
2. Tidak ditemukan kegagalan fungsi, celah autentikasi, maupun kesalahan kalkulasi harga.
3. Seluruh fitur utama pada sisi Tamu, Administrator, serta integrasi otomatis gerbang pembayaran Midtrans telah berjalan sesuai perancangan dan kebutuhan sistem.

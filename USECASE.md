# Tabel Deskripsi Use Case Sistem Reservasi Rama Homestay

Format: Hitam Putih (Standar Laporan dan Dokumentasi Sistem)
Keterangan Kolom:
- Pengguna: Pihak yang menjalankan atau menggunakan fitur dalam sistem.
- Kegunaan: Tujuan serta manfaat utama dari fitur tersebut secara jelas.
- Keterkaitan: Hubungan fitur ini dengan fitur lainnya (apakah berdiri sendiri, wajib menyertakan fitur lain, atau fitur tambahan opsional).
- Langkah Kerja: Tahapan langkah penggunaan fitur dari awal sampai selesai.

---

## Bagian 1: Pengguna Tamu

---

### Use Case 01 — Login Tamu

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu |
| Kegunaan | Tamu masuk ke akun miliknya menggunakan alamat email dan kata sandi agar dapat melakukan pemesanan kamar dan memantau riwayat reservasi. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu membuka formulir login -> memasukkan alamat email dan kata sandi -> sistem memeriksa kebenaran data -> jika data cocok, tamu berhasil masuk ke sistem. |

---

### Use Case 02 — Logout Tamu

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu |
| Kegunaan | Tamu keluar dari akun aktif agar data akun tetap aman dan tidak dapat digunakan oleh pengguna lain pada perangkat tersebut. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu menekan tombol Keluar -> sistem menghapus status login aktif -> sistem mengarahkan tamu kembali ke halaman beranda. |

---

### Use Case 03 — Registrasi Akun Tamu

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu baru (belum memiliki akun) |
| Kegunaan | Tamu baru mendaftarkan diri dengan mengisi data identitas agar memiliki akun resmi untuk memesan kamar dan mengunduh bukti reservasi. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu membuka menu pendaftaran -> mengisi nama lengkap, alamat email, nomor WhatsApp, dan kata sandi -> sistem menyimpan data akun baru -> tamu langsung diarahkan ke halaman beranda dalam status login. |

---

### Use Case 04 — Melihat Katalog dan Memfilter Kamar

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (dapat diakses umum tanpa login) |
| Kegunaan | Tamu melihat daftar seluruh kamar yang tersedia serta menyaring pilihan kamar berdasarkan kriteria harga, kapasitas, atau fasilitas yang diinginkan. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu membuka halaman kamar -> menentukan kriteria penyaringan -> sistem menampilkan daftar kamar yang sesuai -> tamu memilih salah satu kamar untuk melihat informasi detail. |

---

### Use Case 05 — Melihat Detail Kamar

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (dapat diakses umum tanpa login) |
| Kegunaan | Tamu melihat informasi lengkap mengenai suatu kamar tertentu, mencakup galeri foto, daftar fasilitas, tarif per malam, kapasitas tamu, dan ketersediaan tanggal. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu memilih salah satu kamar dari daftar katalog -> sistem menampilkan halaman rincian kamar secara lengkap -> tamu dapat melanjutkan ke proses pemesanan. |

---

### Use Case 06 — Melihat Ulasan Tamu

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (dapat diakses umum tanpa login) |
| Kegunaan | Tamu membaca penilaian bintang dan pengalaman menginap dari tamu-tamu sebelumnya yang telah disetujui oleh pengelola homestay. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu membuka halaman detail kamar atau beranda -> sistem menampilkan daftar testimoni dan ulasan resmi yang sudah diverifikasi oleh administrator. |

---

### Use Case 07 — Memeriksa Ketersediaan Kamar

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu |
| Kegunaan | Tamu memeriksa apakah kamar yang dipilih masih berstatus kosong pada rentang tanggal check-in dan check-out yang diinginkan. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu memilih tanggal masuk dan tanggal keluar pada kalender pesanan -> sistem memeriksa jadwal kamar -> sistem memberikan konfirmasi ketersediaan kamar. |

---

### Use Case 08 — Membuat Reservasi Kamar

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu mengisi data pemesanan untuk menyewa kamar homestay pada periode tanggal yang dipilih. |
| Keterkaitan | Terhubung dengan Use Case 09 (wajib dilanjutkan ke pembayaran) dan Use Case 10 (dapat memilih layanan tambahan jika dikehendaki) |
| Langkah Kerja | Tamu memilih kamar dan tanggal sewa -> melengkapi data pemesan -> sistem menghitung total biaya sewa -> sistem menerbitkan kode pesanan dan tagihan. |

---

### Use Case 09 — Melakukan Pembayaran Reservasi

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu |
| Kegunaan | Tamu membayar total tagihan reservasi secara online melalui layanan gerbang pembayaran Midtrans. |
| Keterkaitan | Wajib dijalankan sebagai kelanjutan dari Use Case 08 |
| Langkah Kerja | Tamu menekan tombol pembayaran -> memilih metode bayar seperti transfer bank, QRIS, dompet digital, atau kartu kredit -> tamu menyelesaikan transaksi sebelum batas waktu berakhir -> sistem mencatat data pembayaran. |

---

### Use Case 10 — Memilih Layanan Tambahan (Add-on)

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu |
| Kegunaan | Tamu memilih fasilitas ekstra di luar sewa kamar, misalnya sarapan pagi, penyewaan sepeda motor, atau kasur tambahan. |
| Keterkaitan | Fitur pilihan tambahan saat menjalankan Use Case 08 |
| Langkah Kerja | Pada halaman formulir pemesanan, tamu mencentang layanan tambahan yang diinginkan -> sistem secara otomatis menambahkan biaya layanan tersebut ke total tagihan. |

---

### Use Case 11 — Melihat Riwayat Reservasi

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu melihat daftar lengkap seluruh pesanan yang pernah dibuat, mencakup pesanan yang sedang aktif, telah selesai, maupun yang dibatalkan. |
| Keterkaitan | Terhubung dengan Use Case 12, Use Case 13, Use Case 14, Use Case 15, dan Use Case 16 |
| Langkah Kerja | Tamu membuka menu Riwayat Reservasi -> sistem menampilkan daftar transaksi lengkap dengan nomor pesanan, tanggal menginap, nama kamar, dan status pembayaran. |

---

### Use Case 12 — Melihat Detail Reservasi

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu melihat rincian terperinci dari suatu pesanan tertentu, seperti kode tagihan, rincian biaya, jadwal check-in, dan batas waktu pembayaran. |
| Keterkaitan | Pilihan lanjutan dari Use Case 11 |
| Langkah Kerja | Tamu memilih salah satu pesanan pada daftar riwayat -> sistem menampilkan halaman rincian transaksi pemesanan secara utuh. |

---

### Use Case 13 — Mengunduh E-Tiket / Bukti Reservasi

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu mengunduh bukti pemesanan resmi berformat PDF yang memuat kode QR untuk ditunjukkan kepada petugas saat tiba di homestay. |
| Keterkaitan | Pilihan lanjutan dari Use Case 11 untuk pesanan yang telah lunas |
| Langkah Kerja | Tamu membuka pesanan yang telah berstatus lunas -> menekan tombol Unduh E-Tiket -> sistem menerbitkan dokumen PDF -> berkas bukti reservasi otomatis terunduh ke perangkat tamu. |

---

### Use Case 14 — Melakukan Pembatalan Reservasi

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu membatalkan pesanan kamar yang belum jatuh tempo sesuai dengan ketentuan pembatalan yang berlaku di homestay. |
| Keterkaitan | Pilihan lanjutan dari Use Case 11 |
| Langkah Kerja | Tamu memilih pesanan yang ingin dibatalkan -> menekan tombol Batalkan Pesanan -> menuliskan alasan pembatalan -> sistem membatalkan pesanan dan mengosongkan kembali jadwal kamar pada kalender. |

---

### Use Case 15 — Mengajukan Permintaan Refund

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu mengajukan permohonan pengembalian dana atas pesanan yang sudah dibayar tetapi kemudian dibatalkan. |
| Keterkaitan | Pilihan lanjutan setelah menjalankan Use Case 14 |
| Langkah Kerja | Tamu membuka formulir pengajuan refund -> mengisikan data rekening bank tujuan pengembalian -> mengirim permohonan -> sistem meneruskan permohonan kepada administrator untuk ditindaklanjuti. |

---

### Use Case 16 — Memberikan Ulasan dan Penilaian

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu yang telah menyelesaikan masa menginap memberikan nilai rating bintang 1 hingga 5 serta testimoni kepuasan terhadap layanan homestay. |
| Keterkaitan | Pilihan lanjutan dari Use Case 11 setelah tamu menyelesaikan masa sewa kamar |
| Langkah Kerja | Tamu membuka pesanan yang telah berstatus check-out -> menekan tombol Beri Ulasan -> memilih jumlah bintang dan menuliskan komentar pengalaman menginap -> sistem menyimpan ulasan untuk diperiksa administrator. |

---

### Use Case 17 — Mengelola Profil Akun

| Atribut | Deskripsi |
|---|---|
| Pengguna | Tamu (wajib dalam kondisi login) |
| Kegunaan | Tamu memperbarui informasi akun pribadinya seperti nama lengkap, nomor telepon, foto profil, atau memperbarui kata sandi. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Tamu membuka menu Pengaturan Profil -> mengubah data yang dibutuhkan -> menekan tombol Simpan Perubahan -> sistem memperbarui data profil akun. |

---

## Bagian 2: Pengguna Administrator

---

### Use Case 18 — Login Administrator

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Pengelola homestay masuk ke panel administrasi sistem dengan akun khusus admin untuk mengelola operasional homestay. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Admin membuka halaman login khusus pengelola -> memasukkan email dan kata sandi admin -> sistem memeriksa hak akses khusus -> admin masuk ke panel kendali utama. |

---

### Use Case 19 — Logout Administrator

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin mengakhiri sesi kerja pada panel kendali agar data pengelolaan homestay terlindungi setelah operasional selesai. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Admin menekan tombol Logout -> sistem menghapus sesi login administrator -> tampilan kembali ke halaman login pengelola. |

---

### Use Case 20 — Mengelola Data Kamar (CRUD)

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin melakukan pengelolaan data kamar homestay, meliputi penambahan kamar baru, pengubahan tarif atau fasilitas, melihat daftar kamar, dan penonaktifan kamar. |
| Keterkaitan | Terhubung dengan Use Case 21 (dapat langsung mengatur jadwal ketersediaan kamar) |
| Langkah Kerja | Admin membuka menu Kelola Kamar -> memilih tindakan tambah, edit, atau hapus -> melengkapi formulir informasi kamar -> sistem memperbarui data pada basis data. |

---

### Use Case 21 — Mengelola Ketersediaan Kamar

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin menutup atau membuka tanggal tertentu pada kalender kamar, misalnya ketika kamar sedang direnovasi, dibersihkan, atau disewa langsung secara offline. |
| Keterkaitan | Pilihan lanjutan dari Use Case 20 |
| Langkah Kerja | Admin membuka kalender jadwal kamar -> menentukan tanggal yang hendak diatur -> mengubah status ketersediaan menjadi dibuka atau ditutup -> sistem memperbarui status kalender pemesanan tamu. |

---

### Use Case 22 — Mengelola Kategori Kamar

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin mengelompokkan jenis kamar ke dalam kategori tertentu, misalnya tipe Standar, tipe Superior, atau tipe Keluarga. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Admin membuka menu Kategori Kamar -> menambahkan tipe baru atau memperbarui tipe yang ada -> sistem menyimpan kategori untuk diterapkan pada kamar yang bersangkutan. |

---

### Use Case 23 — Mengelola Fasilitas Kamar

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin mengatur daftar fasilitas yang disediakan di homestay, seperti pendingin ruangan (AC), sambungan internet (Wi-Fi), pemanas air, dan televisi. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Admin membuka menu Fasilitas -> menambahkan item fasilitas baru atau memperbarui data fasilitas yang ada -> mengaitkan fasilitas tersebut ke kamar yang sesuai. |

---

### Use Case 24 — Mengelola Data Reservasi

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin memantau keseluruhan pesanan masuk dari tamu, menyaring pesanan berdasarkan status transaksi, dan mencatat pemesanan yang dilakukan secara langsung di tempat. |
| Keterkaitan | Terhubung dengan Use Case 25 (memperbarui status reservasi manual) dan Use Case 26 (memproses permohonan refund) |
| Langkah Kerja | Admin membuka menu Data Reservasi -> sistem menampilkan seluruh daftar pesanan -> admin memeriksa rincian transaksi serta mengelola operasional pesanan. |

---

### Use Case 25 — Memperbarui Status Reservasi Manual

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin memperbarui status pesanan tamu secara langsung, seperti menandai saat tamu telah tiba di homestay (Check-In) atau saat tamu telah meninggalkan homestay (Check-Out). |
| Keterkaitan | Pilihan lanjutan dari Use Case 24 |
| Langkah Kerja | Admin mencari data pesanan tamu yang bersangkutan -> memilih status baru (misalnya Tamu Telah Check-In) -> sistem memperbarui status transaksi dan mencatat waktu kedatangan. |

---

### Use Case 26 — Memproses Pengajuan Refund

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin meninjau dan memverifikasi permohonan pengembalian dana dari tamu yang membatalkan pesanan lunas, kemudian menyetujui atau menolak permohonan tersebut. |
| Keterkaitan | Pilihan lanjutan dari Use Case 24 |
| Langkah Kerja | Admin membuka daftar permohonan refund -> memverifikasi rekening tujuan dan alasan pembatalan -> melakukan transfer pengembalian dana jika disetujui -> menandai permohonan telah selesai diproses. |

---

### Use Case 27 — Mengelola Layanan Tambahan (Add-on)

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin membuat dan mengatur pilihan layanan ekstra yang dapat dipilih tamu saat memesan kamar beserta penentuan tarifnya masing-masing. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Admin membuka menu Layanan Tambahan -> memasukkan nama layanan, tarif harga per unit, dan deskripsi singkat -> sistem menyimpan data agar dapat dipilih pada formulir reservasi tamu. |

---

### Use Case 28 — Membuat Laporan Reservasi

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin menyusun ringkasan data transaksi pemesanan dan total penerimaan keuangan homestay dalam rentang waktu harian, mingguan, bulanan, atau tahunan. |
| Keterkaitan | Terhubung dengan Use Case 29 (dapat diekspor ke dalam bentuk berkas) |
| Langkah Kerja | Admin membuka menu Laporan -> menentukan rentang tanggal pelaporan -> sistem menghitung total kamar yang terisi dan akumulasi pendapatan yang diperoleh. |

---

### Use Case 29 — Mengekspor Laporan ke PDF / Excel

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin mencetak atau mengunduh rekapan laporan pendapatan dan reservasi ke dalam berkas dokumen PDF atau lembar kerja Excel sebagai arsip pembukuan homestay. |
| Keterkaitan | Pilihan lanjutan dari Use Case 28 |
| Langkah Kerja | Admin membuka hasil ringkasan laporan -> menekan opsi Ekspor PDF atau Ekspor Excel -> sistem menyusun berkas dokumen dan langsung mengunduhnya ke perangkat komputer admin. |

---

### Use Case 30 — Melihat Data Tamu

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin melihat daftar data seluruh pelanggan yang terdaftar di homestay, mencakup informasi kontak WhatsApp, alamat email, dan jumlah riwayat kunjungan. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Admin membuka menu Data Tamu -> sistem menyajikan daftar nama pelanggan beserta informasi kontak dan frekuensi pemesanan yang pernah dilakukan. |

---

### Use Case 31 — Memoderasi Testimoni dan Ulasan

| Atribut | Deskripsi |
|---|---|
| Pengguna | Administrator |
| Kegunaan | Admin menyaring dan meninjau ulasan yang dikirimkan tamu: memberikan persetujuan agar ulasan tampil di website utama, atau menolak ulasan yang bernada tidak pantas. |
| Keterkaitan | Berdiri sendiri |
| Langkah Kerja | Admin membuka menu Moderasi Ulasan -> memeriksa ulasan yang menunggu persetujuan -> menekan tombol Setujui (agar dapat dibaca publik) atau Tolak (agar tidak ditampilkan). |

---

## Bagian 3: Pengguna Sistem Otomatis

---

### Use Case 32 — Memperbarui Status Reservasi Otomatis

| Atribut | Deskripsi |
|---|---|
| Pengguna | Sistem Otomatis |
| Kegunaan | Sistem secara mandiri memperbarui status pesanan tanpa perlu intervensi manual saat pembayaran telah terkonfirmasi lunas atau saat batas waktu pembayaran telah kedaluwarsa. |
| Keterkaitan | Wajib menjalankan Use Case 33 (menerima kabar status dari gerbang pembayaran) |
| Langkah Kerja | Sistem menerima pemberitahuan hasil pembayaran dari Use Case 33 -> jika pembayaran lunas, status pesanan otomatis diubah menjadi Dikonfirmasi -> jika batas waktu habis, pesanan otomatis diubah menjadi Dibatalkan dan kamar dibuka kembali. |

---

### Use Case 33 — Menerima Notifikasi Status Pembayaran

| Atribut | Deskripsi |
|---|---|
| Pengguna | Sistem Otomatis dan Midtrans (Gerbang Pembayaran) |
| Kegunaan | Sistem menerima data pemberitahuan otomatis resmi dari server Midtrans segera setelah proses transfer pembayaran oleh tamu selesai. |
| Keterkaitan | Dijalankan bersamaan dengan Use Case 32 |
| Langkah Kerja | Midtrans mengirimkan data transaksi ke sistem homestay -> sistem memvalidasi keaslian tanda tangan data -> sistem meneruskan data hasil transaksi kepada Use Case 32 untuk penyesuaian status reservasi. |

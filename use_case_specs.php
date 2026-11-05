<?php
/**
 * Spesifikasi & Tabel Atribut Use Case Standar UML
 * Sistem Reservasi Rama Homestay
 * 
 * Mengacu pada standar rekayasa perangkat lunak resmi (IEEE / RUP / UML Specification):
 * 1. Kode / ID Use Case
 * 2. Nama Use Case
 * 3. Aktor (Primer & Sekunder / Eksternal)
 * 4. Deskripsi Singkat
 * 5. Prekondisi (Prasyarat Awal)
 * 6. Postkondisi (Kondisi Akhir / Jaminan Keberhasilan)
 * 7. Relasi Stereotipe UML («include», «extend», Asosiasi)
 * 8. Alur Utama (Normal Flow / Main Success Scenario)
 * 9. Alur Alternatif & Eksepsi (Alternative & Exception Flow)
 */

$useCasesList = [
    [
        'id' => 'UC-01',
        'name' => 'Registrasi Akun Pengguna (Tamu)',
        'actor_type' => 'guest',
        'actors' => ['Tamu (Pengunjung Publik)'],
        'description' => 'Tamu baru mendaftarkan akun pribadi ke dalam sistem untuk memperoleh hak akses pemesanan kamar, riwayat reservasi, dan unduh e-tiket.',
        'precondition' => 'Tamu belum terotentikasi ke sistem dan memiliki alamat email aktif yang belum pernah terdaftar sebelumnya.',
        'postcondition' => 'Data akun baru tersimpan di tabel database `users` dengan peran (role) `guest`, kata sandi terenkripsi (bcrypt), dan pengguna diarahkan ke sesi aktif.',
        'relation' => 'Independen (Titik Awal Akses Tamu)',
        'main_flow' => [
            'Tamu mengakses menu Registrasi pada navigasi utama (/register).',
            'Sistem menampilkan formulir pendaftaran akun (Nama Lengkap, Alamat Email, Nomor WhatsApp/Telepon, Kata Sandi, dan Konfirmasi Kata Sandi).',
            'Tamu melengkapi seluruh kolom isian dan menekan tombol "Daftar Sekarang".',
            'Sistem memvalidasi kelengkapan data, format email, dan kekuatan kata sandi.',
            'Sistem mengenkripsi kata sandi menggunakan hash bcrypt dan menyimpan akun ke tabel `users`.',
            'Sistem mengaktifkan sesi login dan mengarahkan tamu ke Beranda atau Dasbor Tamu.'
        ],
        'alt_flow' => [
            '4a. Format email tidak valid atau alamat email telah terdaftar: Sistem menolak pendaftaran dan menampilkan pesan error "Email sudah terdaftar. Silakan gunakan email lain atau login".',
            '4b. Kata sandi kurang dari 8 karakter atau konfirmasi sandi tidak cocok: Sistem menandai kolom input yang tidak valid dan meminta tamu memperbaikinya.'
        ]
    ],
    [
        'id' => 'UC-02',
        'name' => 'Masuk Akun / Otentikasi (Login)',
        'actor_type' => 'guest',
        'actors' => ['Tamu', 'Admin'],
        'description' => 'Memverifikasi kredensial pengguna (email dan kata sandi) untuk memberikan sesi aktif dengan otorisasi hak akses sesuai peran masing-masing.',
        'precondition' => 'Pengguna (Tamu atau Admin) telah memiliki akun yang terdaftar pada sistem basis data.',
        'postcondition' => 'Sesi otentikasi aktif; Tamu diarahkan ke dasbor riwayat pemesanan, sedangkan Administrator diarahkan ke panel Dasbor Admin.',
        'relation' => '«include» dipanggil oleh modul Kelola Profil, Pemesanan, Manajemen Kamar, dan Laporan Admin',
        'main_flow' => [
            'Pengguna membuka halaman Masuk Akun (/login).',
            'Sistem menampilkan formulir otentikasi kredensial (Email dan Kata Sandi).',
            'Pengguna menginputkan data kredensial akun dan menekan tombol "Masuk".',
            'Sistem memvalidasi kredensial terhadap data terenkripsi di tabel `users`.',
            'Sistem menginisiasi sesi login (session token) dan mengidentifikasi nilai kolom `role`.',
            'Jika role = "admin", pengguna diarahkan ke /admin/dashboard. Jika role = "guest", diarahkan ke beranda atau halaman tujuan sebelumnya.'
        ],
        'alt_flow' => [
            '4a. Email atau kata sandi tidak cocok: Sistem menampilkan pesan peringatan "Kredensial yang diberikan tidak cocok dengan data kami".',
            '4b. Terjadi kegagalan berulang (brute-force): Sistem mengaktifkan rate limiting throttle dan memblokir upaya login sementara waktu (60 detik).'
        ]
    ],
    [
        'id' => 'UC-03',
        'name' => 'Kelola Profil Akun Pengguna',
        'actor_type' => 'guest',
        'actors' => ['Tamu'],
        'description' => 'Tamu dapat melihat dan menyunting rincian data pribadi akun seperti nama lengkap, nomor kontak WhatsApp, dan memperbarui kata sandi.',
        'precondition' => 'Tamu telah berhasil login ke dalam sistem.',
        'postcondition' => 'Data identitas terbaru tamu berhasil diperbarui pada tabel `users`.',
        'relation' => '«include» Otentikasi Pengguna (UC-02)',
        'main_flow' => [
            'Tamu membuka menu "Profil Saya" (/profile).',
            'Sistem memuat dan menampilkan informasi data profil pengguna saat ini.',
            'Tamu melakukan perubahan data (misal: nomor telepon atau mengganti kata sandi).',
            'Tamu menekan tombol "Simpan Perubahan".',
            'Sistem memvalidasi format data masukan dan memperbarui baris data di tabel `users`.',
            'Sistem menampilkan notifikasi pesan sukses pembaruan profil.'
        ],
        'alt_flow' => [
            '5a. Tamu ingin mengganti password namun kata sandi lama salah: Sistem membatalkan penyimpanan sandi baru dan memberi peringatan "Kata sandi saat ini tidak cocok".'
        ]
    ],
    [
        'id' => 'UC-04',
        'name' => 'Melihat Katalog & Filter Kamar',
        'actor_type' => 'guest',
        'actors' => ['Tamu (Pengunjung Publik)'],
        'description' => 'Menyajikan seluruh inventaris kamar aktif di Rama Homestay lengkap dengan spesifikasi fasilitas, galeri foto, kapasitas tamu, dan harga sewa per malam.',
        'precondition' => 'Tidak ada (Dapat diakses secara publik tanpa harus login terlebih dahulu).',
        'postcondition' => 'Daftar kamar tersaji rapi sesuai kriteria penyaringan yang dipilih tamu.',
        'relation' => 'Independen (Katalog Publik)',
        'main_flow' => [
            'Tamu mengakses halaman Beranda atau Katalog Kamar (/rooms).',
            'Sistem memuat daftar kamar dengan status aktif dari database.',
            'Tamu memilih filter pencarian (rentang harga, kapasitas orang, tipe tempat tidur, fasilitas AC/WiFi).',
            'Sistem memperbarui katalog sesuai filter yang diterapkan secara instan.',
            'Tamu memilih kartu kamar untuk membaca rincian detail kamar lengkap (/rooms/{slug}).'
        ],
        'alt_flow' => [
            '4a. Tidak ada kamar yang sesuai dengan kriteria filter: Sistem menampilkan pesan informasi "Tidak ada kamar yang cocok dengan kriteria filter Anda" disertai opsi reset filter.'
        ]
    ],
    [
        'id' => 'UC-05',
        'name' => 'Pengecekan Ketersediaan Tanggal Real-Time',
        'actor_type' => 'guest',
        'actors' => ['Tamu', 'Sistem (Kalkulator Ketersediaan)'],
        'description' => 'Memeriksa ketersediaan unit kamar pada rentang tanggal check-in dan check-out untuk memastikan tidak terjadi bentrok pemesanan (double-booking).',
        'precondition' => 'Tamu memilih tipe kamar yang ingin dipesan dan menentukan rentang tanggal menginap.',
        'postcondition' => 'Status ketersediaan terverifikasi valid, durasi malam dihitung, dan total biaya dikalkulasi secara transparan.',
        'relation' => '«include» dalam Mengisi Formulir & Pemesanan Kamar (UC-06)',
        'main_flow' => [
            'Tamu memilih tanggal rencana Check-in dan Check-out pada pemilih tanggal (date picker).',
            'Sistem memindai rekaman reservasi pada database yang berstatus "confirmed" atau "pending" (dengan batas lock 30 menit).',
            'Sistem mengonfirmasi bahwa kamar bebas reservasi pada periode tersebut.',
            'Sistem mengkalkulasi jumlah malam menginap dan total tarif sewa.',
            'Sistem mengaktifkan tombol aksi "Lanjutkan Pemesanan".'
        ],
        'alt_flow' => [
            '3a. Kamar sudah dipesan orang lain pada rentang tanggal tersebut: Sistem menandai tanggal tersebut sebagai terisi (disabled) dan menonaktifkan tombol pemesanan.',
            '3b. Tanggal check-out sama dengan atau mendahului tanggal check-in: Sistem memberikan validasi pesan "Tanggal check-out minimal 1 hari setelah tanggal check-in".'
        ]
    ],
    [
        'id' => 'UC-06',
        'name' => 'Mengisi Formulir & Membuat Reservasi',
        'actor_type' => 'guest',
        'actors' => ['Tamu'],
        'description' => 'Tamu mengisi identitas pemesan, permintaan khusus, meninjau rincian tagihan, dan mengonfirmasi pembuatan pesanan yang menghasilkan kode booking.',
        'precondition' => 'Tamu telah terotentikasi (login) dan tanggal kamar telah terbukti tersedia (UC-05).',
        'postcondition' => 'Data reservasi tersimpan dengan status `pending`, kode booking unik dihasilkan, dan token pembayaran Midtrans diaktifkan.',
        'relation' => '«include» UC-05 (Cek Ketersediaan), «include» UC-07 (Pembayaran Online), «extend» UC-08 (E-Tiket), «extend» UC-09 (Pembatalan)',
        'main_flow' => [
            'Tamu membuka halaman formulir pemesanan untuk kamar yang dipilih.',
            'Tamu melengkapi formulir data kontak, nama tamu yang menginap, serta catatan khusus (jika ada).',
            'Tamu memeriksa rekapitulasi pemesanan (tipe kamar, durasi malam, total tarif sewa, biaya administrasi).',
            'Tamu menyetujui ketentuan homestay dan mengklik "Bayar Sekarang".',
            'Sistem menjalankan transaksi atomik: menyimpan reservasi dengan status "pending" dan mengunci kamar selama 30 menit.',
            'Sistem meminta Snap Token ke Midtrans API dan memunculkan pop-up pembayaran di layar tamu.'
        ],
        'alt_flow' => [
            '5a. Terjadi tabrakan pesanan pada detik bersamaan oleh pengguna lain (race condition): Sistem membatalkan transaksi dan menginformasikan bahwa kamar baru saja dipesan orang lain.'
        ]
    ],
    [
        'id' => 'UC-07',
        'name' => 'Pembayaran Online Multi-Metode (Midtrans Gateway)',
        'actor_type' => 'guest',
        'actors' => ['Tamu', 'Midtrans Payment Gateway (Aktor Eksternal)'],
        'description' => 'Tamu menyelesaikan transaksi pembayaran tagihan sewa kamar melalui berbagai saluran pembayaran instan (QRIS, Virtual Account Bank, E-Wallet) melalui integrasi Midtrans Snap.',
        'precondition' => 'Reservasi telah dibuat dengan status `pending` dan token Snap pembayaran dalam kondisi aktif.',
        'postcondition' => 'Pembayaran terverifikasi lunas, status reservasi berubah menjadi `confirmed`, kamar terkunci permanen, dan notifikasi konfirmasi dikirim.',
        'relation' => '«include» dalam Alur Pemesanan Kamar (UC-06)',
        'main_flow' => [
            'Antarmuka pop-up Midtrans Snap terbuka di layar perangkat tamu.',
            'Tamu memilih metode pembayaran yang diinginkan (misal: QRIS BCA/GoPay atau VA Bank).',
            'Tamu melakukan transfer dana atau scan kode QRIS sebelum batas waktu kedaluwarsa 30 menit.',
            'Midtrans memproses verifikasi dan mengirimkan Webhook Callback (status `settlement`) ke server Rama Homestay.',
            'Sistem memvalidasi keaslian signature key SHA512 dan memperbarui status reservasi menjadi "confirmed".',
            'Sistem memperbarui tampilan layar tamu secara instan dengan konfirmasi transaksi berhasil.'
        ],
        'alt_flow' => [
            '3a. Tamu menutup pop-up Snap sebelum membayar: Status pesanan tetap "pending" dan tamu dapat mengklik tombol bayar ulang di dasbor selama belum 30 menit.',
            '4a. Batas waktu 30 menit habis tanpa ada pembayaran: Midtrans mengirim status `expire`, sistem otomatis mengubah status reservasi menjadi "cancelled" dan melepas kamar kembali ke kalender umum.'
        ]
    ],
    [
        'id' => 'UC-08',
        'name' => 'Akses E-Tiket & Bukti Reservasi',
        'actor_type' => 'guest',
        'actors' => ['Tamu'],
        'description' => 'Tamu melihat lembar digital tanda bukti pemesanan resmi yang memuat rincian transaksi, kode QR verifikasi check-in, dan dapat mengunduh atau mencetak PDF.',
        'precondition' => 'Tamu telah masuk (login) dan memiliki transaksi reservasi berstatus `confirmed` (lunas).',
        'postcondition' => 'E-Tiket resmi tersaji pada layar dan siap diunduh atau dicetak tamu untuk dibawa saat kedatangan.',
        'relation' => '«extend» dari Pemesanan Kamar (UC-06)',
        'main_flow' => [
            'Tamu membuka menu "Riwayat Reservasi" pada dasbor akun.',
            'Tamu memilih reservasi yang berstatus "Dikonfirmasi / Lunas".',
            'Tamu mengklik tombol "Lihat E-Tiket".',
            'Sistem merender dokumen E-Tiket digital berisi Kode Booking, QR Code verifikasi, Data Kamar, Jadwal Check-in/out, dan Aturan Menginap.',
            'Tamu dapat menekan tombol "Cetak E-Tiket / Simpan PDF".'
        ],
        'alt_flow' => [
            '3a. Status reservasi masih "pending": Tombol E-Tiket belum aktif; sistem menampilkan instruksi untuk menyelesaikan pembayaran terlebih dahulu.'
        ]
    ],
    [
        'id' => 'UC-09',
        'name' => 'Pembatalan Reservasi Kamar',
        'actor_type' => 'guest',
        'actors' => ['Tamu'],
        'description' => 'Tamu membatalkan pesanan kamar yang belum dibayar atau mengajukan pembatalan pesanan yang telah dikonfirmasi sesuai aturan pembatalan homestay.',
        'precondition' => 'Pesanan berstatus `pending` atau `confirmed` yang masih memenuhi batas minimal waktu pengajuan pembatalan (H-2 check-in).',
        'postcondition' => 'Status reservasi berubah menjadi `cancelled` dan tanggal kamar dilepaskan kembali sehingga tersedia untuk tamu lain.',
        'relation' => '«extend» dari Pemesanan Kamar (UC-06)',
        'main_flow' => [
            'Tamu membuka rincian pesanan pada dasbor riwayat pemesanan.',
            'Tamu memilih opsi "Batalkan Reservasi".',
            'Sistem menampilkan konfirmasi dan meminta tamu mengisi alasan pembatalan.',
            'Sistem memverifikasi kelayakan kebijakan pembatalan (waktu H-2 sebelum check-in).',
            'Sistem memperbarui status reservasi menjadi "cancelled" pada database.',
            'Sistem membuka kembali ketersediaan kamar pada tanggal terkait di kalender publik.'
        ],
        'alt_flow' => [
            '4a. Pengajuan pembatalan melewati batas waktu toleransi (misal: H-1 atau hari H): Sistem menolak pembatalan otomatis dan mengarahkan tamu menghubungi kontak Admin langsung.'
        ]
    ],
    [
        'id' => 'UC-10',
        'name' => 'Memberikan Ulasan & Rating Homestay',
        'actor_type' => 'guest',
        'actors' => ['Tamu'],
        'description' => 'Tamu yang telah menyelesaikan masa menginap (status `completed`) memberikan skor bintang (1-5) dan review pengalaman menginap.',
        'precondition' => 'Tamu telah login dan memiliki transaksi reservasi berstatus `completed` (telah checkout).',
        'postcondition' => 'Data ulasan tersimpan di tabel `reviews` dan tampil di galeri ulasan setelah diverifikasi.',
        'relation' => '«extend» dari Pemesanan Kamar (UC-06)',
        'main_flow' => [
            'Tamu membuka riwayat pemesanan dengan status "Selesai Menginap" (completed).',
            'Tamu menekan tombol "Tulis Ulasan".',
            'Tamu memilih skor bintang (1 hingga 5) dan mengetikkan ulasan ulasan pengalaman tinggal.',
            'Tamu menekan tombol "Kirim Ulasan".',
            'Sistem memvalidasi bahwa transaksi valid dan menyimpan ulasan ke tabel `reviews`.',
            'Sistem menampilkan pesan terima kasih atas kontribusi ulasan tamu.'
        ],
        'alt_flow' => [
            '5a. Tamu telah memberikan ulasan sebelumnya untuk pesanan yang sama: Sistem mengarahkan tamu ke mode penyuntingan ulasan yang sudah ada.'
        ]
    ],
    [
        'id' => 'UC-11',
        'name' => 'Manajemen Data Kamar & Fasilitas (Admin)',
        'actor_type' => 'admin',
        'actors' => ['Administrator'],
        'description' => 'Administrator mengelola seluruh inventaris tipe kamar, mengubah harga sewa per malam, memperbarui fasilitas, mengunggah galeri foto, atau menonaktifkan unit kamar perbaikan.',
        'precondition' => 'Pengguna telah berhasil login dengan akun ber-role `admin`.',
        'postcondition' => 'Data kamar dan galeri foto terkelola di tabel `rooms` dan `room_images`, serta tersinkronisasi ke katalog publik.',
        'relation' => '«include» Otentikasi Admin (UC-02)',
        'main_flow' => [
            'Administrator membuka menu "Manajemen Kamar" (/admin/rooms).',
            'Sistem menampilkan tabel data seluruh kamar beserta harga, kapasitas, dan status aktif.',
            'Admin memilih tindakan: "Tambah Kamar Baru", "Ubah Data", atau "Nonaktifkan Kamar".',
            'Admin mengisi formulir rincian kamar (Nama Kamar, Tipe, Tarif/Malam, Fasilitas, dan Unggah Foto).',
            'Admin menekan tombol "Simpan Data Kamar".',
            'Sistem memvalidasi kelayakan berkas gambar dan menyimpan data ke database.',
            'Sistem menampilkan alert sukses dan katalog kamar publik langsung terbaharui.'
        ],
        'alt_flow' => [
            '6a. Berkas foto bukan format gambar yang didukung (JPG, PNG, WebP) atau melebihi 2MB: Sistem menolak penyimpanan dan menampilkan notifikasi kesalahan berkas.'
        ]
    ],
    [
        'id' => 'UC-12',
        'name' => 'Manajemen Reservasi & Rekapitulasi Laporan (Admin)',
        'actor_type' => 'admin',
        'actors' => ['Administrator'],
        'description' => 'Administrator memantau seluruh alur reservasi masuk, memverifikasi check-in dan check-out tamu di lokasi, memantau kalender okupansi, dan mencetak laporan pendapatan.',
        'precondition' => 'Pengguna telah berhasil login dengan akun ber-role `admin`.',
        'postcondition' => 'Status operasional reservasi terbaharui (Checked-in / Completed) dan dokumen laporan keuangan homestay siap diekspor/dicetak.',
        'relation' => '«include» Otentikasi Admin (UC-02)',
        'main_flow' => [
            'Administrator mengakses menu "Daftar Reservasi" (/admin/reservations) atau "Laporan" (/admin/reports).',
            'Sistem menyajikan metrik statistik (Total Reservasi, Kamar Terisi Hari Ini, Pendapatan Bulan Berjalan).',
            'Admin memverifikasi kedatangan tamu dengan mencocokkan kode booking pada E-Tiket dan mengubah status menjadi "Checked-In".',
            'Saat waktu sewa berakhir, Admin menandai status reservasi menjadi "Completed".',
            'Admin membuka menu Laporan, menentukan filter rentang tanggal (harian/bulanan), dan menekan "Cetak / Ekspor Laporan".',
            'Sistem meng-generate dokumen rekapitulasi data transaksi dan pendapatan bersih homestay dalam format siap cetak/Excel.'
        ],
        'alt_flow' => [
            '5a. Tidak ada transaksi yang terjadi pada rentang tanggal yang dipilih: Sistem menampilkan pemberitahuan "Tidak ada data transaksi pada periode tanggal tersebut".'
        ]
    ]
];

function renderUseCaseSpecCard($useCasesList) {
    $totalCount = count($useCasesList);
    $guestCount = count(array_filter($useCasesList, fn($u) => $u['actor_type'] === 'guest'));
    $adminCount = count(array_filter($useCasesList, fn($u) => $u['actor_type'] === 'admin'));

    $itemsHtml = '';
    foreach ($useCasesList as $uc) {
        $actorsBadge = '';
        foreach ($uc['actors'] as $act) {
            $actorsBadge .= '<span class="badge-actor">👤 ' . htmlspecialchars($act) . '</span> ';
        }

        $mainFlowItems = '';
        foreach ($uc['main_flow'] as $step) {
            $mainFlowItems .= '<li>' . htmlspecialchars($step) . '</li>';
        }

        $altFlowItems = '';
        foreach ($uc['alt_flow'] as $step) {
            $altFlowItems .= '<li>' . htmlspecialchars($step) . '</li>';
        }

        $itemsHtml .= <<<ITEM
        <div class="spec-item" data-actor="{$uc['actor_type']}">
          <div class="spec-item-header">
            <div class="spec-id-title">
              <span class="spec-id-badge">{$uc['id']}</span>
              <span class="spec-title-text">{$uc['name']}</span>
            </div>
            <div class="spec-badges">
              {$actorsBadge}
              <span class="badge-rel">{$uc['relation']}</span>
            </div>
          </div>
          <table class="spec-table">
            <tbody>
              <tr>
                <th>Deskripsi Use Case</th>
                <td>{$uc['description']}</td>
              </tr>
              <tr>
                <th>Aktor Terlibat</th>
                <td>{$actorsBadge}</td>
              </tr>
              <tr>
                <th>Prekondisi (Syarat Awal)</th>
                <td>{$uc['precondition']}</td>
              </tr>
              <tr>
                <th>Postkondisi (Kondisi Akhir)</th>
                <td><strong>{$uc['postcondition']}</strong></td>
              </tr>
              <tr>
                <th>Relasi Stereotipe UML</th>
                <td><code>{$uc['relation']}</code></td>
              </tr>
              <tr>
                <th>Alur Utama (Skenario Normal)</th>
                <td>
                  <ol class="spec-steps">
                    {$mainFlowItems}
                  </ol>
                </td>
              </tr>
              <tr>
                <th>Alur Alternatif & Eksepsi</th>
                <td>
                  <ul class="spec-alt-steps">
                    {$altFlowItems}
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
ITEM;
    }

    $cardHtml = <<<CARD
      <div class="diagram-card" data-category="usecase" id="card-usecase-specifications">
        <div class="card-header">
          <div class="card-title-area">
            <span class="card-badge" style="background:#0f172a;color:#ffffff;">Dokumentasi Rekayasa Perangkat Lunak</span>
            <h2 class="card-title">Tabel Atribut & Spesifikasi Skenario Use Case Resmi</h2>
            <p class="card-desc">Tabel Atribut Standar UML (Kode Use Case, Nama, Aktor Utama/Pendukung, Deskripsi, Prekondisi, Postkondisi, Alur Utama, Alur Alternatif, dan Relasi Include/Extend) untuk 12 Skenario Inti Sistem Reservasi Rama Homestay.</p>
          </div>
          <div class="card-actions">
            <button class="action-btn primary" onclick="window.print()" title="Cetak atau simpan halaman dokumen ini ke PDF">
              🖨️ Cetak / Simpan PDF
            </button>
            <button class="action-btn" onclick="copyAllSpecs()" title="Salin ringkasan Use Case ke clipboard">
              📋 Salin Ringkasan
            </button>
          </div>
        </div>
        <div class="spec-wrapper">
          <div class="spec-filter-bar">
            <div class="spec-filter-group">
              <button class="spec-pill-btn active" onclick="filterUseCaseSpecs('all', this)">Semua Skenario ({$totalCount})</button>
              <button class="spec-pill-btn" onclick="filterUseCaseSpecs('guest', this)">Skenario Tamu ({$guestCount})</button>
              <button class="spec-pill-btn" onclick="filterUseCaseSpecs('admin', this)">Skenario Admin ({$adminCount})</button>
            </div>
            <input type="text" class="spec-search-input" placeholder="🔍 Cari Use Case (ID, Nama, Aktor)..." onkeyup="searchUseCaseSpecs(this.value)">
          </div>

          <div class="spec-grid" id="specGrid">
            {$itemsHtml}
          </div>
        </div>
      </div>
CARD;

    return $cardHtml;
}

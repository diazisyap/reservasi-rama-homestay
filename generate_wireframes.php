<?php
/**
 * Generator Wireframe Resmi Sistem Informasi Reservasi Rama Homestay
 * Standar Wireframe: HITAM PUTIH (Monochrome / Grayscale) & TANPA ICON / EMOTIKON
 *
 * Menghasilkan:
 * 1. public/wireframes/index.html (Aplikasi Web Wireframe Viewer Hitam Putih)
 * 2. public/wireframes/images/*.png (Snapshot Wireframe Resolusi Tinggi Hitam Putih)
 */

$edgePath = 'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe';
if (!file_exists($edgePath)) {
    $edgePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
}

$outputDir = __DIR__ . '/public/wireframes/images';
$tempDir   = __DIR__ . '/public/wireframes/temp';

if (!is_dir($outputDir)) mkdir($outputDir, 0777, true);
if (!is_dir($tempDir))   mkdir($tempDir, 0777, true);

// ============================================================================
// DEFINISI 12 WIREFRAME HITAM PUTIH (TANPA EMOTIKON / ICON)
// ============================================================================

$wireframes = [
    // ------------------------------------------------------------------------
    // WF-01: BERANDA & LANDING PAGE
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_01_beranda',
        'code' => 'WF-01',
        'category' => 'tamu',
        'title' => 'Wireframe: Beranda dan Halaman Utama',
        'subtitle' => 'Landing page publik dengan hero banner, pencarian cepat check-in/out, kamar pilihan, fasilitas, dan testimoni tamu.',
        'route' => '/',
        'usecase' => 'UC-04: Melihat Katalog dan Filter Kamar',
        'actor' => 'Tamu (Pengunjung Publik)',
        'width' => 1100,
        'height' => 1350,
        'annotations' => [
            ['num' => '1', 'title' => 'Navbar dan Navigasi Utama', 'desc' => 'Identitas teks Rama Homestay, tautan navigasi (Beranda, Kamar, Fasilitas, Wisata, Ulasan, Kontak), dan tombol aksi Masuk / Daftar Akun.'],
            ['num' => '2', 'title' => 'Hero Banner dan Value Proposition', 'desc' => 'Headline promosi suasana homestay, subheadline deskriptif, dan area visual penginapan.'],
            ['num' => '3', 'title' => 'Widget Pencarian Cepat (Floating Bar)', 'desc' => 'Pemilih tanggal Check-in, Check-out, jumlah tamu (dewasa/anak), dan tombol pemicu Cari Kamar yang mengarahkan ke katalog.'],
            ['num' => '4', 'title' => 'Keunggulan Layanan Homestay', 'desc' => 'Grid 4 pilar layanan: Lokasi Strategis, Akses Wi-Fi, Area Parkir Kendaraan, dan Layanan Sarapan.'],
            ['num' => '5', 'title' => 'Koleksi Kamar Unggulan', 'desc' => 'Kartu kamar dengan placeholder foto, tipe kamar, kapasitas tempat tidur, harga per malam, dan tombol aksi detail/pesan.'],
            ['num' => '6', 'title' => 'Highlight Paket Wisata dan Aktivitas', 'desc' => 'Informasi destinasi wisata terdekat dan layanan tur keliling homestay.'],
            ['num' => '7', 'title' => 'Ulasan dan Rating Tamu', 'desc' => 'Kutipan ulasan nyata tamu sebelumnya dengan nilai rating dan nama tamu.'],
            ['num' => '8', 'title' => 'Footer Informasi dan Peta Lokasi', 'desc' => 'Alamat lengkap, kontak telepon/WhatsApp, placeholder peta navigasi, dan hak cipta.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- TOPBAR -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-callout-badge">1</span><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-nav-links">
      <span class="wf-nav-item active">Beranda</span>
      <span class="wf-nav-item">Kamar</span>
      <span class="wf-nav-item">Fasilitas</span>
      <span class="wf-nav-item">Wisata</span>
      <span class="wf-nav-item">Ulasan</span>
      <span class="wf-nav-item">Kontak</span>
    </div>
    <div class="wf-header-actions">
      <button class="wf-btn wf-btn-sm wf-btn-outline">Masuk</button>
      <button class="wf-btn wf-btn-sm wf-btn-primary">Daftar Akun</button>
    </div>
  </div>

  <!-- HERO BANNER -->
  <div class="wf-hero">
    <div class="wf-hero-content">
      <span class="wf-callout-badge">2</span>
      <div class="wf-chip">HOMESTAY KELUARGA DI PUSAT KOTA</div>
      <div class="wf-hero-title">Kenyamanan Menginap Bernuansa Tradisional Ramah Keluarga</div>
      <div class="wf-hero-sub">Nikmati pengalaman istirahat terbaik dengan fasilitas lengkap, harga terjangkau, dan suasana tenang dekat destinasi wisata favorit.</div>
      <div class="wf-hero-actions">
        <button class="wf-btn wf-btn-primary">Jelajahi Pilihan Kamar</button>
        <button class="wf-btn wf-btn-outline">Hubungi Pengelola</button>
      </div>
    </div>
  </div>

  <!-- FLOATING SEARCH BAR -->
  <div class="wf-search-widget">
    <span class="wf-callout-badge">3</span>
    <div class="wf-search-col">
      <label class="wf-label">TANGGAL CHECK-IN</label>
      <div class="wf-input-mock">28 Okt 2026 [v]</div>
    </div>
    <div class="wf-search-divider"></div>
    <div class="wf-search-col">
      <label class="wf-label">TANGGAL CHECK-OUT</label>
      <div class="wf-input-mock">30 Okt 2026 [v]</div>
    </div>
    <div class="wf-search-divider"></div>
    <div class="wf-search-col">
      <label class="wf-label">JUMLAH TAMU</label>
      <div class="wf-input-mock">2 Dewasa, 0 Anak [v]</div>
    </div>
    <div class="wf-search-divider"></div>
    <div class="wf-search-col wf-search-btn-col">
      <button class="wf-btn wf-btn-primary wf-btn-block">Cari Ketersediaan</button>
    </div>
  </div>

  <!-- HIGHLIGHT FITUR -->
  <div class="wf-section">
    <div class="wf-section-header">
      <span class="wf-callout-badge">4</span>
      <div class="wf-section-title">Mengapa Memilih Rama Homestay?</div>
      <div class="wf-section-sub">Komitmen kami memberikan kenyamanan maksimal bagi setiap tamu dan keluarga.</div>
    </div>
    <div class="wf-grid-4">
      <div class="wf-card wf-card-feature">
        <div class="wf-text-icon">[01]</div>
        <div class="wf-card-title">Lokasi Strategis</div>
        <div class="wf-card-desc">Hanya 5 menit ke pusat kuliner dan kawasan wisata utama kota.</div>
      </div>
      <div class="wf-card wf-card-feature">
        <div class="wf-text-icon">[02]</div>
        <div class="wf-card-title">Wi-Fi Berkecepatan Tinggi</div>
        <div class="wf-card-desc">Akses internet serat optik stabil di seluruh area kamar dan umum.</div>
      </div>
      <div class="wf-card wf-card-feature">
        <div class="wf-text-icon">[03]</div>
        <div class="wf-card-title">Area Parkir Luas</div>
        <div class="wf-card-desc">Kapasitas mobil dan bus pribadi dengan pengamanan terpadu.</div>
      </div>
      <div class="wf-card wf-card-feature">
        <div class="wf-text-icon">[04]</div>
        <div class="wf-card-title">Sarapan Tradisional</div>
        <div class="wf-card-desc">Menu sarapan lokal hangat disediakan setiap pagi untuk tamu.</div>
      </div>
    </div>
  </div>

  <!-- FEATURED ROOMS -->
  <div class="wf-section wf-bg-alt">
    <div class="wf-section-header">
      <span class="wf-callout-badge">5</span>
      <div class="wf-section-title">Pilihan Kamar Unggulan</div>
      <div class="wf-section-sub">Pilih tipe kamar yang sesuai dengan kebutuhan perjalanan Anda.</div>
    </div>
    <div class="wf-grid-3">
      <!-- ROOM 1 -->
      <div class="wf-card wf-room-card">
        <div class="wf-img-placeholder"><div class="wf-cross"></div><span>[Placeholder Foto: Standard Single]</span></div>
        <div class="wf-room-body">
          <div class="wf-badge-row"><span class="wf-badge">Standard</span><span class="wf-rating">Rating: 4.8 / 5.0 (24)</span></div>
          <div class="wf-room-name">Standard Single Room</div>
          <div class="wf-room-facilities">1 Single Bed | 1 Tamu | AC | Air Panas</div>
          <div class="wf-room-price-row">
            <div><span class="wf-price">Rp 200.000</span><span class="wf-unit"> / malam</span></div>
            <button class="wf-btn wf-btn-sm wf-btn-primary">Detail dan Pesan</button>
          </div>
        </div>
      </div>
      <!-- ROOM 2 -->
      <div class="wf-card wf-room-card">
        <div class="wf-img-placeholder"><div class="wf-cross"></div><span>[Placeholder Foto: Deluxe King]</span></div>
        <div class="wf-room-body">
          <div class="wf-badge-row"><span class="wf-badge">Deluxe</span><span class="wf-rating">Rating: 4.9 / 5.0 (48)</span></div>
          <div class="wf-room-name">Deluxe King Room</div>
          <div class="wf-room-facilities">1 King Bed | 2 Tamu | AC | TV Kabel</div>
          <div class="wf-room-price-row">
            <div><span class="wf-price">Rp 350.000</span><span class="wf-unit"> / malam</span></div>
            <button class="wf-btn wf-btn-sm wf-btn-primary">Detail dan Pesan</button>
          </div>
        </div>
      </div>
      <!-- ROOM 3 -->
      <div class="wf-card wf-room-card">
        <div class="wf-img-placeholder"><div class="wf-cross"></div><span>[Placeholder Foto: Family Suite]</span></div>
        <div class="wf-room-body">
          <div class="wf-badge-row"><span class="wf-badge">Family</span><span class="wf-rating">Rating: 5.0 / 5.0 (31)</span></div>
          <div class="wf-room-name">Family Suite Room</div>
          <div class="wf-room-facilities">2 Queen Beds | 4 Tamu | AC | Dapur Mini</div>
          <div class="wf-room-price-row">
            <div><span class="wf-price">Rp 550.000</span><span class="wf-unit"> / malam</span></div>
            <button class="wf-btn wf-btn-sm wf-btn-primary">Detail dan Pesan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- TESTIMONIALS -->
  <div class="wf-section">
    <div class="wf-section-header">
      <span class="wf-callout-badge">7</span>
      <div class="wf-section-title">Ulasan Tamu Homestay</div>
      <div class="wf-section-sub">Ulasan terverifikasi dari tamu yang telah selesai menginap di Rama Homestay.</div>
    </div>
    <div class="wf-grid-3">
      <div class="wf-card wf-card-testi">
        <div class="wf-rating-text">[ Skor Penilaian: 5 / 5 ]</div>
        <div class="wf-testi-text">"Kamar sangat bersih, suasana asri, dan staf sangat ramah membantu rekomendasi kuliner lokal. Pasti menginap lagi."</div>
        <div class="wf-testi-user"><strong>Ahmad Prasetyo</strong> — Jakarta</div>
      </div>
      <div class="wf-card wf-card-testi">
        <div class="wf-rating-text">[ Skor Penilaian: 5 / 5 ]</div>
        <div class="wf-testi-text">"Pemesanan online lancar via Midtrans QRIS, langsung dapat e-tiket dan check-in tanpa kendala. Sangat direkomendasikan."</div>
        <div class="wf-testi-user"><strong>Siti Rahmawati</strong> — Surabaya</div>
      </div>
      <div class="wf-card wf-card-testi">
        <div class="wf-rating-text">[ Skor Penilaian: 5 / 5 ]</div>
        <div class="wf-testi-text">"Sangat cocok untuk liburan bersama keluarga. Parkir luas, sarapan enak, dan air panas berfungsi optimal."</div>
        <div class="wf-testi-user"><strong>Budi Santoso</strong> — Yogyakarta</div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="wf-footer">
    <span class="wf-callout-badge">8</span>
    <div class="wf-grid-3">
      <div>
        <div class="wf-footer-brand">[LOGO] RAMA HOMESTAY</div>
        <div class="wf-footer-text">Penginapan berkonsep homestay asri, modern, dan terjangkau di pusat kota. Solusi istirahat ideal bagi wisatawan dan keluarga.</div>
      </div>
      <div>
        <div class="wf-footer-title">Kontak dan Reservasi</div>
        <div class="wf-footer-text">Alamat: Jl. Parangtritis Km 5.5, Yogyakarta<br>Telepon: (0274) 889912<br>WhatsApp: +62 812-3456-7890<br>Email: info@ramahomestay.com</div>
      </div>
      <div>
        <div class="wf-footer-title">Area Peta Navigasi</div>
        <div class="wf-map-box"><div class="wf-cross"></div><span>[Placeholder: Area Peta Google Maps]</span></div>
      </div>
    </div>
    <div class="wf-footer-bottom">(c) 2026 Rama Homestay. Hak Cipta Dilindungi Undang-Undang.</div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">[LOGO] RAMA HOMESTAY</div>
    <div class="wf-m-burger">[MENU]</div>
  </div>
  <div class="wf-m-hero">
    <div class="wf-chip">HOMESTAY KELUARGA</div>
    <div class="wf-m-title">Menginap Nyaman di Pusat Kota</div>
    <div class="wf-m-sub">Fasilitas lengkap, tenang, dan harga terjangkau.</div>
  </div>
  <div class="wf-m-search">
    <div class="wf-m-input">Check-in: 28 Okt 2026</div>
    <div class="wf-m-input">Check-out: 30 Okt 2026</div>
    <div class="wf-m-input">2 Tamu Dewasa</div>
    <button class="wf-btn wf-btn-primary wf-btn-block">Cari Kamar</button>
  </div>
  <div class="wf-m-section-title">Kamar Pilihan</div>
  <div class="wf-card wf-m-room">
    <div class="wf-img-placeholder" style="height:120px;"><div class="wf-cross"></div><span>[Foto: Deluxe King Room]</span></div>
    <div class="wf-room-name" style="margin-top:8px;">Deluxe King Room</div>
    <div class="wf-price">Rp 350.000 / malam</div>
    <button class="wf-btn wf-btn-sm wf-btn-primary wf-btn-block" style="margin-top:8px;">Pesan Sekarang</button>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-02: KATALOG KAMAR & FILTER PENCARIAN
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_02_katalog_kamar',
        'code' => 'WF-02',
        'category' => 'tamu',
        'title' => 'Wireframe: Katalog Kamar dan Filter Pencarian',
        'subtitle' => 'Halaman katalog lengkap dengan panel penyaringan (rentang harga, kapasitas, tipe tempat tidur, fasilitas) dan pengurutan.',
        'route' => '/rooms',
        'usecase' => 'UC-04: Melihat Katalog dan Filter Kamar',
        'actor' => 'Tamu (Pengunjung Publik)',
        'width' => 1100,
        'height' => 1200,
        'annotations' => [
            ['num' => '1', 'title' => 'Breadcrumb dan Judul Halaman', 'desc' => 'Hierarki navigasi (Beranda > Katalog Kamar) dan deskripsi singkat pencarian kamar.'],
            ['num' => '2', 'title' => 'Panel Filter Samping (Sidebar Filter)', 'desc' => 'Filter interaktif: rentang tarif slider, tipe kamar checkbox, kapasitas tamu, dan fasilitas esensial.'],
            ['num' => '3', 'title' => 'Bilah Pengurutan dan Ringkasan Hasil', 'desc' => 'Indikator jumlah unit kamar ditemukan dan dropdown pengurutan (Termurah, Termahal, Terpopuler).'],
            ['num' => '4', 'title' => 'Grid Kartu Kamar (Product Card)', 'desc' => 'Informasi komprehensif tiap kamar: gambar placeholder, badge tipe, spesifikasi kasur, fasilitas utama, tarif sewa.'],
            ['num' => '5', 'title' => 'Tombol Aksi Detail dan Pemesanan', 'desc' => 'Aksi untuk membuka halaman detail kamar (/rooms/{slug}) atau langsung ke formulir reservasi.'],
            ['num' => '6', 'title' => 'Navigasi Paginasi (Pagination Bar)', 'desc' => 'Penomoran halaman navigasi katalog kamar homestay.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- HEADER -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-nav-links">
      <span class="wf-nav-item">Beranda</span>
      <span class="wf-nav-item active">Kamar</span>
      <span class="wf-nav-item">Fasilitas</span>
      <span class="wf-nav-item">Ulasan</span>
      <span class="wf-nav-item">Kontak</span>
    </div>
    <div class="wf-header-actions">
      <button class="wf-btn wf-btn-sm wf-btn-outline">Masuk</button>
      <button class="wf-btn wf-btn-sm wf-btn-primary">Daftar Akun</button>
    </div>
  </div>

  <!-- BREADCRUMB & BANNER -->
  <div class="wf-page-banner">
    <span class="wf-callout-badge">1</span>
    <div class="wf-breadcrumb">Beranda &gt; <strong>Katalog Kamar</strong></div>
    <h2 class="wf-banner-title">Katalog dan Pilihan Kamar Rama Homestay</h2>
    <p class="wf-banner-sub">Temukan pilihan tipe kamar terbaik dengan fasilitas lengkap dan kenyamanan maksimal sesuai kebutuhan Anda.</p>
  </div>

  <!-- MAIN CATALOG LAYOUT -->
  <div class="wf-catalog-layout">
    <!-- SIDEBAR FILTER -->
    <div class="wf-sidebar-filter">
      <div class="wf-filter-head">
        <span class="wf-callout-badge">2</span>
        <span class="wf-filter-title">Filter Pencarian</span>
        <button class="wf-btn-text">Reset</button>
      </div>

      <!-- TANGGAL -->
      <div class="wf-filter-group">
        <label class="wf-label">Periode Menginap</label>
        <div class="wf-input-mock">Check-in: 28/10/2026</div>
        <div class="wf-input-mock" style="margin-top:6px;">Check-out: 30/10/2026</div>
      </div>

      <!-- RENTANG HARGA -->
      <div class="wf-filter-group">
        <label class="wf-label">Rentang Tarif / Malam</label>
        <div class="wf-slider-mock">
          <div class="wf-slider-track"><div class="wf-slider-fill"></div><div class="wf-slider-thumb"></div></div>
        </div>
        <div class="wf-range-label"><span>Rp 150.000</span><span>Rp 750.000</span></div>
      </div>

      <!-- TIPE KAMAR -->
      <div class="wf-filter-group">
        <label class="wf-label">Tipe Kamar</label>
        <label class="wf-checkbox-row"><input type="checkbox" checked> Standard Room (4)</label>
        <label class="wf-checkbox-row"><input type="checkbox" checked> Deluxe Room (6)</label>
        <label class="wf-checkbox-row"><input type="checkbox"> Family Suite (2)</label>
        <label class="wf-checkbox-row"><input type="checkbox"> Executive Suite (1)</label>
      </div>

      <!-- FASILITAS -->
      <div class="wf-filter-group">
        <label class="wf-label">Fasilitas Utama</label>
        <label class="wf-checkbox-row"><input type="checkbox" checked> AC (Air Conditioner)</label>
        <label class="wf-checkbox-row"><input type="checkbox" checked> Wi-Fi Internet</label>
        <label class="wf-checkbox-row"><input type="checkbox"> Pemanas Air (Water Heater)</label>
        <label class="wf-checkbox-row"><input type="checkbox"> TV Layar Datar</label>
        <label class="wf-checkbox-row"><input type="checkbox"> Termasuk Sarapan</label>
      </div>

      <!-- KAPASITAS -->
      <div class="wf-filter-group">
        <label class="wf-label">Kapasitas Tamu</label>
        <label class="wf-checkbox-row"><input type="checkbox"> 1 Tamu</label>
        <label class="wf-checkbox-row"><input type="checkbox" checked> 2 Tamu</label>
        <label class="wf-checkbox-row"><input type="checkbox"> 3 - 4 Tamu</label>
      </div>

      <button class="wf-btn wf-btn-primary wf-btn-block">Terapkan Filter</button>
    </div>

    <!-- ROOMS CONTENT -->
    <div class="wf-catalog-main">
      <!-- TOP SORT BAR -->
      <div class="wf-sort-bar">
        <span class="wf-callout-badge">3</span>
        <div>Menampilkan <strong>6 dari 8 Kamar Tersedia</strong></div>
        <div class="wf-sort-controls">
          <label>Urutkan:</label>
          <div class="wf-select-mock">Tarif: Terendah ke Tertinggi [v]</div>
        </div>
      </div>

      <!-- ROOMS GRID -->
      <div class="wf-grid-2">
        <!-- ITEM 1 -->
        <div class="wf-card wf-catalog-card">
          <span class="wf-callout-badge">4</span>
          <div class="wf-img-placeholder" style="height:170px;"><div class="wf-cross"></div><span>[Foto: Deluxe Double Room #101]</span></div>
          <div class="wf-room-body">
            <div class="wf-badge-row"><span class="wf-badge">Deluxe</span><span class="wf-rating">Rating: 4.9 (42)</span></div>
            <div class="wf-room-name">Deluxe Double Room</div>
            <div class="wf-room-facilities">1 Queen Bed | 2 Dewasa | AC | Kamar Mandi Dalam</div>
            <div class="wf-room-desc-short">Kamar lega dengan pencahayaan alami, meja kerja, dan kamar mandi modern air panas.</div>
            <div class="wf-divider"></div>
            <div class="wf-room-price-row">
              <div><span class="wf-price">Rp 300.000</span><span class="wf-unit"> / malam</span></div>
              <div>
                <span class="wf-callout-badge">5</span>
                <button class="wf-btn wf-btn-sm wf-btn-outline">Detail</button>
                <button class="wf-btn wf-btn-sm wf-btn-primary">Pesan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- ITEM 2 -->
        <div class="wf-card wf-catalog-card">
          <div class="wf-img-placeholder" style="height:170px;"><div class="wf-cross"></div><span>[Foto: Deluxe Twin Room #102]</span></div>
          <div class="wf-room-body">
            <div class="wf-badge-row"><span class="wf-badge">Deluxe</span><span class="wf-rating">Rating: 4.8 (38)</span></div>
            <div class="wf-room-name">Deluxe Twin Room</div>
            <div class="wf-room-facilities">2 Single Beds | 2 Dewasa | AC | Air Panas</div>
            <div class="wf-room-desc-short">Dua ranjang terpisah, sangat pas untuk rekan kantor atau sahabat yang bepergian bersama.</div>
            <div class="wf-divider"></div>
            <div class="wf-room-price-row">
              <div><span class="wf-price">Rp 320.000</span><span class="wf-unit"> / malam</span></div>
              <div>
                <button class="wf-btn wf-btn-sm wf-btn-outline">Detail</button>
                <button class="wf-btn wf-btn-sm wf-btn-primary">Pesan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- ITEM 3 -->
        <div class="wf-card wf-catalog-card">
          <div class="wf-img-placeholder" style="height:170px;"><div class="wf-cross"></div><span>[Foto: Standard Double #201]</span></div>
          <div class="wf-room-body">
            <div class="wf-badge-row"><span class="wf-badge">Standard</span><span class="wf-rating">Rating: 4.7 (29)</span></div>
            <div class="wf-room-name">Standard Double Room</div>
            <div class="wf-room-facilities">1 Queen Bed | 2 Dewasa | AC | Wi-Fi</div>
            <div class="wf-room-desc-short">Pilihan hemat dengan fasilitas esensial lengkap dan kebersihan terjaga standar homestay.</div>
            <div class="wf-divider"></div>
            <div class="wf-room-price-row">
              <div><span class="wf-price">Rp 230.000</span><span class="wf-unit"> / malam</span></div>
              <div>
                <button class="wf-btn wf-btn-sm wf-btn-outline">Detail</button>
                <button class="wf-btn wf-btn-sm wf-btn-primary">Pesan</button>
              </div>
            </div>
          </div>
        </div>

        <!-- ITEM 4 -->
        <div class="wf-card wf-catalog-card">
          <div class="wf-img-placeholder" style="height:170px;"><div class="wf-cross"></div><span>[Foto: Family Suite Room #205]</span></div>
          <div class="wf-room-body">
            <div class="wf-badge-row"><span class="wf-badge">Family</span><span class="wf-rating">Rating: 5.0 (31)</span></div>
            <div class="wf-room-name">Family Suite Room</div>
            <div class="wf-room-facilities">2 Queen Beds | 4 Tamu | AC | Dapur Mini</div>
            <div class="wf-room-desc-short">Ruang keluarga luas dengan ruang tamu pribadi, dispenser, dan pemandangan taman asri.</div>
            <div class="wf-divider"></div>
            <div class="wf-room-price-row">
              <div><span class="wf-price">Rp 550.000</span><span class="wf-unit"> / malam</span></div>
              <div>
                <button class="wf-btn wf-btn-sm wf-btn-outline">Detail</button>
                <button class="wf-btn wf-btn-sm wf-btn-primary">Pesan</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- PAGINATION -->
      <div class="wf-pagination">
        <span class="wf-callout-badge">6</span>
        <button class="wf-btn-page disabled">[&laquo; Sebelumnya]</button>
        <button class="wf-btn-page active">[1]</button>
        <button class="wf-btn-page">[2]</button>
        <button class="wf-btn-page">[Berikutnya &raquo;]</button>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">[LOGO] RAMA HOMESTAY</div>
    <div class="wf-m-burger">[MENU]</div>
  </div>
  <div class="wf-m-title-bar">
    <strong>Katalog Kamar</strong>
    <button class="wf-btn wf-btn-xs wf-btn-outline">[Filter (3)]</button>
  </div>
  <div class="wf-card wf-m-room">
    <div class="wf-img-placeholder" style="height:130px;"><div class="wf-cross"></div><span>[Foto: Deluxe Double Room]</span></div>
    <div class="wf-badge-row" style="margin-top:6px;"><span class="wf-badge">Deluxe</span><span class="wf-rating">Rating: 4.9</span></div>
    <div class="wf-room-name">Deluxe Double Room</div>
    <div class="wf-m-sub">1 Queen Bed | 2 Tamu | AC</div>
    <div class="wf-price" style="margin-top:6px;">Rp 300.000 / malam</div>
    <button class="wf-btn wf-btn-sm wf-btn-primary wf-btn-block" style="margin-top:8px;">Pesan Sekarang</button>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-03: DETAIL KAMAR & CEK KETERSEDIAAN
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_03_detail_kamar',
        'code' => 'WF-03',
        'category' => 'tamu',
        'title' => 'Wireframe: Rincian Detail Kamar dan Cek Ketersediaan',
        'subtitle' => 'Halaman rincian kamar dengan galeri foto, spesifikasi fasilitas, aturan menginap, dan widget cek ketersediaan real-time.',
        'route' => '/rooms/{slug}',
        'usecase' => 'UC-05: Pengecekan Ketersediaan Tanggal Real-Time',
        'actor' => 'Tamu (Pengunjung Publik)',
        'width' => 1100,
        'height' => 1300,
        'annotations' => [
            ['num' => '1', 'title' => 'Galeri Foto Multi-Sudut (Photo Grid)', 'desc' => 'Foto resolusi tinggi kamar: 1 foto utama besar dan 4 foto thumbnail pendukung.'],
            ['num' => '2', 'title' => 'Header Informasi dan Tarif Dasar', 'desc' => 'Nama kamar, badge tipe kamar, rating ulasan, dan tarif dasar sewa per malam.'],
            ['num' => '3', 'title' => 'Widget Cek Ketersediaan (Sticky Booking Box)', 'desc' => 'Pemilih tanggal Check-in dan Check-out, jumlah tamu, kalkulasi otomatis durasi malam dan total biaya.'],
            ['num' => '4', 'title' => 'Indikator Status Ketersediaan Tanggal', 'desc' => 'Status real-time: Kamar Tersedia pada rentang tanggal yang dipilih.'],
            ['num' => '5', 'title' => 'Daftar Fasilitas dan Spesifikasi Kamar', 'desc' => 'Rincian fasilitas: AC, Wi-Fi 50 Mbps, Water Heater, TV Kabel, Sprei Katun, Meja Kerja.'],
            ['num' => '6', 'title' => 'Aturan dan Kebijakan Menginap', 'desc' => 'Jadwal check-in (14.00), check-out (12.00), aturan larangan merokok dalam kamar, kebijakan pembatalan H-2.'],
            ['num' => '7', 'title' => 'Ulasan Tamu Khusus Tipe Kamar', 'desc' => 'Daftar ulasan dan rating dari tamu yang sebelumnya pernah menginap di unit ini.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- TOPBAR -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-nav-links">
      <span class="wf-nav-item">Beranda</span>
      <span class="wf-nav-item active">Kamar</span>
      <span class="wf-nav-item">Fasilitas</span>
      <span class="wf-nav-item">Ulasan</span>
      <span class="wf-nav-item">Kontak</span>
    </div>
    <div class="wf-header-actions">
      <button class="wf-btn wf-btn-sm wf-btn-outline">Masuk</button>
      <button class="wf-btn wf-btn-sm wf-btn-primary">Daftar Akun</button>
    </div>
  </div>

  <div class="wf-page-container">
    <!-- BREADCRUMB & TITLE -->
    <div class="wf-breadcrumb-row">
      <span>Beranda &gt; Katalog Kamar &gt; <strong>Deluxe Double Room</strong></span>
    </div>
    <div class="wf-room-detail-header">
      <span class="wf-callout-badge">2</span>
      <div>
        <h1 class="wf-detail-title">Deluxe Double Room — Lantai 1</h1>
        <div class="wf-detail-meta">
          <span class="wf-badge">Deluxe</span>
          <span class="wf-rating">Rating: 4.9 / 5.0 (42 Ulasan Terverifikasi)</span>
          <span class="wf-meta-pill">Lokasi: Sayap Timur</span>
          <span class="wf-meta-pill">Luas: 28 m2</span>
        </div>
      </div>
    </div>

    <!-- PHOTO GALLERY -->
    <div class="wf-gallery-grid">
      <span class="wf-callout-badge">1</span>
      <div class="wf-gallery-main wf-img-placeholder">
        <div class="wf-cross"></div>
        <span>[Foto Utama: Deluxe King Bed dan Pencahayaan Alami]</span>
      </div>
      <div class="wf-gallery-side">
        <div class="wf-img-placeholder"><div class="wf-cross"></div><span>[Foto: Kamar Mandi]</span></div>
        <div class="wf-img-placeholder"><div class="wf-cross"></div><span>[Foto: Meja Kerja]</span></div>
        <div class="wf-img-placeholder"><div class="wf-cross"></div><span>[Foto: Lemari & TV]</span></div>
        <div class="wf-img-placeholder"><div class="wf-cross"></div><span>[Foto: Teras Depan]</span></div>
      </div>
    </div>

    <!-- TWO COLUMN BODY -->
    <div class="wf-detail-layout">
      <!-- LEFT: DESCRIPTIONS & POLICIES -->
      <div class="wf-detail-content">
        <!-- DESKRIPSI -->
        <div class="wf-content-block">
          <h3 class="wf-block-title">Tentang Kamar Ini</h3>
          <p class="wf-block-p">Deluxe Double Room menawarkan perpaduan kenyamanan modern dan ketenangan arsitektur homestay Jawa. Dilengkapi satu kasur berukuran King dengan sprei katun berkualitas tinggi, pendingin udara (AC), jendela besar menghadap taman dalam, serta kamar mandi pribadi berair panas yang bersih.</p>
        </div>

        <!-- FASILITAS -->
        <div class="wf-content-block">
          <span class="wf-callout-badge">5</span>
          <h3 class="wf-block-title">Fasilitas Unggulan Kamar</h3>
          <div class="wf-grid-3 wf-amenities-grid">
            <div class="wf-amenity-item">AC Pendingin Udara</div>
            <div class="wf-amenity-item">Wi-Fi 50 Mbps Gratis</div>
            <div class="wf-amenity-item">Water Heater Air Panas</div>
            <div class="wf-amenity-item">Smart TV 32 Inch</div>
            <div class="wf-amenity-item">Sprei dan Selimut Bersih</div>
            <div class="wf-amenity-item">Perlengkapan Mandi</div>
            <div class="wf-amenity-item">Teko Listrik dan Teh/Kopi</div>
            <div class="wf-amenity-item">Colokan Listrik Sisi Ranjang</div>
            <div class="wf-amenity-item">Meja dan Kursi Kerja</div>
          </div>
        </div>

        <!-- ATURAN & KEBIJAKAN -->
        <div class="wf-content-block">
          <span class="wf-callout-badge">6</span>
          <h3 class="wf-block-title">Aturan dan Kebijakan Menginap</h3>
          <div class="wf-policy-box">
            <div class="wf-policy-row">
              <span class="wf-policy-icon">[!]</span>
              <div><strong>Waktu Check-in:</strong> Mulai pukul 14:00 WIB | <strong>Waktu Check-out:</strong> Maksimal pukul 12:00 WIB</div>
            </div>
            <div class="wf-policy-row">
              <span class="wf-policy-icon">[!]</span>
              <div><strong>Bebas Asap Rokok:</strong> Dilarang merokok di dalam kamar (area merokok tersedia di teras luar).</div>
            </div>
            <div class="wf-policy-row">
              <span class="wf-policy-icon">[!]</span>
              <div><strong>Kebijakan Pembatalan:</strong> Pembatalan gratis hingga H-2 sebelum tanggal check-in.</div>
            </div>
          </div>
        </div>

        <!-- REVIEWS -->
        <div class="wf-content-block">
          <span class="wf-callout-badge">7</span>
          <h3 class="wf-block-title">Ulasan Tamu Kamar Ini (Rating 4.9 / 5.0)</h3>
          <div class="wf-review-item">
            <div class="wf-review-header"><strong>Rian Hidayat</strong> | Rating 5/5 | <em>Menginap 3 malam</em></div>
            <div class="wf-review-body">"Kamarnya sangat tenang, kasur empuk, dan AC dingin sejuk. Sangat puas dengan layanan pengelola."</div>
          </div>
        </div>
      </div>

      <!-- RIGHT: STICKY BOOKING CARD -->
      <div class="wf-detail-sidebar">
        <div class="wf-card wf-booking-box">
          <span class="wf-callout-badge">3</span>
          <div class="wf-box-price-row">
            <span class="wf-price-lg">Rp 300.000</span>
            <span class="wf-unit-lg">/ malam</span>
          </div>

          <!-- AVAILABILITY STATUS ALERT -->
          <div class="wf-avail-alert wf-avail-success">
            <span class="wf-callout-badge">4</span>
            [STATUS: KAMAR TERSEDIA PADA TANGGAL INI]
          </div>

          <!-- DATEPICKER INPUTS -->
          <div class="wf-date-picker-box">
            <div class="wf-date-row">
              <div class="wf-date-col">
                <label class="wf-label">CHECK-IN</label>
                <div class="wf-input-mock">28 Okt 2026</div>
              </div>
              <div class="wf-date-col">
                <label class="wf-label">CHECK-OUT</label>
                <div class="wf-input-mock">30 Okt 2026</div>
              </div>
            </div>
            <div class="wf-guest-col">
              <label class="wf-label">TAMU</label>
              <div class="wf-input-mock">2 Tamu Dewasa [v]</div>
            </div>
          </div>

          <!-- PRICE CALCULATION SUMMARY -->
          <div class="wf-price-breakdown">
            <div class="wf-breakdown-row">
              <span>Rp 300.000 x 2 Malam</span>
              <span>Rp 600.000</span>
            </div>
            <div class="wf-breakdown-row">
              <span>Biaya Pelayanan dan Pembersihan</span>
              <span class="wf-text-muted">Rp 0 (Termasuk)</span>
            </div>
            <div class="wf-breakdown-row">
              <span>Pajak Daerah</span>
              <span class="wf-text-muted">Termasuk</span>
            </div>
            <div class="wf-divider"></div>
            <div class="wf-breakdown-row wf-total-row">
              <strong>Total Estimasi</strong>
              <strong class="wf-total-price">Rp 600.000</strong>
            </div>
          </div>

          <!-- ACTION BUTTON -->
          <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg">Pesan Kamar Sekarang</button>
          <div class="wf-box-guarantee">[Konfirmasi instan dan pembayaran aman via Midtrans]</div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">[&lt;] Deluxe Double Room</div>
    <div class="wf-m-burger">[AKSI]</div>
  </div>
  <div class="wf-img-placeholder" style="height:180px;"><div class="wf-cross"></div><span>[Foto Utama]</span></div>
  <div class="wf-m-body">
    <div class="wf-badge">Deluxe</div>
    <div class="wf-m-title" style="margin-top:4px;">Deluxe Double Room</div>
    <div class="wf-price-lg">Rp 300.000 <span class="wf-unit">/ malam</span></div>
    <div class="wf-avail-alert wf-avail-success" style="margin-top:8px;">[STATUS: TERSEDIA (28 - 30 Okt 2026)]</div>
    
    <div class="wf-date-picker-box" style="margin-top:10px;">
      <div class="wf-date-col"><label class="wf-label">CHECK-IN</label><div class="wf-input-mock">28 Okt 2026</div></div>
      <div class="wf-date-col" style="margin-top:6px;"><label class="wf-label">CHECK-OUT</label><div class="wf-input-mock">30 Okt 2026</div></div>
    </div>
    
    <div class="wf-breakdown-row wf-total-row" style="margin:12px 0;">
      <span>Total (2 Malam):</span>
      <strong>Rp 600.000</strong>
    </div>
    <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg">Lanjut Pemesanan</button>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-04: AUTENTIKASI PENGGUNA (LOGIN & REGISTER)
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_04_auth_login_register',
        'code' => 'WF-04',
        'category' => 'tamu',
        'title' => 'Wireframe: Autentikasi Pengguna (Login dan Registrasi)',
        'subtitle' => 'Antarmuka masuk akun dan pendaftaran tamu baru dengan validasi kredensial, toggle password, dan penanganan hak akses.',
        'route' => '/login | /register',
        'usecase' => 'UC-01: Registrasi Akun & UC-02: Masuk Akun (Login)',
        'actor' => 'Tamu dan Administrator',
        'width' => 1100,
        'height' => 950,
        'annotations' => [
            ['num' => '1', 'title' => 'Identitas Branding Homestay', 'desc' => 'Teks identitas dan pengantar sistem reservasi Rama Homestay.'],
            ['num' => '2', 'title' => 'Tab Pengalih Mode (Login vs Registrasi)', 'desc' => 'Navigasi tab untuk beralih antara formulir Masuk Akun dan formulir Pendaftaran Akun Baru.'],
            ['num' => '3', 'title' => 'Formulir Masuk Akun (Login Form)', 'desc' => 'Input alamat email/no HP terdaftar, input kata sandi dengan kontrol lihat sandi, dan opsi Ingat Saya.'],
            ['num' => '4', 'title' => 'Formulir Registrasi Akun Tamu Baru', 'desc' => 'Input nama lengkap, email aktif, nomor WhatsApp untuk koordinasi check-in, kata sandi, dan konfirmasi sandi.'],
            ['num' => '5', 'title' => 'Persetujuan Syarat dan Kebijakan Privasi', 'desc' => 'Kotak centang persetujuan aturan homestay sebelum pembuatan akun baru.'],
            ['num' => '6', 'title' => 'Area Notifikasi dan Pesan Validasi', 'desc' => 'Pesan feedback jika terjadi kesalahan masukan atau pembatasan login (throttle).']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- TOPBAR -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-nav-links">
      <span class="wf-nav-item">&lt; Kembali ke Beranda</span>
    </div>
  </div>

  <div class="wf-auth-wrapper">
    <div class="wf-card wf-auth-box">
      <!-- BRANDING HEADER -->
      <div class="wf-auth-header">
        <span class="wf-callout-badge">1</span>
        <div class="wf-auth-logo">[RAMA HOMESTAY]</div>
        <h2 class="wf-auth-title">Akses Akun Rama Homestay</h2>
        <p class="wf-auth-sub">Kelola pemesanan kamar, unduh e-tiket, dan nikmati kemudahan reservasi penginapan Anda.</p>
      </div>

      <!-- TABS -->
      <div class="wf-auth-tabs">
        <span class="wf-callout-badge">2</span>
        <button class="wf-auth-tab active">Masuk Akun (Login)</button>
        <button class="wf-auth-tab">Daftar Akun Baru (Register)</button>
      </div>

      <!-- TWO SIDE-BY-SIDE MOCKUPS TO SHOW BOTH FORMS -->
      <div class="wf-auth-grid">
        <!-- SISI KIRI: FORM LOGIN -->
        <div class="wf-auth-col">
          <div class="wf-auth-col-title">
            <span class="wf-callout-badge">3</span>
            <strong>Mode Masuk Akun</strong>
          </div>

          <div class="wf-form-group">
            <label class="wf-label">Alamat Email / Nomor HP</label>
            <div class="wf-input-text">user@email.com</div>
          </div>

          <div class="wf-form-group">
            <div class="wf-label-split">
              <label class="wf-label">Kata Sandi (Password)</label>
              <a href="#" class="wf-link-sub">Lupa Sandi?</a>
            </div>
            <div class="wf-input-password">
              <span>********</span>
              <span class="wf-pwd-eye">[Lihat]</span>
            </div>
          </div>

          <div class="wf-form-checkbox">
            <label><input type="checkbox" checked> Ingat saya di perangkat ini</label>
          </div>

          <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg" style="margin-top:14px;">Masuk ke Sistem</button>

          <div class="wf-role-hint">
            Catatan: Sistem otomatis mengarahkan ke Dasbor Tamu atau Panel Admin sesuai hak akses pengguna.
          </div>
        </div>

        <!-- SISI KANAN: FORM REGISTRASI -->
        <div class="wf-auth-col wf-border-left">
          <div class="wf-auth-col-title">
            <span class="wf-callout-badge">4</span>
            <strong>Mode Pendaftaran Tamu Baru</strong>
          </div>

          <div class="wf-form-group">
            <label class="wf-label">Nama Lengkap Sesuai KTP/Identitas</label>
            <div class="wf-input-text">Muhammad Fadil</div>
          </div>

          <div class="wf-form-group">
            <label class="wf-label">Alamat Email Aktif</label>
            <div class="wf-input-text">fadil@gmail.com</div>
          </div>

          <div class="wf-form-group">
            <label class="wf-label">Nomor WhatsApp / Telepon</label>
            <div class="wf-input-text">+62 812-9876-5432</div>
          </div>

          <div class="wf-form-group">
            <label class="wf-label">Kata Sandi (Min. 8 Karakter)</label>
            <div class="wf-input-password">
              <span>********</span>
              <span class="wf-pwd-eye">[Lihat]</span>
            </div>
            <div class="wf-pwd-strength"><span class="wf-pwd-bar filled"></span><span class="wf-pwd-bar filled"></span><span class="wf-pwd-bar"></span> <em>Kekuatan: Sedang</em></div>
          </div>

          <div class="wf-form-group">
            <label class="wf-label">Konfirmasi Kata Sandi</label>
            <div class="wf-input-password">
              <span>********</span>
            </div>
          </div>

          <div class="wf-form-checkbox">
            <span class="wf-callout-badge">5</span>
            <label><input type="checkbox" checked> Saya menyetujui Ketentuan Reservasi dan Kebijakan Privasi Rama Homestay</label>
          </div>

          <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg" style="margin-top:14px;">Daftar Akun Sekarang</button>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">[LOGO] RAMA HOMESTAY</div>
  </div>
  <div class="wf-m-body">
    <div class="wf-m-title">Masuk ke Akun Anda</div>
    <div class="wf-m-sub">Gunakan email dan kata sandi yang terdaftar.</div>
    <div class="wf-form-group" style="margin-top:14px;">
      <label class="wf-label">Email</label>
      <div class="wf-input-text">user@email.com</div>
    </div>
    <div class="wf-form-group">
      <label class="wf-label">Password</label>
      <div class="wf-input-text">********</div>
    </div>
    <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg" style="margin-top:14px;">Masuk</button>
    <div style="text-align:center;margin-top:14px;font-size:12px;">Belum punya akun? <a href="#">Daftar Baru</a></div>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-05: FORMULIR PEMESANAN & DATA TAMU
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_05_booking_form',
        'code' => 'WF-05',
        'category' => 'tamu',
        'title' => 'Wireframe: Formulir Pemesanan dan Rincian Tagihan',
        'subtitle' => 'Alur check-out pemesanan kamar dengan stepper proses, pengisian identitas kontak, opsi tamu menginap, catatan khusus, dan rincian harga.',
        'route' => '/tamu/book/{room}',
        'usecase' => 'UC-06: Mengisi Formulir dan Membuat Reservasi',
        'actor' => 'Tamu (Terotentikasi)',
        'width' => 1100,
        'height' => 1250,
        'annotations' => [
            ['num' => '1', 'title' => 'Indikator Tahapan (Booking Stepper)', 'desc' => 'Penanda tahapan alur reservasi: [1] Pilih Kamar > [2] Isi Formulir (Aktif) > [3] Pembayaran Midtrans > [4] E-Tiket Selesai.'],
            ['num' => '2', 'title' => 'Data Pemesan (Otomatis Terisi)', 'desc' => 'Nama, email, dan WhatsApp pemesan terisi otomatis dari data akun yang sedang login.'],
            ['num' => '3', 'title' => 'Opsi Data Tamu Menginap', 'desc' => 'Pilihan apakah pemesan menginap sendiri atau memesankan untuk orang lain.'],
            ['num' => '4', 'title' => 'Estimasi Waktu Tiba dan Permintaan Khusus', 'desc' => 'Dropdown jam kedatangan tamu dan catatan permintaan khusus (kamar lantai 1, sajadah, dll).'],
            ['num' => '5', 'title' => 'Kartu Ringkasan Kamar dan Periode', 'desc' => 'Placeholder kamar, nama tipe, tanggal check-in dan check-out, serta jumlah malam.'],
            ['num' => '6', 'title' => 'Rincian Tagihan Biaya Transparan', 'desc' => 'Kalkulasi tarif kamar per malam, durasi, biaya layanan (Rp 0), dan total harga final.'],
            ['num' => '7', 'title' => 'Tombol Konfirmasi Pesanan dan Lock Kamar', 'desc' => 'Menyimpan pesanan berstatus pending dan mengunci kamar selama 30 menit ke gateway pembayaran.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- TOPBAR -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-nav-links">
      <span class="wf-nav-item">Layanan Bantuan: +62 812-3456-7890</span>
    </div>
    <div class="wf-header-actions">
      <span class="wf-user-badge">[User: Muhammad Fadil]</span>
    </div>
  </div>

  <div class="wf-page-container">
    <!-- STEPPER -->
    <div class="wf-stepper">
      <span class="wf-callout-badge">1</span>
      <div class="wf-step completed"><span class="wf-step-num">[v]</span> Pilih Kamar</div>
      <div class="wf-step-line active"></div>
      <div class="wf-step active"><span class="wf-step-num">[2]</span> Data Pemesan & Rincian</div>
      <div class="wf-step-line"></div>
      <div class="wf-step"><span class="wf-step-num">[3]</span> Pembayaran Midtrans</div>
      <div class="wf-step-line"></div>
      <div class="wf-step"><span class="wf-step-num">[4]</span> E-Tiket Selesai</div>
    </div>

    <!-- MAIN TWO COLUMN FORM -->
    <div class="wf-booking-layout">
      <!-- LEFT COLUMN: GUEST FORM -->
      <div class="wf-booking-form-col">
        <!-- CONTACT CARD -->
        <div class="wf-card wf-form-card">
          <span class="wf-callout-badge">2</span>
          <h3 class="wf-card-title">1. Informasi Kontak Pemesan</h3>
          <p class="wf-card-desc">E-tiket dan konfirmasi pemesanan akan dikirimkan ke kontak ini.</p>
          
          <div class="wf-grid-2">
            <div class="wf-form-group">
              <label class="wf-label">Nama Lengkap</label>
              <div class="wf-input-text">Muhammad Fadil</div>
            </div>
            <div class="wf-form-group">
              <label class="wf-label">Nomor WhatsApp / Telepon</label>
              <div class="wf-input-text">+62 812-9876-5432</div>
            </div>
          </div>
          <div class="wf-form-group">
            <label class="wf-label">Alamat Email</label>
            <div class="wf-input-text">fadil@gmail.com</div>
          </div>
        </div>

        <!-- STAYING GUEST CARD -->
        <div class="wf-card wf-form-card" style="margin-top:16px;">
          <span class="wf-callout-badge">3</span>
          <h3 class="wf-card-title">2. Data Tamu yang Menginap</h3>
          <div class="wf-radio-group">
            <label class="wf-radio-row"><input type="radio" name="guest_type" checked> Saya sendiri yang akan menginap</label>
            <label class="wf-radio-row"><input type="radio" name="guest_type"> Saya memesankan kamar untuk orang lain</label>
          </div>
          <div class="wf-form-group" style="margin-top:10px;">
            <label class="wf-label">Nama Tamu Utama (sesuai KTP saat Check-in)</label>
            <div class="wf-input-text">Muhammad Fadil</div>
          </div>
        </div>

        <!-- SPECIAL REQUEST & ARRIVAL -->
        <div class="wf-card wf-form-card" style="margin-top:16px;">
          <span class="wf-callout-badge">4</span>
          <h3 class="wf-card-title">3. Estimasi Kedatangan dan Permintaan Khusus</h3>
          <div class="wf-form-group">
            <label class="wf-label">Perkiraan Waktu Tiba di Homestay</label>
            <div class="wf-select-mock">14:00 - 16:00 WIB (Sore) [v]</div>
          </div>
          <div class="wf-form-group">
            <label class="wf-label">Permintaan Tambahan (Opsional)</label>
            <div class="wf-textarea-mock">Contoh: Mohon kamar lantai dasar, kasur bersih bebas debu, atau perlengkapan ibadah.</div>
          </div>
        </div>

        <!-- POLICY AGREEMENT -->
        <div class="wf-agreement-card">
          <label class="wf-checkbox-row">
            <input type="checkbox" checked>
            <span>Saya telah membaca dan menyetujui <strong>Aturan Homestay</strong> serta memahami kebijakan pembatalan H-2 sebelum check-in.</span>
          </label>
        </div>
      </div>

      <!-- RIGHT COLUMN: ORDER SUMMARY -->
      <div class="wf-booking-summary-col">
        <div class="wf-card wf-summary-card">
          <span class="wf-callout-badge">5</span>
          <h3 class="wf-card-title">Ringkasan Pemesanan</h3>
          
          <!-- ROOM MINI CARD -->
          <div class="wf-mini-room">
            <div class="wf-img-placeholder" style="width:80px;height:65px;"><div class="wf-cross"></div><span>[Foto]</span></div>
            <div>
              <div class="wf-badge">Deluxe</div>
              <div class="wf-mini-name">Deluxe Double Room</div>
              <div class="wf-mini-sub">1 King Bed | 2 Tamu</div>
            </div>
          </div>

          <div class="wf-divider"></div>

          <!-- DATES -->
          <div class="wf-stay-dates">
            <div class="wf-date-item">
              <span class="wf-date-label">Check-in:</span>
              <strong>Rab, 28 Okt 2026</strong>
              <small>(Mulai 14:00 WIB)</small>
            </div>
            <div class="wf-arrow-right">-&gt;</div>
            <div class="wf-date-item">
              <span class="wf-date-label">Check-out:</span>
              <strong>Jum, 30 Okt 2026</strong>
              <small>(Maks. 12:00 WIB)</small>
            </div>
          </div>

          <div class="wf-stay-duration">Durasi Menginap: <strong>2 Malam</strong></div>

          <div class="wf-divider"></div>

          <!-- BREAKDOWN -->
          <span class="wf-callout-badge">6</span>
          <div class="wf-summary-pricing">
            <div class="wf-summary-row">
              <span>Tarif Kamar (2 Malam x Rp 300.000)</span>
              <span>Rp 600.000</span>
            </div>
            <div class="wf-summary-row">
              <span>Biaya Layanan Homestay</span>
              <span>Rp 0 (Termasuk)</span>
            </div>
            <div class="wf-summary-row">
              <span>Pajak Daerah</span>
              <span>Sudah Termasuk</span>
            </div>
            <div class="wf-divider"></div>
            <div class="wf-summary-row wf-total-row">
              <strong>Total Pembayaran</strong>
              <strong class="wf-price-large">Rp 600.000</strong>
            </div>
          </div>

          <span class="wf-callout-badge">7</span>
          <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg" style="margin-top:16px;">
            Lanjut ke Pembayaran Midtrans -&gt;
          </button>
          <div class="wf-summary-lock">[Kamar akan dikunci selama 30 menit saat Anda diarahkan ke gateway pembayaran]</div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">[&lt;] Konfirmasi Pemesanan</div>
  </div>
  <div class="wf-m-body">
    <div class="wf-badge">Deluxe Double Room</div>
    <div class="wf-m-sub" style="margin:6px 0;">28 Okt 2026 - 30 Okt 2026 (2 Malam)</div>
    
    <div class="wf-form-group" style="margin-top:12px;">
      <label class="wf-label">Nama Pemesan</label>
      <div class="wf-input-text">Muhammad Fadil</div>
    </div>
    <div class="wf-form-group">
      <label class="wf-label">No WhatsApp</label>
      <div class="wf-input-text">+62 812-9876-5432</div>
    </div>
    
    <div class="wf-divider"></div>
    <div class="wf-summary-row wf-total-row">
      <span>Total Bayar:</span>
      <strong>Rp 600.000</strong>
    </div>
    <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg" style="margin-top:12px;">Bayar via Midtrans</button>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-06: PEMBAYARAN MIDTRANS GATEWAY
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_06_pembayaran_midtrans',
        'code' => 'WF-06',
        'category' => 'tamu',
        'title' => 'Wireframe: Pembayaran Midtrans Snap Multi-Metode',
        'subtitle' => 'Layar pembayaran online instan dengan batas waktu 30 menit, tombol pemicu Midtrans Snap, simulasi QRIS dan Virtual Account bank.',
        'route' => '/tamu/pay/{reservation}',
        'usecase' => 'UC-07: Pembayaran Online Multi-Metode (Midtrans)',
        'actor' => 'Tamu dan Midtrans Payment Gateway',
        'width' => 1100,
        'height' => 1100,
        'annotations' => [
            ['num' => '1', 'title' => 'Countdown Timer Kedaluwarsa (30 Menit)', 'desc' => 'Penghitung mundur waktu pembayaran aktif sebelum pesanan otomatis dibatalkan.'],
            ['num' => '2', 'title' => 'Ringkasan Tagihan dan Kode Booking', 'desc' => 'Menampilkan Kode Booking unik (RMH-20261028-0012), nama kamar, periode menginap, dan nominal tagihan.'],
            ['num' => '3', 'title' => 'Tombol Pemicu Midtrans Snap Popup', 'desc' => 'Membuka modal terintegrasi Midtrans Snap untuk memilih metode pembayaran.'],
            ['num' => '4', 'title' => 'Modal Interaktif Midtrans Snap (Simulasi)', 'desc' => 'Pop-up gateway dengan pilihan QRIS, Virtual Account Bank (BCA, Mandiri, BRI, BNI), dan Kartu Debit.'],
            ['num' => '5', 'title' => 'Tampilan Layar QRIS dan Nomor VA', 'desc' => 'Placeholder visual kode QR untuk di-scan via aplikasi m-banking atau petunjuk nomor rekening virtual.'],
            ['num' => '6', 'title' => 'Bilah Sinkronisasi Status Transaksi', 'desc' => 'Tombol verifikasi status pembayaran real-time jika transfer telah selesai dilakukan.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- TOPBAR -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-header-actions">
      <span class="wf-user-badge">[User: Muhammad Fadil]</span>
    </div>
  </div>

  <div class="wf-page-container">
    <!-- TIMER HEADER -->
    <div class="wf-pay-header-banner">
      <span class="wf-callout-badge">1</span>
      <div>
        <div class="wf-pay-timer-title">Selesaikan Pembayaran Anda Sebelum:</div>
        <div class="wf-pay-timer-digits">29 Menit : 45 Detik</div>
      </div>
      <div class="wf-pay-status-pill">STATUS: MENUNGGU PEMBAYARAN</div>
    </div>

    <!-- MAIN TWO COLUMN: BILL SUMMARY & MIDTRANS MOCKUP -->
    <div class="wf-pay-layout">
      <!-- LEFT: ORDER DETAILS -->
      <div class="wf-pay-info-col">
        <div class="wf-card wf-pay-card">
          <span class="wf-callout-badge">2</span>
          <h3 class="wf-card-title">Rincian Tagihan Reservasi</h3>
          
          <div class="wf-booking-code-box">
            <span class="wf-code-label">KODE BOOKING RESMI:</span>
            <span class="wf-code-val">RMH-20261028-0012</span>
          </div>

          <table class="wf-pay-table">
            <tr>
              <td>Tipe Kamar:</td>
              <td><strong>Deluxe Double Room</strong></td>
            </tr>
            <tr>
              <td>Nama Pemesan:</td>
              <td>Muhammad Fadil</td>
            </tr>
            <tr>
              <td>Check-in:</td>
              <td>28 Okt 2026 (14:00 WIB)</td>
            </tr>
            <tr>
              <td>Check-out:</td>
              <td>30 Okt 2026 (12:00 WIB)</td>
            </tr>
            <tr>
              <td>Durasi Menginap:</td>
              <td>2 Malam</td>
            </tr>
            <tr>
              <td>Total Tagihan:</td>
              <td><strong class="wf-pay-total">Rp 600.000</strong></td>
            </tr>
          </table>

          <div class="wf-pay-actions-area">
            <span class="wf-callout-badge">3</span>
            <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg">
              Buka Jendela Pembayaran Midtrans
            </button>
            <span class="wf-callout-badge">6</span>
            <button class="wf-btn wf-btn-outline wf-btn-block" style="margin-top:8px;">
              Periksa Status Pembayaran Real-Time
            </button>
            <button class="wf-btn-text wf-btn-block" style="margin-top:6px;">
              [Batalkan Reservasi Ini]
            </button>
          </div>
        </div>
      </div>

      <!-- RIGHT: SIMULATED MIDTRANS SNAP MODAL -->
      <div class="wf-pay-snap-col">
        <div class="wf-snap-modal-frame">
          <span class="wf-callout-badge">4</span>
          <!-- SNAP HEADER -->
          <div class="wf-snap-header">
            <div class="wf-snap-brand">MIDTRANS <span>SNAP</span></div>
            <div class="wf-snap-merchant">Rama Homestay Official</div>
            <div class="wf-snap-total">Total: <strong>Rp 600.000</strong></div>
          </div>

          <!-- SNAP PAYMENT OPTIONS -->
          <div class="wf-snap-body">
            <div class="wf-snap-section-label">Pilih Metode Pembayaran:</div>
            
            <!-- OPTION QRIS (ACTIVE TAB) -->
            <div class="wf-snap-option active">
              <span class="wf-callout-badge">5</span>
              <div class="wf-snap-opt-head">
                <span>[X] <strong>GoPay / QRIS</strong> (Semua E-Wallet dan m-Banking)</span>
                <span class="wf-snap-badge-popular">INSTAN</span>
              </div>
              <div class="wf-qris-area">
                <div class="wf-qris-box">
                  <div class="wf-qris-qr-mock">
                    <div class="wf-qr-corner tl"></div>
                    <div class="wf-qr-corner tr"></div>
                    <div class="wf-qr-corner bl"></div>
                    <div class="wf-qr-dots"></div>
                    <span>[AREA KODE QRIS MIDTRANS]</span>
                  </div>
                </div>
                <div class="wf-qris-instructions">
                  <ol>
                    <li>Buka aplikasi m-Banking (BCA, Mandiri, BRI, BNI) atau E-Wallet.</li>
                    <li>Pilih menu <strong>Pindai / Scan QRIS</strong>.</li>
                    <li>Arahkan kamera ke kode QR di atas dan masukkan PIN Anda.</li>
                    <li>Verifikasi lunas otomatis dalam hitungan detik.</li>
                  </ol>
                </div>
              </div>
            </div>

            <!-- OPTION VA BANK -->
            <div class="wf-snap-option">
              <div class="wf-snap-opt-head">
                <span>[ ] <strong>Virtual Account Bank</strong> (BCA, Mandiri, BRI, BNI)</span>
                <span>[v]</span>
              </div>
            </div>

            <!-- OPTION CC -->
            <div class="wf-snap-option">
              <div class="wf-snap-opt-head">
                <span>[ ] <strong>Kartu Kredit / Debit Online</strong></span>
                <span>[v]</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">Pembayaran Reservasi</div>
  </div>
  <div class="wf-pay-timer-digits" style="font-size:16px;text-align:center;padding:10px;background:#f1f3f5;">
    Batas Waktu: 29 Menit : 45 Detik
  </div>
  <div class="wf-m-body">
    <div class="wf-booking-code-box">Kode: RMH-20261028-0012</div>
    <div class="wf-summary-row wf-total-row" style="margin:10px 0;">
      <span>Total Tagihan:</span>
      <strong class="wf-pay-total">Rp 600.000</strong>
    </div>
    <div class="wf-qris-qr-mock" style="height:140px;margin:12px auto;width:140px;">
      <span>[QRIS CODE]</span>
    </div>
    <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg">Pindai / Bayar Sekarang</button>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-07: E-TIKET DIGITAL & KONFIRMASI SUKSES
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_07_etiket_sukses',
        'code' => 'WF-07',
        'category' => 'tamu',
        'title' => 'Wireframe: Konfirmasi Sukses dan E-Tiket Digital',
        'subtitle' => 'Dokumen resmi bukti reservasi berstatus confirmed (lunas) dengan QR Code verifikasi check-in, rincian kamar, dan aksi unduh PDF.',
        'route' => '/tamu/book-success',
        'usecase' => 'UC-08: Akses E-Tiket dan Bukti Reservasi',
        'actor' => 'Tamu (Pengguna Terotentikasi)',
        'width' => 1100,
        'height' => 1200,
        'annotations' => [
            ['num' => '1', 'title' => 'Banner Sukses Pembayaran', 'desc' => 'Pemberitahuan bahwa transaksi Midtrans berhasil diverifikasi lunas (status: confirmed).'],
            ['num' => '2', 'title' => 'Kop Bukti Reservasi Resmi Homestay', 'desc' => 'Header bukti reservasi resmi lengkap dengan nama homestay dan stempel LUNAS.'],
            ['num' => '3', 'title' => 'Kode Booking Unik dan QR Code Check-In', 'desc' => 'Kode booking alfanumerik serta QR Code yang dipindai petugas homestay saat tamu tiba di lokasi.'],
            ['num' => '4', 'title' => 'Data Pemesan dan Rincian Kamar', 'desc' => 'Nama tamu, kontak, nomor kamar, tipe ranjang, dan fasilitas yang berhak dinikmati.'],
            ['num' => '5', 'title' => 'Jadwal Check-in dan Check-out Resmi', 'desc' => 'Tanggal dan jam pasti kedatangan serta kepulangan untuk operasional resepsionis.'],
            ['num' => '6', 'title' => 'Rincian Pembayaran Lunas', 'desc' => 'Metode bayar (QRIS/Midtrans), nomor transaksi, dan total biaya tanpa ada biaya tersembunyi.'],
            ['num' => '7', 'title' => 'Tombol Aksi Cetak PDF dan Navigasi Dasbor', 'desc' => 'Fungsi mencetak atau mengunduh dokumen bukti pemesanan serta tombol kembali ke dasbor riwayat.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- TOPBAR -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-header-actions">
      <button class="wf-btn wf-btn-sm wf-btn-outline">Ke Dasbor Saya</button>
    </div>
  </div>

  <div class="wf-page-container">
    <!-- SUCCESS ALERT BANNER -->
    <div class="wf-success-banner">
      <span class="wf-callout-badge">1</span>
      <div>
        <h2 class="wf-success-title">[STATUS: PEMBAYARAN BERHASIL DAN RESERVASI TERKONFIRMASI]</h2>
        <p class="wf-success-sub">Terima kasih atas pemesanan Anda. E-tiket resmi Anda telah aktif dan siap digunakan untuk proses check-in di Rama Homestay.</p>
      </div>
    </div>

    <!-- DIGITAL E-TICKET CARD (BOARDING PASS FORMAT) -->
    <div class="wf-ticket-wrapper">
      <div class="wf-card wf-ticket-card">
        <!-- TICKET HEADER -->
        <div class="wf-ticket-header">
          <span class="wf-callout-badge">2</span>
          <div class="wf-ticket-brand">
            <div class="wf-ticket-logo">[LOGO] RAMA HOMESTAY</div>
            <div class="wf-ticket-sub">Bukti Reservasi Digital Resmi (Official Booking Pass)</div>
          </div>
          <div class="wf-ticket-status">
            <span class="wf-badge-paid">[LUNAS / CONFIRMED]</span>
            <small>ID: RMH-TX-882910</small>
          </div>
        </div>

        <!-- TICKET BODY -->
        <div class="wf-ticket-body">
          <div class="wf-ticket-grid">
            <!-- LEFT: QR & BOOKING CODE -->
            <div class="wf-ticket-qr-col">
              <span class="wf-callout-badge">3</span>
              <div class="wf-ticket-qr-box">
                <div class="wf-qr-box-inner">
                  <div class="wf-qr-corner tl"></div>
                  <div class="wf-qr-corner tr"></div>
                  <div class="wf-qr-corner bl"></div>
                  <div class="wf-qr-dots"></div>
                  <span>[AREA QR CODE CHECK-IN]</span>
                </div>
              </div>
              <div class="wf-ticket-code-label">KODE BOOKING:</div>
              <div class="wf-ticket-code-big">RMH-20261028-0012</div>
              <div class="wf-ticket-qr-note">Tunjukkan QR code ini ke resepsionis homestay saat kedatangan.</div>
            </div>

            <!-- RIGHT: DETAILED RESERVATION DATA -->
            <div class="wf-ticket-info-col">
              <!-- GUEST & ROOM -->
              <span class="wf-callout-badge">4</span>
              <div class="wf-grid-2">
                <div class="wf-ticket-field">
                  <label class="wf-label">NAMA TAMU UTAMA</label>
                  <div class="wf-ticket-val">Muhammad Fadil</div>
                </div>
                <div class="wf-ticket-field">
                  <label class="wf-label">NOMOR KONTAK</label>
                  <div class="wf-ticket-val">+62 812-9876-5432</div>
                </div>
              </div>

              <div class="wf-ticket-field" style="margin-top:10px;">
                <label class="wf-label">TIPE UNIT KAMAR</label>
                <div class="wf-ticket-val-large">Deluxe Double Room (Kamar #101)</div>
                <div class="wf-mini-sub">1 King Bed | 2 Tamu Dewasa | AC | Kamar Mandi Dalam Air Panas</div>
              </div>

              <div class="wf-divider"></div>

              <!-- SCHEDULE -->
              <span class="wf-callout-badge">5</span>
              <div class="wf-grid-3 wf-ticket-dates">
                <div class="wf-ticket-field">
                  <label class="wf-label">JADWAL CHECK-IN</label>
                  <div class="wf-ticket-val">Rab, 28 Okt 2026</div>
                  <small>Mulai 14:00 WIB</small>
                </div>
                <div class="wf-ticket-field">
                  <label class="wf-label">JADWAL CHECK-OUT</label>
                  <div class="wf-ticket-val">Jum, 30 Okt 2026</div>
                  <small>Maksimal 12:00 WIB</small>
                </div>
                <div class="wf-ticket-field">
                  <label class="wf-label">DURASI</label>
                  <div class="wf-ticket-val">2 Malam</div>
                  <small>Status: Terkunci</small>
                </div>
              </div>

              <div class="wf-divider"></div>

              <!-- FINANCIAL BREAKDOWN -->
              <span class="wf-callout-badge">6</span>
              <div class="wf-ticket-payment-row">
                <div>
                  <span class="wf-label">METODE PEMBAYARAN:</span>
                  <div>Midtrans QRIS (Settlement Otomatis)</div>
                </div>
                <div>
                  <span class="wf-label">TOTAL TELAH DIBAYAR:</span>
                  <div class="wf-ticket-price">Rp 600.000</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- TICKET FOOTER -->
        <div class="wf-ticket-footer">
          <div class="wf-ticket-address">
            Lokasi Rama Homestay: Jl. Parangtritis Km 5.5, Yogyakarta | Hubungi CS: +62 812-3456-7890
          </div>
          <div class="wf-ticket-actions">
            <span class="wf-callout-badge">7</span>
            <button class="wf-btn wf-btn-sm wf-btn-primary">Cetak / Unduh PDF</button>
            <button class="wf-btn wf-btn-sm wf-btn-outline">Buka Peta Lokasi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">E-Tiket Reservasi</div>
    <div class="wf-m-burger">[CETAK]</div>
  </div>
  <div class="wf-m-body">
    <div class="wf-badge-paid" style="display:inline-block;margin-bottom:8px;">[STATUS: LUNAS]</div>
    <div class="wf-m-title">Deluxe Double Room</div>
    <div class="wf-ticket-code-big" style="margin:10px 0;">RMH-20261028-0012</div>
    <div class="wf-ticket-qr-box" style="margin:12px auto;width:150px;height:150px;">
      <div class="wf-qr-dots"></div>
      <span>[QR CHECK-IN]</span>
    </div>
    <div class="wf-m-sub" style="text-align:center;">Tamu: Muhammad Fadil</div>
    <div class="wf-m-sub" style="text-align:center;">28 Okt - 30 Okt 2026 (2 Malam)</div>
    <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-lg" style="margin-top:14px;">Simpan Tiket PDF</button>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-08: DASBOR RIWAYAT RESERVASI TAMU
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_08_dashboard_tamu',
        'code' => 'WF-08',
        'category' => 'tamu',
        'title' => 'Wireframe: Dasbor Riwayat Reservasi Tamu',
        'subtitle' => 'Pusat kendali akun tamu untuk memantau status pesanan, bayar ulang, akses e-tiket, pengajuan pembatalan, dan penulisan review ulasan.',
        'route' => '/tamu/dashboard',
        'usecase' => 'UC-08 (E-Tiket), UC-09 (Pembatalan), UC-10 (Ulasan Rating)',
        'actor' => 'Tamu (Pengguna Terotentikasi)',
        'width' => 1100,
        'height' => 1300,
        'annotations' => [
            ['num' => '1', 'title' => 'Header Profil Tamu dan Statistik Akun', 'desc' => 'Nama lengkap pengguna, email, nomor kontak, serta 4 metrik status pesanan: Menunggu Bayar, Aktif, Selesai, Total Pengeluaran.'],
            ['num' => '2', 'title' => 'Tab Filter Status Reservasi', 'desc' => 'Penyaringan daftar riwayat: Semua Pesanan, Menunggu Pembayaran, Terkonfirmasi, Selesai Menginap, Dibatalkan.'],
            ['num' => '3', 'title' => 'Kartu Pesanan Menunggu Bayar (Pending)', 'desc' => 'Item reservasi dengan countdown sisa waktu, tombol Bayar Sekarang via Midtrans, dan tombol Batalkan.'],
            ['num' => '4', 'title' => 'Kartu Pesanan Aktif / Terkonfirmasi (Confirmed)', 'desc' => 'Item reservasi lunas dengan tombol Lihat E-Tiket, petunjuk check-in, dan opsi Ajukan Pembatalan (H-2).'],
            ['num' => '5', 'title' => 'Kartu Pesanan Selesai (Completed)', 'desc' => 'Item riwayat menginap masa lalu dengan tombol Unduh Bukti dan tombol Tulis Ulasan / Rating Homestay.'],
            ['num' => '6', 'title' => 'Modal Interaktif Beri Ulasan Bintang', 'desc' => 'Formulir popup untuk memberikan rating bintang 1-5, aspek kepuasan, dan testimoni ulasan pengalaman tinggal.'],
            ['num' => '7', 'title' => 'Modal Konfirmasi Pembatalan Pesanan', 'desc' => 'Popup dialog verifikasi alasan pembatalan dan persetujuan pelepasan kamar kembali ke sistem.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <!-- TOPBAR -->
  <div class="wf-header">
    <div class="wf-brand"><span class="wf-logo-box">[LOGO] RAMA HOMESTAY</span></div>
    <div class="wf-nav-links">
      <span class="wf-nav-item">Beranda</span>
      <span class="wf-nav-item">Katalog Kamar</span>
      <span class="wf-nav-item active">Dasbor Pemesanan</span>
      <span class="wf-nav-item">Profil Saya</span>
    </div>
    <div class="wf-header-actions">
      <span class="wf-user-badge">[User: Muhammad Fadil]</span>
    </div>
  </div>

  <div class="wf-page-container">
    <!-- USER HEADER & STATS -->
    <div class="wf-dash-user-card">
      <span class="wf-callout-badge">1</span>
      <div class="wf-dash-avatar-row">
        <div class="wf-avatar-circle">[MF]</div>
        <div>
          <h2 class="wf-dash-name">Selamat Datang, Muhammad Fadil</h2>
          <div class="wf-dash-info">Email: fadil@gmail.com | WA: +62 812-9876-5432 | Terdaftar: Jan 2026</div>
        </div>
      </div>
      <div class="wf-grid-4 wf-dash-stats">
        <div class="wf-stat-card">
          <span class="wf-stat-num">1</span>
          <span class="wf-stat-lbl">Menunggu Bayar</span>
        </div>
        <div class="wf-stat-card">
          <span class="wf-stat-num">1</span>
          <span class="wf-stat-lbl">Terkonfirmasi</span>
        </div>
        <div class="wf-stat-card">
          <span class="wf-stat-num">3</span>
          <span class="wf-stat-lbl">Selesai Menginap</span>
        </div>
        <div class="wf-stat-card">
          <span class="wf-stat-num">Rp 1.450.000</span>
          <span class="wf-stat-lbl">Total Pengeluaran</span>
        </div>
      </div>
    </div>

    <!-- TABS -->
    <div class="wf-dash-tabs">
      <span class="wf-callout-badge">2</span>
      <button class="wf-dash-tab active">Semua Reservasi (5)</button>
      <button class="wf-dash-tab">Menunggu Bayar (1)</button>
      <button class="wf-dash-tab">Terkonfirmasi (1)</button>
      <button class="wf-dash-tab">Selesai (3)</button>
      <button class="wf-dash-tab">Dibatalkan (0)</button>
    </div>

    <!-- LIST OF RESERVATION CARDS -->
    <div class="wf-res-list">
      <!-- ITEM 1: PENDING -->
      <div class="wf-card wf-res-item wf-border-bold">
        <span class="wf-callout-badge">3</span>
        <div class="wf-res-head">
          <div>
            <span class="wf-code-badge">RMH-20261028-0012</span>
            <span class="wf-badge">[STATUS: MENUNGGU PEMBAYARAN]</span>
          </div>
          <div class="wf-res-timer">Sisa Waktu Bayar: <strong>18 Menit : 20 Detik</strong></div>
        </div>
        <div class="wf-res-body">
          <div class="wf-img-placeholder" style="width:110px;height:85px;"><div class="wf-cross"></div><span>[Deluxe Room]</span></div>
          <div class="wf-res-details">
            <h4 class="wf-res-title">Deluxe Double Room (Kamar #101)</h4>
            <div class="wf-mini-sub">Jadwal: <strong>28 Okt 2026 - 30 Okt 2026</strong> (2 Malam) | 2 Tamu</div>
            <div class="wf-res-price">Total Tagihan: <strong>Rp 600.000</strong></div>
          </div>
          <div class="wf-res-actions">
            <button class="wf-btn wf-btn-primary">Bayar Sekarang (Midtrans)</button>
            <button class="wf-btn wf-btn-outline" style="margin-top:6px;">Batalkan Pesanan</button>
          </div>
        </div>
      </div>

      <!-- ITEM 2: CONFIRMED -->
      <div class="wf-card wf-res-item wf-border-bold" style="margin-top:14px;">
        <span class="wf-callout-badge">4</span>
        <div class="wf-res-head">
          <div>
            <span class="wf-code-badge">RMH-20260915-0044</span>
            <span class="wf-badge-paid">[STATUS: TERKONFIRMASI / LUNAS]</span>
          </div>
          <div class="wf-res-date">Dipesan pada: 15 Sep 2026</div>
        </div>
        <div class="wf-res-body">
          <div class="wf-img-placeholder" style="width:110px;height:85px;"><div class="wf-cross"></div><span>[Family Suite]</span></div>
          <div class="wf-res-details">
            <h4 class="wf-res-title">Family Suite Room (Kamar #205)</h4>
            <div class="wf-mini-sub">Jadwal: <strong>10 Nov 2026 - 12 Nov 2026</strong> (2 Malam) | 4 Tamu</div>
            <div class="wf-res-price">Total Lunas: <strong>Rp 1.100.000</strong> (Midtrans QRIS)</div>
          </div>
          <div class="wf-res-actions">
            <button class="wf-btn wf-btn-primary">Lihat dan Cetak E-Tiket</button>
            <button class="wf-btn wf-btn-outline" style="margin-top:6px;">Ajukan Pembatalan (H-2)</button>
          </div>
        </div>
      </div>

      <!-- ITEM 3: COMPLETED -->
      <div class="wf-card wf-res-item" style="margin-top:14px;">
        <span class="wf-callout-badge">5</span>
        <div class="wf-res-head">
          <div>
            <span class="wf-code-badge">RMH-20260810-0021</span>
            <span class="wf-badge">[STATUS: SELESAI MENGINAP]</span>
          </div>
          <div class="wf-res-date">Checkout: 12 Agu 2026</div>
        </div>
        <div class="wf-res-body">
          <div class="wf-img-placeholder" style="width:110px;height:85px;"><div class="wf-cross"></div><span>[Standard Room]</span></div>
          <div class="wf-res-details">
            <h4 class="wf-res-title">Standard Double Room (Kamar #201)</h4>
            <div class="wf-mini-sub">Menginap: 10 Agu 2026 - 12 Agu 2026 (2 Malam)</div>
            <div class="wf-res-price">Total Selesai: <strong>Rp 460.000</strong></div>
          </div>
          <div class="wf-res-actions">
            <button class="wf-btn wf-btn-outline">Unduh Bukti</button>
            <button class="wf-btn wf-btn-primary" style="margin-top:6px;">Tulis Ulasan & Rating</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">Riwayat Reservasi</div>
    <div class="wf-m-burger">[PROFIL]</div>
  </div>
  <div class="wf-m-body">
    <div class="wf-card wf-res-item">
      <div class="wf-badge">[MENUNGGU BAYAR: 18 Menit]</div>
      <div class="wf-room-name" style="margin-top:6px;">Deluxe Double Room</div>
      <div class="wf-m-sub">28 Okt - 30 Okt 2026</div>
      <div class="wf-price" style="margin:6px 0;">Rp 600.000</div>
      <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-sm">Bayar Sekarang</button>
    </div>
    
    <div class="wf-card wf-res-item" style="margin-top:10px;">
      <div class="wf-badge-paid">[STATUS: TERKONFIRMASI]</div>
      <div class="wf-room-name" style="margin-top:6px;">Family Suite Room</div>
      <div class="wf-m-sub">10 Nov - 12 Nov 2026</div>
      <button class="wf-btn wf-btn-outline wf-btn-block wf-btn-sm" style="margin-top:6px;">Buka E-Tiket</button>
    </div>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-09: DASBOR UTAMA ADMINISTRATOR
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_09_dashboard_admin',
        'code' => 'WF-09',
        'category' => 'admin',
        'title' => 'Wireframe: Dasbor Utama Administrator',
        'subtitle' => 'Panel kendali admin homestay dengan metrik KPI (pendapatan, okupansi kamar hari ini, tamu check-in/out), grafik performa, dan aksi cepat.',
        'route' => '/admin/dashboard',
        'usecase' => 'UC-12: Manajemen Reservasi dan Rekapitulasi Laporan',
        'actor' => 'Administrator Homestay',
        'width' => 1100,
        'height' => 1250,
        'annotations' => [
            ['num' => '1', 'title' => 'Sidebar Navigasi Modul Admin', 'desc' => 'Menu utama: Dasbor, Manajemen Kamar, Data Reservasi, Kalender Okupansi, Testimoni, Laporan Keuangan, Pengguna, Logout.'],
            ['num' => '2', 'title' => 'Topbar Admin dan Informasi Sesi', 'desc' => 'Penunjuk tanggal operasional, indikator status sistem, pemberitahuan reservasi baru, dan profil admin.'],
            ['num' => '3', 'title' => '4 Kartu KPI Metrik Utama', 'desc' => 'Ringkasan: Total Pendapatan Bulan Berjalan, Total Transaksi Masuk, Tingkat Okupansi Kamar Hari Ini (%), Tamu Check-in Hari Ini.'],
            ['num' => '4', 'title' => 'Visualisasi Grafik Tren Pendapatan 6 Bulan', 'desc' => 'Grafik batang hitam-putih perbandingan pendapatan bulanan untuk analisis tren bisnis homestay.'],
            ['num' => '5', 'title' => 'Status Okupansi Kamar Real-Time', 'desc' => 'Matriks ketersediaan visual tiap nomor unit kamar (Terisi vs Kosong) untuk alokasi kamar resepsionis.'],
            ['num' => '6', 'title' => 'Tabel Tindakan Cepat (Hari Ini)', 'desc' => 'Daftar tamu yang dijadwalkan tiba atau check-out hari ini dengan tombol cepat konfirmasi status satu klik.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <div class="wf-admin-layout">
    <!-- SIDEBAR -->
    <div class="wf-admin-sidebar">
      <span class="wf-callout-badge">1</span>
      <div class="wf-admin-brand">
        <div class="wf-brand-logo">[RAMA PANEL]</div>
        <div class="wf-brand-sub">Sistem Manajemen Homestay</div>
      </div>
      <div class="wf-admin-menu">
        <div class="wf-menu-section">NAVIGASI UTAMA</div>
        <div class="wf-menu-item active">Dasbor Utama</div>
        <div class="wf-menu-item">Manajemen Kamar</div>
        <div class="wf-menu-item">Data Reservasi <span class="wf-badge-count">3</span></div>
        <div class="wf-menu-item">Kalender Okupansi</div>
        
        <div class="wf-menu-section" style="margin-top:16px;">LAPORAN & KONTEN</div>
        <div class="wf-menu-item">Laporan Keuangan</div>
        <div class="wf-menu-item">Moderasi Ulasan</div>
        <div class="wf-menu-item">Pengguna Akun</div>
        <div class="wf-menu-item">Pengaturan Sistem</div>
        <div class="wf-menu-item wf-menu-logout" style="margin-top:24px;">Keluar (Logout)</div>
      </div>
    </div>

    <!-- MAIN ADMIN CONTENT -->
    <div class="wf-admin-main">
      <!-- TOPBAR -->
      <div class="wf-admin-topbar">
        <span class="wf-callout-badge">2</span>
        <div class="wf-topbar-breadcrumb">Admin &gt; <strong>Dasbor Operasional</strong></div>
        <div class="wf-topbar-right">
          <span class="wf-admin-date">Tanggal: Senin, 26 Okt 2026</span>
          <span class="wf-admin-bell">[Pemberitahuan: 3]</span>
          <div class="wf-admin-profile">
            <span class="wf-avatar-sm">[AD]</span>
            <span>Admin Rama</span>
          </div>
        </div>
      </div>

      <div class="wf-admin-body">
        <!-- 4 KPI CARDS -->
        <span class="wf-callout-badge">3</span>
        <div class="wf-grid-4">
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[KPI-1]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">PENDAPATAN BULAN INI</span>
              <span class="wf-kpi-val">Rp 18.450.000</span>
              <span class="wf-kpi-growth">+14.2% vs bulan lalu</span>
            </div>
          </div>
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[KPI-2]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">TOTAL RESERVASI</span>
              <span class="wf-kpi-val">42 Transaksi</span>
              <span class="wf-kpi-sub">38 Lunas | 4 Menunggu</span>
            </div>
          </div>
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[KPI-3]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">OKUPANSI HARI INI</span>
              <span class="wf-kpi-val">75.0%</span>
              <span class="wf-kpi-sub">6 dari 8 Kamar Terisi</span>
            </div>
          </div>
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[KPI-4]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">TAMU HARI INI</span>
              <span class="wf-kpi-val">3 Check-in</span>
              <span class="wf-kpi-sub">2 Check-out terjadwal</span>
            </div>
          </div>
        </div>

        <!-- ROW: CHART & OCCUPANCY MINI -->
        <div class="wf-admin-row-2" style="margin-top:16px;">
          <!-- CHART MOCKUP -->
          <div class="wf-card wf-chart-card">
            <span class="wf-callout-badge">4</span>
            <div class="wf-card-header-flex">
              <div>
                <h3 class="wf-card-title">Tren Pendapatan dan Okupansi 6 Bulan Terakhir</h3>
                <div class="wf-card-desc">Total omzet pemesanan sewa kamar homestay tahun 2026.</div>
              </div>
              <div class="wf-select-mock" style="width:130px;">Tahun 2026 [v]</div>
            </div>
            <!-- BAR CHART VISUAL MOCK (BLACK & WHITE) -->
            <div class="wf-chart-container">
              <div class="wf-chart-bars">
                <div class="wf-bar-col"><div class="wf-bar" style="height:55%;"></div><span>Mei</span></div>
                <div class="wf-bar-col"><div class="wf-bar" style="height:70%;"></div><span>Jun</span></div>
                <div class="wf-bar-col"><div class="wf-bar" style="height:88%;"></div><span>Jul</span></div>
                <div class="wf-bar-col"><div class="wf-bar" style="height:62%;"></div><span>Agu</span></div>
                <div class="wf-bar-col"><div class="wf-bar" style="height:78%;"></div><span>Sep</span></div>
                <div class="wf-bar-col"><div class="wf-bar active" style="height:92%;"></div><span>Okt</span></div>
              </div>
            </div>
          </div>

          <!-- MINI OKUPANSI -->
          <div class="wf-card wf-calendar-mini-card">
            <span class="wf-callout-badge">5</span>
            <h3 class="wf-card-title">Status Kamar Real-Time</h3>
            <div class="wf-card-desc">Alokasi 8 Unit Kamar Hari Ini:</div>
            
            <div class="wf-rooms-status-grid">
              <div class="wf-room-dot-card occupied"><strong>#101</strong><small>Deluxe (Terisi)</small></div>
              <div class="wf-room-dot-card occupied"><strong>#102</strong><small>Deluxe (Terisi)</small></div>
              <div class="wf-room-dot-card available"><strong>#103</strong><small>Standard (Siap)</small></div>
              <div class="wf-room-dot-card occupied"><strong>#104</strong><small>Deluxe (Terisi)</small></div>
              <div class="wf-room-dot-card occupied"><strong>#201</strong><small>Standard (Terisi)</small></div>
              <div class="wf-room-dot-card occupied"><strong>#202</strong><small>Deluxe (Terisi)</small></div>
              <div class="wf-room-dot-card occupied"><strong>#205</strong><small>Family (Terisi)</small></div>
              <div class="wf-room-dot-card cleaning"><strong>#206</strong><small>Standard (Kemas)</small></div>
            </div>
          </div>
        </div>

        <!-- RECENT RESERVATIONS TABLE -->
        <div class="wf-card wf-table-card" style="margin-top:16px;">
          <span class="wf-callout-badge">6</span>
          <div class="wf-card-header-flex">
            <div>
              <h3 class="wf-card-title">Aktivitas Check-In dan Reservasi Terbaru</h3>
              <div class="wf-card-desc">Reservasi masuk yang membutuhkan konfirmasi operasional resepsionis.</div>
            </div>
            <button class="wf-btn wf-btn-sm wf-btn-outline">Lihat Semua Data -&gt;</button>
          </div>

          <table class="wf-data-table">
            <thead>
              <tr>
                <th>Kode Booking</th>
                <th>Tamu</th>
                <th>Kamar</th>
                <th>Check-in / Out</th>
                <th>Total</th>
                <th>Status Bayar</th>
                <th>Status Hunian</th>
                <th>Aksi Cepat</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>RMH-20261028-0012</strong></td>
                <td>Muhammad Fadil<br><small>+62 812-9876-5432</small></td>
                <td>Deluxe #101</td>
                <td>28 Okt - 30 Okt (2 Mlm)</td>
                <td>Rp 600.000</td>
                <td><span class="wf-badge">Pending</span></td>
                <td><span class="wf-badge">Menunggu</span></td>
                <td><button class="wf-btn wf-btn-xs wf-btn-outline">Detail</button></td>
              </tr>
              <tr>
                <td><strong>RMH-20261026-0008</strong></td>
                <td>Dr. Hendra Kusuma<br><small>+62 811-2233-4455</small></td>
                <td>Family #205</td>
                <td>26 Okt - 28 Okt (2 Mlm)</td>
                <td>Rp 1.100.000</td>
                <td><span class="wf-badge-paid">Settlement</span></td>
                <td><span class="wf-badge">Tiba Hari Ini</span></td>
                <td><button class="wf-btn wf-btn-xs wf-btn-primary">Proses Check-In</button></td>
              </tr>
              <tr>
                <td><strong>RMH-20261024-0003</strong></td>
                <td>Bambang Wijaya<br><small>+62 813-4455-6677</small></td>
                <td>Deluxe #102</td>
                <td>24 Okt - 26 Okt (2 Mlm)</td>
                <td>Rp 640.000</td>
                <td><span class="wf-badge-paid">Settlement</span></td>
                <td><span class="wf-badge">Check-Out</span></td>
                <td><button class="wf-btn wf-btn-xs wf-btn-outline">Selesai</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">Admin Panel</div>
    <div class="wf-m-burger">[MENU]</div>
  </div>
  <div class="wf-m-body">
    <div class="wf-grid-2" style="gap:8px;">
      <div class="wf-card wf-kpi-card" style="padding:10px;">
        <span class="wf-kpi-label">Pendapatan:</span>
        <strong style="font-size:14px;">Rp 18.450.000</strong>
      </div>
      <div class="wf-card wf-kpi-card" style="padding:10px;">
        <span class="wf-kpi-label">Okupansi:</span>
        <strong style="font-size:14px;">75% (6/8)</strong>
      </div>
    </div>
    <div class="wf-card wf-table-card" style="margin-top:10px;padding:10px;">
      <div class="wf-card-title" style="font-size:13px;">Tamu Hari Ini (Check-in)</div>
      <div style="font-size:12px;margin:6px 0;">Dr. Hendra Kusuma - Family #205</div>
      <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-sm">Proses Check-In</button>
    </div>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-10: MANAJEMEN DATA KAMAR ADMIN
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_10_manajemen_kamar_admin',
        'code' => 'WF-10',
        'category' => 'admin',
        'title' => 'Wireframe: Manajemen Data Kamar dan Fasilitas',
        'subtitle' => 'Antarmuka pengelolaan inventaris kamar (CRUD: Tambah, Ubah, Nonaktifkan) lengkap dengan modal formulir dan upload foto.',
        'route' => '/admin/rooms',
        'usecase' => 'UC-11: Manajemen Data Kamar dan Fasilitas (Admin)',
        'actor' => 'Administrator Homestay',
        'width' => 1100,
        'height' => 1250,
        'annotations' => [
            ['num' => '1', 'title' => 'Header Modul dan Tombol Tambah Kamar', 'desc' => 'Judul pengelolaan kamar dan tombol pemicu pembuatan unit kamar baru.'],
            ['num' => '2', 'title' => 'Bilah Filter dan Pencarian Data Kamar', 'desc' => 'Filter status (Aktif, Maintenance, Nonaktif), tipe kamar, serta pencarian nomor kamar.'],
            ['num' => '3', 'title' => 'Tabel Data Master Kamar Homestay', 'desc' => 'Menyajikan foto placeholder, nomor unit, tipe kamar, kapasitas tamu, tarif per malam, fasilitas utama, dan status.'],
            ['num' => '4', 'title' => 'Tombol Aksi Operasional', 'desc' => 'Aksi penyuntingan data kamar, sakelar aktifkan/perbaikan unit kamar, dan opsi hapus.'],
            ['num' => '5', 'title' => 'Modal Formulir Input Kamar Baru', 'desc' => 'Formulir input nama unit, tipe kamar, tarif sewa/malam, kapasitas orang, checklist fasilitas, deskripsi, dan upload foto.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <div class="wf-admin-layout">
    <!-- SIDEBAR -->
    <div class="wf-admin-sidebar">
      <div class="wf-admin-brand">
        <div class="wf-brand-logo">[RAMA PANEL]</div>
        <div class="wf-brand-sub">Sistem Manajemen Homestay</div>
      </div>
      <div class="wf-admin-menu">
        <div class="wf-menu-item">Dasbor Utama</div>
        <div class="wf-menu-item active">Manajemen Kamar</div>
        <div class="wf-menu-item">Data Reservasi <span class="wf-badge-count">3</span></div>
        <div class="wf-menu-item">Kalender Okupansi</div>
        <div class="wf-menu-item">Laporan Keuangan</div>
        <div class="wf-menu-item">Moderasi Ulasan</div>
        <div class="wf-menu-item">Pengaturan</div>
      </div>
    </div>

    <!-- MAIN ADMIN -->
    <div class="wf-admin-main">
      <div class="wf-admin-topbar">
        <div class="wf-topbar-breadcrumb">Admin &gt; <strong>Manajemen Kamar</strong></div>
        <div class="wf-topbar-right">
          <button class="wf-btn wf-btn-sm wf-btn-outline">Lihat Katalog Publik</button>
        </div>
      </div>

      <div class="wf-admin-body">
        <!-- HEADER & ACTIONS -->
        <div class="wf-admin-page-head">
          <span class="wf-callout-badge">1</span>
          <div>
            <h2 class="wf-admin-title">Inventaris Kamar dan Fasilitas</h2>
            <p class="wf-admin-sub">Kelola tarif, ketersediaan, fasilitas, dan galeri unit kamar Rama Homestay.</p>
          </div>
          <div>
            <button class="wf-btn wf-btn-primary">+ Tambah Kamar Baru</button>
          </div>
        </div>

        <!-- FILTER & SEARCH BAR -->
        <div class="wf-card wf-filter-bar-card" style="margin-top:14px;">
          <span class="wf-callout-badge">2</span>
          <div class="wf-filter-flex">
            <div class="wf-search-input-box">
              Pencarian: <input type="text" placeholder="Cari nama kamar atau nomor unit..." class="wf-input-clean">
            </div>
            <div class="wf-filter-group-inline">
              <label>Tipe:</label>
              <div class="wf-select-mock" style="width:130px;">Semua Tipe [v]</div>
            </div>
            <div class="wf-filter-group-inline">
              <label>Status:</label>
              <div class="wf-select-mock" style="width:130px;">Semua Status [v]</div>
            </div>
          </div>
        </div>

        <!-- TABLE OF ROOMS -->
        <div class="wf-card wf-table-card" style="margin-top:14px;">
          <span class="wf-callout-badge">3</span>
          <table class="wf-data-table">
            <thead>
              <tr>
                <th>Foto</th>
                <th>Unit / Nama Kamar</th>
                <th>Tipe</th>
                <th>Kapasitas</th>
                <th>Tarif / Malam</th>
                <th>Fasilitas</th>
                <th>Status Unit</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><div class="wf-img-placeholder" style="width:60px;height:45px;"><div class="wf-cross"></div></div></td>
                <td><strong>Deluxe Double Room #101</strong><br><small>Lantai 1, Sayap Timur</small></td>
                <td><span class="wf-badge">Deluxe</span></td>
                <td>2 Orang</td>
                <td><strong>Rp 300.000</strong></td>
                <td><small>AC, Wi-Fi, Water Heater, TV</small></td>
                <td><span class="wf-badge-paid">Aktif</span></td>
                <td>
                  <span class="wf-callout-badge">4</span>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Ubah</button>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Nonaktifkan</button>
                </td>
              </tr>
              <tr>
                <td><div class="wf-img-placeholder" style="width:60px;height:45px;"><div class="wf-cross"></div></div></td>
                <td><strong>Deluxe Twin Room #102</strong><br><small>Lantai 1, Sayap Timur</small></td>
                <td><span class="wf-badge">Deluxe</span></td>
                <td>2 Orang</td>
                <td><strong>Rp 320.000</strong></td>
                <td><small>AC, Wi-Fi, 2 Kasur Single</small></td>
                <td><span class="wf-badge-paid">Aktif</span></td>
                <td>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Ubah</button>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Nonaktifkan</button>
                </td>
              </tr>
              <tr>
                <td><div class="wf-img-placeholder" style="width:60px;height:45px;"><div class="wf-cross"></div></div></td>
                <td><strong>Family Suite Room #205</strong><br><small>Lantai 2, Sayap Barat</small></td>
                <td><span class="wf-badge">Family</span></td>
                <td>4 Orang</td>
                <td><strong>Rp 550.000</strong></td>
                <td><small>AC, Wi-Fi, Dapur, 2 Queen Bed</small></td>
                <td><span class="wf-badge-paid">Aktif</span></td>
                <td>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Ubah</button>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Nonaktifkan</button>
                </td>
              </tr>
              <tr>
                <td><div class="wf-img-placeholder" style="width:60px;height:45px;"><div class="wf-cross"></div></div></td>
                <td><strong>Standard Room #206</strong><br><small>Lantai 2, Sayap Barat</small></td>
                <td><span class="wf-badge">Standard</span></td>
                <td>2 Orang</td>
                <td><strong>Rp 220.000</strong></td>
                <td><small>AC, Wi-Fi, TV</small></td>
                <td><span class="wf-badge">Maintenance</span></td>
                <td>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Ubah</button>
                  <button class="wf-btn wf-btn-xs wf-btn-primary">Aktifkan</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- MOCK MODAL / FORM TAMBAH KAMAR -->
        <div class="wf-card wf-modal-mock-card" style="margin-top:20px;">
          <span class="wf-callout-badge">5</span>
          <div class="wf-modal-head">
            <h3 class="wf-card-title">Modal / Form: Tambah / Ubah Data Kamar</h3>
            <span class="wf-modal-close">[X]</span>
          </div>
          <div class="wf-grid-2" style="margin-top:12px;">
            <div class="wf-form-group">
              <label class="wf-label">Nama Kamar dan Nomor Unit</label>
              <div class="wf-input-text">Contoh: Executive Suite #301</div>
            </div>
            <div class="wf-form-group">
              <label class="wf-label">Kategori / Tipe Kamar</label>
              <div class="wf-select-mock">Deluxe Room [v]</div>
            </div>
          </div>
          <div class="wf-grid-3">
            <div class="wf-form-group">
              <label class="wf-label">Tarif Sewa / Malam (Rp)</label>
              <div class="wf-input-text">350000</div>
            </div>
            <div class="wf-form-group">
              <label class="wf-label">Kapasitas Maksimal Tamu</label>
              <div class="wf-input-text">2 Orang</div>
            </div>
            <div class="wf-form-group">
              <label class="wf-label">Tipe Tempat Tidur</label>
              <div class="wf-input-text">1 King Bed</div>
            </div>
          </div>
          <div class="wf-form-group">
            <label class="wf-label">Pilihan Fasilitas Unit</label>
            <div class="wf-grid-3 wf-checkbox-grid">
              <label><input type="checkbox" checked> AC (Air Conditioner)</label>
              <label><input type="checkbox" checked> Wi-Fi Internet</label>
              <label><input type="checkbox" checked> Water Heater</label>
              <label><input type="checkbox" checked> Smart TV 32"</label>
              <label><input type="checkbox"> Sarapan Termasuk</label>
              <label><input type="checkbox"> Kulkas Mini</label>
            </div>
          </div>
          <div class="wf-form-group">
            <label class="wf-label">Unggah Foto Galeri Kamar (JPG, PNG, WebP maks 2MB)</label>
            <div class="wf-upload-dropzone">
              [Area Upload Berkas: Seret foto ke sini atau klik Pilih Berkas]
            </div>
          </div>
          <div class="wf-modal-foot">
            <button class="wf-btn wf-btn-outline">Batal</button>
            <button class="wf-btn wf-btn-primary">Simpan Data Kamar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">Kelola Kamar</div>
    <button class="wf-btn wf-btn-xs wf-btn-primary">[+ Tambah]</button>
  </div>
  <div class="wf-m-body">
    <div class="wf-card wf-table-card" style="padding:10px;">
      <strong>Deluxe Double #101</strong>
      <div class="wf-m-sub">Rp 300.000 / malam | Status: Aktif</div>
      <div style="margin-top:6px;">
        <button class="wf-btn wf-btn-xs wf-btn-outline">Edit</button>
        <button class="wf-btn wf-btn-xs wf-btn-outline">Nonaktifkan</button>
      </div>
    </div>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-11: MANAJEMEN RESERVASI ADMIN
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_11_manajemen_reservasi_admin',
        'code' => 'WF-11',
        'category' => 'admin',
        'title' => 'Wireframe: Manajemen Reservasi dan Operasional Tamu',
        'subtitle' => 'Panel pengawasan reservasi masuk, pencocokan QR E-Tiket saat check-in, update status hunian (Checked-In / Completed), dan sinkronisasi pembayaran.',
        'route' => '/admin/reservations',
        'usecase' => 'UC-12: Manajemen Reservasi dan Rekapitulasi Laporan',
        'actor' => 'Administrator Homestay',
        'width' => 1100,
        'height' => 1250,
        'annotations' => [
            ['num' => '1', 'title' => 'Pill Filter Status Transaksi dan Okupansi', 'desc' => 'Filter status: Semua (84), Menunggu Bayar (4), Terkonfirmasi (12), Checked-In (6), Selesai (58), Dibatalkan (4).'],
            ['num' => '2', 'title' => 'Pencarian Kode Booking dan Tanggal', 'desc' => 'Bilah pencarian nama tamu, nomor WhatsApp, kode booking, dan rentang tanggal menginap.'],
            ['num' => '3', 'title' => 'Tabel Induk Data Reservasi Lengkap', 'desc' => 'Menyajikan Kode Booking, identitas tamu, unit kamar, jadwal check-in & check-out, biaya sewa, status pembayaran Midtrans, dan status operasional.'],
            ['num' => '4', 'title' => 'Tombol Aksi Operasional Resepsionis', 'desc' => 'Aksi verifikasi kedatangan (Check-In), penutupan sewa (Check-Out), dan detail audit transaksi.'],
            ['num' => '5', 'title' => 'Drawer Detail Transaksi dan Log Midtrans', 'desc' => 'Rincian audit reservasi: data kontak lengkap, nomor referensi Midtrans, tanggal settlement, dan catatan khusus tamu.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <div class="wf-admin-layout">
    <!-- SIDEBAR -->
    <div class="wf-admin-sidebar">
      <div class="wf-admin-brand">
        <div class="wf-brand-logo">[RAMA PANEL]</div>
        <div class="wf-brand-sub">Sistem Manajemen Homestay</div>
      </div>
      <div class="wf-admin-menu">
        <div class="wf-menu-item">Dasbor Utama</div>
        <div class="wf-menu-item">Manajemen Kamar</div>
        <div class="wf-menu-item active">Data Reservasi <span class="wf-badge-count">3</span></div>
        <div class="wf-menu-item">Kalender Okupansi</div>
        <div class="wf-menu-item">Laporan Keuangan</div>
        <div class="wf-menu-item">Moderasi Ulasan</div>
        <div class="wf-menu-item">Pengaturan</div>
      </div>
    </div>

    <!-- MAIN ADMIN -->
    <div class="wf-admin-main">
      <div class="wf-admin-topbar">
        <div class="wf-topbar-breadcrumb">Admin &gt; <strong>Data Reservasi dan Tamu</strong></div>
        <div class="wf-topbar-right">
          <button class="wf-btn wf-btn-sm wf-btn-primary">Cetak Rekapitulasi</button>
        </div>
      </div>

      <div class="wf-admin-body">
        <div class="wf-admin-page-head">
          <div>
            <h2 class="wf-admin-title">Pengelolaan Reservasi dan Operasional Tamu</h2>
            <p class="wf-admin-sub">Pantau alur transaksi, validasi check-in kedatangan tamu, dan mutasi status pemesanan.</p>
          </div>
        </div>

        <!-- FILTER PILLS -->
        <div class="wf-filter-pills-row" style="margin-top:14px;">
          <span class="wf-callout-badge">1</span>
          <button class="wf-pill-btn active">Semua Reservasi (84)</button>
          <button class="wf-pill-btn">Menunggu Bayar (4)</button>
          <button class="wf-pill-btn">Terkonfirmasi (12)</button>
          <button class="wf-pill-btn">Checked-In (6)</button>
          <button class="wf-pill-btn">Selesai (58)</button>
          <button class="wf-pill-btn">Dibatalkan (4)</button>
        </div>

        <!-- SEARCH BAR -->
        <div class="wf-card wf-filter-bar-card" style="margin-top:12px;">
          <span class="wf-callout-badge">2</span>
          <div class="wf-filter-flex">
            <div class="wf-search-input-box" style="flex:2;">
              Pencarian: <input type="text" placeholder="Cari kode booking, nama tamu, atau no WhatsApp..." class="wf-input-clean">
            </div>
            <div class="wf-filter-group-inline">
              <label>Periode:</label>
              <div class="wf-input-mock">Bulan Ini (Okt 2026) [v]</div>
            </div>
            <div class="wf-filter-group-inline">
              <label>Kamar:</label>
              <div class="wf-select-mock" style="width:130px;">Semua Unit [v]</div>
            </div>
          </div>
        </div>

        <!-- MAIN TABLE -->
        <div class="wf-card wf-table-card" style="margin-top:14px;">
          <span class="wf-callout-badge">3</span>
          <table class="wf-data-table">
            <thead>
              <tr>
                <th>Kode Booking</th>
                <th>Data Tamu</th>
                <th>Unit Kamar</th>
                <th>Periode Menginap</th>
                <th>Total Biaya</th>
                <th>Status Midtrans</th>
                <th>Status Operasional</th>
                <th>Aksi Resepsionis</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>RMH-20261028-0012</strong><br><small>26/10 22:15</small></td>
                <td>Muhammad Fadil<br><small>+62 812-9876-5432</small></td>
                <td>Deluxe #101</td>
                <td>28 Okt - 30 Okt (2 Mlm)</td>
                <td><strong>Rp 600.000</strong></td>
                <td><span class="wf-badge">pending</span></td>
                <td><span class="wf-badge">Menunggu Bayar</span></td>
                <td>
                  <span class="wf-callout-badge">4</span>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Detail</button>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Batal</button>
                </td>
              </tr>
              <tr>
                <td><strong>RMH-20261026-0008</strong><br><small>25/10 14:10</small></td>
                <td>Dr. Hendra Kusuma<br><small>+62 811-2233-4455</small></td>
                <td>Family #205</td>
                <td>26 Okt - 28 Okt (2 Mlm)</td>
                <td><strong>Rp 1.100.000</strong></td>
                <td><span class="wf-badge-paid">settlement</span></td>
                <td><span class="wf-badge">Terkonfirmasi</span></td>
                <td>
                  <button class="wf-btn wf-btn-xs wf-btn-primary">Proses Check-In</button>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Tiket</button>
                </td>
              </tr>
              <tr>
                <td><strong>RMH-20261024-0003</strong><br><small>24/10 09:30</small></td>
                <td>Bambang Wijaya<br><small>+62 813-4455-6677</small></td>
                <td>Deluxe #102</td>
                <td>24 Okt - 26 Okt (2 Mlm)</td>
                <td><strong>Rp 640.000</strong></td>
                <td><span class="wf-badge-paid">settlement</span></td>
                <td><span class="wf-badge">Checked-In</span></td>
                <td>
                  <button class="wf-btn wf-btn-xs wf-btn-primary">Proses Check-Out</button>
                </td>
              </tr>
              <tr>
                <td><strong>RMH-20261020-0019</strong><br><small>20/10 11:00</small></td>
                <td>Siti Rahmawati<br><small>+62 818-7788-9900</small></td>
                <td>Standard #201</td>
                <td>20 Okt - 22 Okt (2 Mlm)</td>
                <td><strong>Rp 460.000</strong></td>
                <td><span class="wf-badge-paid">settlement</span></td>
                <td><span class="wf-badge">Completed</span></td>
                <td>
                  <button class="wf-btn wf-btn-xs wf-btn-outline">Arsip</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- DRAWER / DETAIL MODAL -->
        <div class="wf-card wf-modal-mock-card" style="margin-top:20px;">
          <span class="wf-callout-badge">5</span>
          <div class="wf-modal-head">
            <h3 class="wf-card-title">Rincian Reservasi dan Log Audit Midtrans: RMH-20261026-0008</h3>
            <span class="wf-modal-close">[X]</span>
          </div>
          <div class="wf-grid-3" style="margin-top:12px;">
            <div>
              <label class="wf-label">NAMA PEMESAN / TAMU</label>
              <div><strong>Dr. Hendra Kusuma</strong></div>
              <small>Email: hendra@kemenkes.go.id</small>
            </div>
            <div>
              <label class="wf-label">TRANSAKSI MIDTRANS</label>
              <div><strong>Settlement (Lunas)</strong></div>
              <small>Order ID: RMH-20261026-0008 | QRIS BCA</small>
            </div>
            <div>
              <label class="wf-label">TANGGAL TRANSAKSI</label>
              <div>25 Oktober 2026, 14:10:45 WIB</div>
              <small>Signature Key: Valid SHA-512</small>
            </div>
          </div>
          <div class="wf-divider"></div>
          <div>
            <label class="wf-label">PERMINTAAN KHUSUS TAMU:</label>
            <div class="wf-quote-box">"Mohon siapkan sajadah dan kamar bebas bau rokok karena membawa anak kecil."</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">Daftar Reservasi</div>
    <div class="wf-m-burger">[CARI]</div>
  </div>
  <div class="wf-m-body">
    <div class="wf-card wf-table-card" style="padding:10px;">
      <div class="wf-badge-paid">[Settlement]</div>
      <div style="font-weight:700;margin:4px 0;">RMH-20261026-0008</div>
      <div class="wf-m-sub">Dr. Hendra Kusuma | Family #205</div>
      <div class="wf-price" style="margin:4px 0;">Rp 1.100.000</div>
      <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-sm">Verifikasi Check-In</button>
    </div>
  </div>
</div>
HTML
    ],

    // ------------------------------------------------------------------------
    // WF-12: REKAPITULASI LAPORAN & EKSPOR
    // ------------------------------------------------------------------------
    [
        'id' => 'wf_12_laporan_pendapatan_admin',
        'code' => 'WF-12',
        'category' => 'admin',
        'title' => 'Wireframe: Laporan Pendapatan dan Ekspor Data',
        'subtitle' => 'Halaman rekapitulasi finansial homestay dengan filter rentang tanggal, ringkasan omzet, tabel rincian transaksi, dan tombol ekspor PDF/Excel.',
        'route' => '/admin/reports',
        'usecase' => 'UC-12: Manajemen Reservasi dan Rekapitulasi Laporan',
        'actor' => 'Administrator dan Pemilik Homestay',
        'width' => 1100,
        'height' => 1250,
        'annotations' => [
            ['num' => '1', 'title' => 'Formulir Filter Rentang Tanggal Laporan', 'desc' => 'Pemilih periode akuntansi: Hari Ini, Minggu Ini, Bulan Berjalan, atau rentang tanggal kustom.'],
            ['num' => '2', 'title' => 'Tombol Ekspor Dokumen Resmi', 'desc' => 'Aksi ekspor: Unduh PDF Format Siap Cetak dan Ekspor Excel (.xlsx) untuk arsip pembukuan.'],
            ['num' => '3', 'title' => '4 Ringkasan Finansial Eksekutif', 'desc' => 'Kartu ringkasan: Total Pendapatan Bersih (Rp), Total Malam Terjual (Room Nights), Rata-rata Nilai Transaksi, dan Tingkat Okupansi Kumulatif.'],
            ['num' => '4', 'title' => 'Tabel Rincian Data Transaksi Laporan', 'desc' => 'Daftar transaksi: No, Tanggal, Kode Booking, Tamu, Unit Kamar, Durasi Malam, Metode Bayar, dan Nominal Bersih.'],
            ['num' => '5', 'title' => 'Baris Total Akumulasi (Grand Total)', 'desc' => 'Baris penutup tabel yang menjumlahkan seluruh transaksi lunas secara otomatis tanpa kesalahan manual.'],
            ['num' => '6', 'title' => 'Format Cetak Resmi dan Tanda Tangan', 'desc' => 'Kop resmi Rama Homestay, tanggal cetak dokumen laporan, dan kolom tanda tangan penanggung jawab administrasi.']
        ],
        'desktop_html' => <<<HTML
<div class="wf-screen">
  <div class="wf-admin-layout">
    <!-- SIDEBAR -->
    <div class="wf-admin-sidebar">
      <div class="wf-admin-brand">
        <div class="wf-brand-logo">[RAMA PANEL]</div>
        <div class="wf-brand-sub">Sistem Manajemen Homestay</div>
      </div>
      <div class="wf-admin-menu">
        <div class="wf-menu-item">Dasbor Utama</div>
        <div class="wf-menu-item">Manajemen Kamar</div>
        <div class="wf-menu-item">Data Reservasi <span class="wf-badge-count">3</span></div>
        <div class="wf-menu-item">Kalender Okupansi</div>
        <div class="wf-menu-item active">Laporan Keuangan</div>
        <div class="wf-menu-item">Moderasi Ulasan</div>
        <div class="wf-menu-item">Pengaturan</div>
      </div>
    </div>

    <!-- MAIN ADMIN -->
    <div class="wf-admin-main">
      <div class="wf-admin-topbar">
        <div class="wf-topbar-breadcrumb">Admin &gt; <strong>Laporan Keuangan dan Okupansi</strong></div>
        <div class="wf-topbar-right">
          <span class="wf-callout-badge">2</span>
          <button class="wf-btn wf-btn-sm wf-btn-outline">Ekspor Excel (.xlsx)</button>
          <button class="wf-btn wf-btn-sm wf-btn-primary">Cetak / Unduh PDF</button>
        </div>
      </div>

      <div class="wf-admin-body">
        <div class="wf-admin-page-head">
          <div>
            <h2 class="wf-admin-title">Rekapitulasi Laporan Pendapatan dan Hunian</h2>
            <p class="wf-admin-sub">Laporan keuangan transparan berdasarkan transaksi lunas (settlement) melalui sistem Rama Homestay.</p>
          </div>
        </div>

        <!-- FILTER FORM -->
        <div class="wf-card wf-filter-bar-card" style="margin-top:14px;">
          <span class="wf-callout-badge">1</span>
          <div class="wf-filter-flex">
            <div class="wf-filter-group-inline">
              <label>Periode Waktu:</label>
              <div class="wf-select-mock" style="width:140px;">Bulan Berjalan [v]</div>
            </div>
            <div class="wf-filter-group-inline">
              <label>Dari Tanggal:</label>
              <div class="wf-input-mock">01/10/2026</div>
            </div>
            <div class="wf-filter-group-inline">
              <label>Sampai Tanggal:</label>
              <div class="wf-input-mock">31/10/2026</div>
            </div>
            <div class="wf-filter-group-inline">
              <label>Status:</label>
              <div class="wf-select-mock" style="width:130px;">Lunas / Confirmed [v]</div>
            </div>
            <div>
              <button class="wf-btn wf-btn-primary">Tampilkan Laporan</button>
            </div>
          </div>
        </div>

        <!-- 4 SUMMARY CARDS -->
        <span class="wf-callout-badge">3</span>
        <div class="wf-grid-4" style="margin-top:14px;">
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[FIN-1]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">TOTAL PENDAPATAN BERSIH</span>
              <span class="wf-kpi-val">Rp 18.450.000</span>
              <span class="wf-kpi-sub">Berdasarkan 38 transaksi lunas</span>
            </div>
          </div>
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[FIN-2]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">MALAM TERJUAL (ROOM NIGHTS)</span>
              <span class="wf-kpi-val">76 Malam</span>
              <span class="wf-kpi-sub">Dari total 248 malam tersedia</span>
            </div>
          </div>
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[FIN-3]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">TINGKAT OKUPANSI RATA-RATA</span>
              <span class="wf-kpi-val">72.4%</span>
              <span class="wf-kpi-growth">+5.8% vs target</span>
            </div>
          </div>
          <div class="wf-card wf-kpi-card">
            <div class="wf-text-icon">[FIN-4]</div>
            <div class="wf-kpi-data">
              <span class="wf-kpi-label">RATA-RATA HARGA (ADR)</span>
              <span class="wf-kpi-val">Rp 242.763</span>
              <span class="wf-kpi-sub">Tarif rata-rata per malam</span>
            </div>
          </div>
        </div>

        <!-- DETAILED REPORT TABLE -->
        <div class="wf-card wf-table-card" style="margin-top:16px;">
          <span class="wf-callout-badge">4</span>
          <div class="wf-card-header-flex">
            <div>
              <h3 class="wf-card-title">Rincian Transaksi Pendapatan Periode 01 Okt 2026 - 31 Okt 2026</h3>
              <div class="wf-card-desc">Rekapitulasi resmi untuk pembukuan akuntansi homestay.</div>
            </div>
          </div>

          <table class="wf-data-table">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Booking</th>
                <th>Nama Tamu</th>
                <th>Tipe Kamar</th>
                <th>Malam</th>
                <th>Metode Bayar</th>
                <th>Nominal (Rp)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>25/10/2026</td>
                <td><strong>RMH-20261026-0008</strong></td>
                <td>Dr. Hendra Kusuma</td>
                <td>Family Suite #205</td>
                <td>2 Malam</td>
                <td>Midtrans QRIS</td>
                <td>Rp 1.100.000</td>
              </tr>
              <tr>
                <td>2</td>
                <td>24/10/2026</td>
                <td><strong>RMH-20261024-0003</strong></td>
                <td>Bambang Wijaya</td>
                <td>Deluxe Double #102</td>
                <td>2 Malam</td>
                <td>BCA Virtual Account</td>
                <td>Rp 640.000</td>
              </tr>
              <tr>
                <td>3</td>
                <td>20/10/2026</td>
                <td><strong>RMH-20261020-0019</strong></td>
                <td>Siti Rahmawati</td>
                <td>Standard Double #201</td>
                <td>2 Malam</td>
                <td>Midtrans QRIS</td>
                <td>Rp 460.000</td>
              </tr>
              <tr>
                <td>4</td>
                <td>18/10/2026</td>
                <td><strong>RMH-20261018-0011</strong></td>
                <td>Ahmad Prasetyo</td>
                <td>Deluxe King #101</td>
                <td>3 Malam</td>
                <td>Mandiri Bill</td>
                <td>Rp 900.000</td>
              </tr>
              <tr>
                <td>...</td>
                <td>...</td>
                <td><em>34 transaksi lainnya</em></td>
                <td>...</td>
                <td>...</td>
                <td>67 Malam</td>
                <td>...</td>
                <td>Rp 15.350.000</td>
              </tr>
              <!-- GRAND TOTAL ROW -->
              <tr class="wf-grand-total-row">
                <td colspan="5">
                  <span class="wf-callout-badge">5</span>
                  <strong>GRAND TOTAL PENDAPATAN PERIODE INI:</strong>
                </td>
                <td><strong>76 Malam</strong></td>
                <td>-</td>
                <td><strong class="wf-total-income">Rp 18.450.000</strong></td>
              </tr>
            </tbody>
          </table>

          <!-- REPORT PRINT FOOTER SIGNATURE MOCK -->
          <div class="wf-report-signature-block">
            <span class="wf-callout-badge">6</span>
            <div class="wf-sign-col">
              <div>Dicetak pada: 26 Oktober 2026, 22:30 WIB</div>
              <div>Sistem Informasi Reservasi Rama Homestay</div>
            </div>
            <div class="wf-sign-col" style="text-align:right;">
              <div>Yogyakarta, 26 Oktober 2026</div>
              <div><strong>Pengelola Rama Homestay</strong></div>
              <div class="wf-signature-line">[ Tanda Tangan dan Stempel Resmi ]</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
HTML,
        'mobile_html' => <<<HTML
<div class="wf-mobile-screen">
  <div class="wf-m-header">
    <div class="wf-m-brand">Laporan Keuangan</div>
    <div class="wf-m-burger">[UNDUH]</div>
  </div>
  <div class="wf-m-body">
    <div class="wf-card wf-kpi-card" style="padding:10px;">
      <span class="wf-kpi-label">Pendapatan Bulan Ini:</span>
      <strong style="font-size:18px;">Rp 18.450.000</strong>
      <div class="wf-m-sub">76 Malam Terjual (Okupansi 72.4%)</div>
    </div>
    <div style="margin-top:10px;">
      <button class="wf-btn wf-btn-primary wf-btn-block wf-btn-sm">Unduh Laporan PDF</button>
    </div>
  </div>
</div>
HTML
    ]
];

// ============================================================================
// CSS HITAM PUTIH (MONOCHROME / GRAYSCALE MURNI)
// ============================================================================

$cssCommon = <<<CSS
:root {
  --wf-bg: #f8f9fa;
  --wf-paper: #ffffff;
  --wf-border: #ced4da;
  --wf-border-dark: #000000;
  --wf-text: #000000;
  --wf-text-muted: #495057;
  --wf-primary: #000000;
  --wf-primary-hover: #343a40;
  --wf-accent: #6c757d;
  --wf-success: #000000;
  --wf-danger: #000000;
  --wf-radius: 4px;
  --wf-font: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: var(--wf-font);
  background: #ffffff;
  color: var(--wf-text);
  line-height: 1.5;
  font-size: 13px;
  padding: 16px;
}

/* WIREFRAME BASE CONTAINER */
.wf-screen {
  background: var(--wf-paper);
  border: 2px solid #000000;
  border-radius: var(--wf-radius);
  overflow: hidden;
  position: relative;
  width: 100%;
}

/* CALLOUT BADGES (HITAM PUTIH) */
.wf-callout-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 22px;
  height: 22px;
  background: #000000;
  color: #ffffff;
  font-size: 11px;
  font-weight: 800;
  border-radius: 50%;
  margin-right: 6px;
  vertical-align: middle;
  flex-shrink: 0;
  border: 1px solid #000000;
}

/* HEADER & NAVBAR */
.wf-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 24px;
  border-bottom: 2px solid #000000;
  background: #ffffff;
}

.wf-brand {
  font-size: 15px;
  font-weight: 800;
  display: flex;
  align-items: center;
  gap: 8px;
  color: #000000;
}

.wf-logo-box {
  padding: 4px 8px;
  border: 1.5px solid #000000;
  border-radius: 2px;
  background: #ffffff;
}

.wf-nav-links {
  display: flex;
  gap: 20px;
  font-weight: 700;
  color: #495057;
}

.wf-nav-item.active {
  color: #000000;
  border-bottom: 2px solid #000000;
  padding-bottom: 2px;
}

.wf-header-actions {
  display: flex;
  gap: 8px;
  align-items: center;
}

/* BUTTONS (HITAM PUTIH MURNI) */
.wf-btn {
  font-family: inherit;
  font-weight: 700;
  font-size: 12px;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  border: 1.5px solid #000000;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.wf-btn-sm { padding: 5px 12px; font-size: 11px; }
.wf-btn-xs { padding: 3px 8px; font-size: 10px; border-radius: 2px; }
.wf-btn-lg { padding: 10px 20px; font-size: 13px; }
.wf-btn-block { width: 100%; display: flex; }

.wf-btn-primary { background: #000000; color: #ffffff; border-color: #000000; }
.wf-btn-outline { background: #ffffff; color: #000000; border-color: #000000; }
.wf-btn-amber { background: #ffffff; color: #000000; border-color: #000000; }
.wf-btn-text { background: transparent; border: none; font-weight: 700; cursor: pointer; color: #000000; text-decoration: underline; }

/* HERO (HITAM PUTIH) */
.wf-hero {
  padding: 45px 30px;
  background: #ffffff;
  color: #000000;
  text-align: center;
  position: relative;
  border-bottom: 2px solid #000000;
}

.wf-hero-content { max-width: 750px; margin: 0 auto; }
.wf-chip {
  display: inline-block;
  padding: 3px 10px;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 0.5px;
  background: #f1f3f5;
  color: #000000;
  border: 1.5px solid #000000;
  border-radius: 4px;
  margin-bottom: 12px;
}
.wf-hero-title { font-size: 24px; font-weight: 800; margin-bottom: 8px; line-height: 1.3; color: #000000; }
.wf-hero-sub { color: #495057; font-size: 12px; line-height: 1.6; margin-bottom: 18px; }
.wf-hero-actions { display: flex; gap: 10px; justify-content: center; }

/* SEARCH WIDGET (HITAM PUTIH) */
.wf-search-widget {
  background: #ffffff;
  border: 2px solid #000000;
  border-radius: 6px;
  max-width: 900px;
  margin: -24px auto 26px;
  padding: 12px 18px;
  display: flex;
  align-items: center;
  position: relative;
  z-index: 10;
}

.wf-search-col { flex: 1; }
.wf-search-btn-col { flex: 0.9; }
.wf-search-divider { width: 1.5px; height: 35px; background: #000000; margin: 0 15px; }
.wf-label { font-size: 10px; font-weight: 800; color: #000000; text-transform: uppercase; margin-bottom: 4px; display: block; }
.wf-input-mock { font-weight: 700; color: #000000; font-size: 12px; border: 1px dashed #6c757d; padding: 4px 6px; background: #f8f9fa; }

/* SECTIONS */
.wf-section { padding: 36px 24px; }
.wf-bg-alt { background: #f8f9fa; border-top: 1.5px solid #000000; border-bottom: 1.5px solid #000000; }
.wf-section-header { text-align: center; max-width: 650px; margin: 0 auto 26px; }
.wf-section-title { font-size: 18px; font-weight: 800; margin-bottom: 4px; color: #000000; }
.wf-section-sub { color: #495057; font-size: 11.5px; }

/* GRIDS */
.wf-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; }
.wf-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
.wf-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }

/* CARDS (HITAM PUTIH) */
.wf-card {
  background: #ffffff;
  border: 1.5px solid #000000;
  border-radius: 4px;
  padding: 14px;
  position: relative;
}

.wf-card-feature { text-align: center; padding: 18px 12px; }
.wf-text-icon { font-size: 14px; font-weight: 800; margin-bottom: 8px; border: 1.5px solid #000000; display: inline-block; padding: 2px 8px; background: #f1f3f5; }
.wf-card-title { font-size: 13px; font-weight: 800; margin-bottom: 4px; color: #000000; }
.wf-card-desc { color: #495057; font-size: 11px; line-height: 1.5; }

/* IMAGE PLACEHOLDER (DIAGONAL CROSS HITAM PUTIH) */
.wf-img-placeholder {
  background: #f8f9fa;
  border: 1.5px dashed #000000;
  border-radius: 4px;
  height: 150px;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #000000;
  font-size: 11px;
  font-weight: 700;
  text-align: center;
  overflow: hidden;
  padding: 10px;
}

.wf-cross {
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  pointer-events: none;
}
.wf-cross::before, .wf-cross::after {
  content: '';
  position: absolute;
  top: 50%; left: 0; width: 100%; height: 1px;
  background: #adb5bd;
}
.wf-cross::before { transform: rotate(18deg); }
.wf-cross::after { transform: rotate(-18deg); }

/* ROOM BODY */
.wf-room-card { padding: 0; overflow: hidden; }
.wf-room-body { padding: 12px; }
.wf-badge-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px; }
.wf-badge {
  display: inline-block;
  padding: 2px 6px;
  font-size: 10px;
  font-weight: 800;
  border-radius: 2px;
  background: #f1f3f5;
  color: #000000;
  border: 1px solid #000000;
}
.wf-badge-paid { background: #000000; color: #ffffff; border: 1px solid #000000; font-weight: 800; }
.wf-rating { font-size: 10.5px; font-weight: 700; color: #000000; }
.wf-room-name { font-size: 13.5px; font-weight: 800; margin-bottom: 4px; color: #000000; }
.wf-room-facilities { font-size: 10.5px; color: #495057; margin-bottom: 10px; }
.wf-room-price-row { display: flex; justify-content: space-between; align-items: center; }
.wf-price { font-size: 15px; font-weight: 800; color: #000000; }
.wf-unit { font-size: 10.5px; color: #495057; font-weight: normal; }

/* TESTIMONIAL */
.wf-card-testi { background: #ffffff; }
.wf-rating-text { font-weight: 800; font-size: 11px; margin-bottom: 6px; color: #000000; }
.wf-testi-text { font-style: italic; color: #212529; font-size: 11px; margin-bottom: 8px; line-height: 1.5; }
.wf-testi-user { font-size: 10.5px; color: #495057; }

/* FOOTER */
.wf-footer {
  background: #ffffff;
  color: #000000;
  padding: 30px 24px 16px;
  border-top: 2px solid #000000;
}
.wf-footer-brand { font-size: 15px; font-weight: 800; color: #000000; margin-bottom: 6px; }
.wf-footer-title { font-size: 12px; font-weight: 800; color: #000000; margin-bottom: 6px; }
.wf-footer-text { font-size: 10.5px; line-height: 1.6; color: #495057; }
.wf-map-box { height: 80px; background: #f8f9fa; border: 1.5px dashed #000000; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #000000; }
.wf-footer-bottom { border-top: 1px solid #ced4da; padding-top: 14px; margin-top: 20px; text-align: center; font-size: 10.5px; color: #6c757d; }

/* BREADCRUMB & BANNER */
.wf-page-banner { padding: 20px 24px; background: #f8f9fa; border-bottom: 1.5px solid #000000; }
.wf-breadcrumb { font-size: 10.5px; color: #495057; margin-bottom: 4px; }
.wf-banner-title { font-size: 20px; font-weight: 800; color: #000000; }
.wf-banner-sub { color: #495057; font-size: 11.5px; }

/* CATALOG */
.wf-catalog-layout { display: grid; grid-template-columns: 250px 1fr; gap: 18px; padding: 20px 24px; }
.wf-sidebar-filter { background: #fff; border: 1.5px solid #000000; border-radius: 4px; padding: 14px; height: fit-content; }
.wf-filter-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 1.5px solid #000000; }
.wf-filter-title { font-weight: 800; font-size: 12px; }
.wf-filter-group { margin-bottom: 14px; }
.wf-checkbox-row { display: flex; align-items: center; gap: 8px; font-size: 11px; margin-bottom: 5px; cursor: pointer; }
.wf-slider-track { height: 4px; background: #ced4da; border-radius: 2px; position: relative; margin: 8px 0; border: 1px solid #000000; }
.wf-slider-fill { width: 60%; height: 100%; background: #000000; }
.wf-range-label { display: flex; justify-content: space-between; font-size: 10px; color: #495057; }
.wf-sort-bar { display: flex; justify-content: space-between; align-items: center; padding: 8px 12px; background: #f8f9fa; border: 1.5px solid #000000; border-radius: 4px; margin-bottom: 14px; font-size: 11.5px; }
.wf-sort-controls { display: flex; align-items: center; gap: 6px; }
.wf-select-mock { padding: 4px 8px; border: 1.5px solid #000000; border-radius: 2px; background: #fff; font-weight: 700; font-size: 11px; }
.wf-pagination { display: flex; justify-content: center; gap: 6px; margin-top: 20px; }
.wf-btn-page { padding: 5px 10px; border: 1.5px solid #000000; background: #fff; border-radius: 2px; font-size: 11px; font-weight: 700; cursor: pointer; }
.wf-btn-page.active { background: #000000; color: #fff; }

/* DETAIL ROOM */
.wf-page-container { padding: 20px 24px; }
.wf-breadcrumb-row { font-size: 10.5px; color: #495057; margin-bottom: 8px; }
.wf-detail-title { font-size: 22px; font-weight: 800; color: #000000; }
.wf-detail-meta { display: flex; gap: 8px; align-items: center; margin-top: 6px; font-size: 11px; }
.wf-meta-pill { background: #f1f3f5; padding: 2px 6px; border: 1px solid #000000; border-radius: 2px; color: #000000; font-weight: 700; }
.wf-gallery-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 10px; margin: 16px 0 20px; }
.wf-gallery-main { height: 290px; font-size: 13px; }
.wf-gallery-side { display: grid; grid-template-columns: 1fr 1fr; gap: 6px; }
.wf-gallery-side .wf-img-placeholder { height: 142px; font-size: 10px; }
.wf-detail-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; }
.wf-content-block { margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid #ced4da; }
.wf-block-title { font-size: 14.5px; font-weight: 800; margin-bottom: 8px; color: #000000; }
.wf-block-p { font-size: 11.5px; line-height: 1.6; color: #212529; }
.wf-amenity-item { font-size: 10.5px; padding: 6px; background: #f8f9fa; border: 1px solid #000000; border-radius: 2px; font-weight: 600; }
.wf-policy-box { background: #f8f9fa; border: 1.5px solid #000000; border-radius: 4px; padding: 12px; }
.wf-policy-row { display: flex; gap: 8px; font-size: 11px; margin-bottom: 6px; }
.wf-policy-icon { font-weight: 800; }

/* BOOKING BOX */
.wf-booking-box { position: sticky; top: 16px; border: 2px solid #000000; }
.wf-box-price-row { display: flex; align-items: baseline; gap: 4px; margin-bottom: 10px; }
.wf-price-lg { font-size: 22px; font-weight: 800; color: #000000; }
.wf-unit-lg { font-size: 11px; color: #495057; }
.wf-avail-alert { padding: 6px 10px; border-radius: 2px; font-size: 10.5px; font-weight: 800; margin-bottom: 12px; }
.wf-avail-success { background: #ffffff; color: #000000; border: 1.5px solid #000000; }
.wf-date-picker-box { border: 1.5px solid #000000; border-radius: 2px; overflow: hidden; margin-bottom: 12px; }
.wf-date-row { display: grid; grid-template-columns: 1fr 1fr; border-bottom: 1px solid #000000; }
.wf-date-col { padding: 6px 8px; }
.wf-guest-col { padding: 6px 8px; }
.wf-price-breakdown { font-size: 11px; margin-bottom: 14px; }
.wf-breakdown-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
.wf-total-row { font-size: 13.5px; font-weight: 800; color: #000000; margin-top: 6px; }
.wf-box-guarantee { text-align: center; font-size: 9.5px; color: #495057; margin-top: 8px; }
.wf-divider { height: 1px; background: #000000; margin: 8px 0; }

/* AUTH */
.wf-auth-wrapper { max-width: 900px; margin: 24px auto; padding: 0 16px; }
.wf-auth-box { border: 2px solid #000000; padding: 20px; }
.wf-auth-header { text-align: center; max-width: 480px; margin: 0 auto 18px; }
.wf-auth-logo { font-size: 16px; font-weight: 800; margin-bottom: 4px; border: 1.5px solid #000000; display: inline-block; padding: 4px 10px; }
.wf-auth-title { font-size: 18px; font-weight: 800; }
.wf-auth-sub { font-size: 11px; color: #495057; }
.wf-auth-tabs { display: flex; border-bottom: 2px solid #000000; margin-bottom: 18px; }
.wf-auth-tab { flex: 1; padding: 8px; background: transparent; border: none; font-weight: 800; font-size: 11.5px; cursor: pointer; color: #6c757d; }
.wf-auth-tab.active { color: #000000; border-bottom: 3px solid #000000; }
.wf-auth-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.wf-border-left { border-left: 1.5px solid #000000; padding-left: 20px; }
.wf-form-group { margin-bottom: 10px; }
.wf-input-text { border: 1.5px solid #000000; border-radius: 2px; padding: 6px 10px; font-size: 11.5px; background: #fff; }
.wf-input-password { border: 1.5px solid #000000; border-radius: 2px; padding: 6px 10px; font-size: 11.5px; display: flex; justify-content: space-between; align-items: center; background: #fff; }
.wf-pwd-strength { font-size: 9.5px; color: #495057; margin-top: 3px; display: flex; align-items: center; gap: 4px; }
.wf-pwd-bar { display: inline-block; width: 20px; height: 3px; background: #ced4da; }
.wf-pwd-bar.filled { background: #000000; }
.wf-role-hint { margin-top: 12px; font-size: 9.5px; color: #000000; background: #f8f9fa; padding: 6px; border: 1px dashed #000000; }

/* STEPPER */
.wf-stepper { display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
.wf-step { display: flex; align-items: center; gap: 6px; font-size: 11px; font-weight: 700; color: #6c757d; }
.wf-step-num { width: 18px; height: 18px; border-radius: 50%; background: #ffffff; border: 1.5px solid #000000; color: #000000; display: flex; align-items: center; justify-content: center; font-size: 9.5px; font-weight: 800; }
.wf-step.active { color: #000000; }
.wf-step.active .wf-step-num { background: #000000; color: #ffffff; }
.wf-step.completed .wf-step-num { background: #000000; color: #ffffff; }
.wf-step-line { width: 35px; height: 1.5px; background: #ced4da; margin: 0 8px; }
.wf-step-line.active { background: #000000; }

/* BOOKING FORM */
.wf-booking-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; }
.wf-textarea-mock { border: 1.5px solid #000000; border-radius: 2px; padding: 6px 10px; font-size: 10.5px; height: 50px; color: #495057; }
.wf-mini-room { display: flex; gap: 10px; align-items: center; margin: 10px 0; }
.wf-stay-dates { display: flex; align-items: center; justify-content: space-between; font-size: 10.5px; margin: 8px 0; }
.wf-summary-pricing { font-size: 10.5px; }
.wf-summary-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
.wf-price-large { font-size: 16px; color: #000000; font-weight: 800; }
.wf-summary-lock { font-size: 9.5px; color: #495057; text-align: center; margin-top: 8px; border: 1px dashed #6c757d; padding: 4px; }

/* PAY MIDTRANS */
.wf-pay-header-banner { background: #ffffff; border: 2px solid #000000; border-radius: 4px; padding: 12px 18px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
.wf-pay-timer-digits { font-size: 18px; font-weight: 800; color: #000000; }
.wf-pay-status-pill { font-size: 9.5px; font-weight: 800; background: #000000; color: #ffffff; padding: 3px 8px; border-radius: 2px; }
.wf-pay-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.wf-booking-code-box { background: #f8f9fa; border: 1.5px dashed #000000; padding: 8px; border-radius: 2px; text-align: center; margin: 10px 0; }
.wf-code-val { font-size: 15px; font-weight: 800; letter-spacing: 0.5px; color: #000000; }
.wf-pay-table { width: 100%; font-size: 11.5px; border-collapse: collapse; margin-bottom: 14px; }
.wf-pay-table td { padding: 5px 0; border-bottom: 1px solid #ced4da; }
.wf-pay-total { font-size: 15px; color: #000000; }

/* SNAP SIMULATION (HITAM PUTIH) */
.wf-snap-modal-frame { border: 2px solid #000000; border-radius: 4px; background: #fff; overflow: hidden; }
.wf-snap-header { background: #000000; color: #fff; padding: 12px 16px; display: flex; justify-content: space-between; align-items: center; }
.wf-snap-brand { font-weight: 800; font-size: 12px; }
.wf-snap-body { padding: 14px; }
.wf-snap-option { border: 1.5px solid #000000; border-radius: 4px; padding: 10px; margin-bottom: 8px; cursor: pointer; }
.wf-snap-option.active { background: #f1f3f5; }
.wf-snap-opt-head { display: flex; justify-content: space-between; align-items: center; font-size: 11.5px; }
.wf-snap-badge-popular { background: #000000; color: #ffffff; font-size: 8.5px; font-weight: 800; padding: 1px 5px; border-radius: 2px; }
.wf-qris-area { margin-top: 10px; display: flex; gap: 14px; align-items: center; }
.wf-qris-qr-mock { width: 120px; height: 120px; border: 2px dashed #000000; background: #fff; display: flex; align-items: center; justify-content: center; font-size: 8.5px; font-weight: 800; position: relative; }
.wf-qris-instructions ol { padding-left: 14px; font-size: 9.5px; line-height: 1.5; color: #212529; }

/* TICKET (HITAM PUTIH RESMI) */
.wf-success-banner { background: #ffffff; border: 2px solid #000000; border-radius: 4px; padding: 14px 18px; margin-bottom: 20px; }
.wf-success-title { font-size: 14px; font-weight: 800; color: #000000; }
.wf-ticket-wrapper { max-width: 800px; margin: 0 auto; }
.wf-ticket-card { border: 2px solid #000000; border-radius: 4px; overflow: hidden; padding: 0; }
.wf-ticket-header { background: #ffffff; color: #000000; padding: 14px 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #000000; }
.wf-ticket-logo { font-size: 14px; font-weight: 800; }
.wf-ticket-body { padding: 20px; }
.wf-ticket-grid { display: grid; grid-template-columns: 220px 1fr; gap: 20px; }
.wf-ticket-qr-box { width: 160px; height: 160px; border: 2px dashed #000000; margin: 0 auto 8px; display: flex; align-items: center; justify-content: center; font-size: 9.5px; font-weight: 800; background: #f8f9fa; }
.wf-ticket-code-big { font-size: 15px; font-weight: 800; text-align: center; color: #000000; }
.wf-ticket-qr-note { font-size: 9px; color: #495057; text-align: center; margin-top: 4px; }
.wf-ticket-val-large { font-size: 14px; font-weight: 800; }
.wf-ticket-payment-row { display: flex; justify-content: space-between; align-items: center; background: #f8f9fa; padding: 8px; border: 1px solid #000000; border-radius: 2px; }
.wf-ticket-price { font-size: 15px; font-weight: 800; color: #000000; }
.wf-ticket-footer { background: #f8f9fa; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; border-top: 1.5px solid #000000; }

/* DASHBOARD TAMU */
.wf-dash-user-card { background: #ffffff; color: #000000; padding: 20px; border: 2px solid #000000; border-radius: 4px; margin-bottom: 16px; }
.wf-dash-avatar-row { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
.wf-avatar-circle { width: 44px; height: 44px; border-radius: 50%; background: #ffffff; border: 2px solid #000000; color: #000000; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 15px; }
.wf-dash-name { font-size: 16px; font-weight: 800; color: #000000; }
.wf-dash-info { font-size: 10.5px; color: #495057; }
.wf-stat-card { background: #f8f9fa; padding: 10px; border: 1.5px solid #000000; border-radius: 2px; text-align: center; }
.wf-stat-num { font-size: 16px; font-weight: 800; color: #000000; display: block; }
.wf-stat-lbl { font-size: 9.5px; color: #495057; }
.wf-dash-tabs { display: flex; gap: 8px; border-bottom: 2px solid #000000; margin-bottom: 14px; }
.wf-dash-tab { padding: 6px 12px; background: transparent; border: none; font-size: 11.5px; font-weight: 700; cursor: pointer; color: #6c757d; }
.wf-dash-tab.active { color: #000000; border-bottom: 3px solid #000000; }
.wf-res-item { padding: 14px; }
.wf-border-bold { border: 2px solid #000000; }
.wf-res-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 1px solid #000000; }
.wf-code-badge { font-weight: 800; font-size: 11.5px; margin-right: 6px; }
.wf-res-body { display: flex; gap: 14px; align-items: center; }
.wf-res-details { flex: 1; }
.wf-res-title { font-size: 13px; font-weight: 800; margin-bottom: 3px; color: #000000; }

/* ADMIN LAYOUT (HITAM PUTIH) */
.wf-admin-layout { display: grid; grid-template-columns: 220px 1fr; min-height: 100%; border: 2px solid #000000; }
.wf-admin-sidebar { background: #ffffff; color: #000000; padding: 16px 12px; border-right: 2px solid #000000; }
.wf-admin-brand { margin-bottom: 18px; padding-bottom: 10px; border-bottom: 1.5px solid #000000; }
.wf-brand-logo { font-size: 15px; font-weight: 800; color: #000000; }
.wf-brand-sub { font-size: 9.5px; color: #495057; }
.wf-menu-section { font-size: 9px; font-weight: 800; letter-spacing: 0.5px; color: #000000; margin-bottom: 6px; text-transform: uppercase; }
.wf-menu-item { padding: 6px 8px; border: 1px solid transparent; border-radius: 2px; font-size: 11px; font-weight: 700; cursor: pointer; margin-bottom: 3px; display: flex; justify-content: space-between; align-items: center; }
.wf-menu-item.active { background: #000000; color: #ffffff; }
.wf-badge-count { background: #ffffff; color: #000000; border: 1px solid #000000; font-size: 9px; padding: 1px 5px; border-radius: 10px; font-weight: 800; }
.wf-admin-topbar { background: #f8f9fa; border-bottom: 2px solid #000000; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
.wf-admin-body { padding: 20px; background: #ffffff; }
.wf-kpi-card { display: flex; gap: 10px; align-items: center; }
.wf-kpi-val { font-size: 16px; font-weight: 800; color: #000000; display: block; }
.wf-kpi-growth { font-size: 9.5px; color: #000000; font-weight: 700; }
.wf-admin-row-2 { display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 14px; }
.wf-chart-container { height: 150px; display: flex; align-items: flex-end; padding-top: 16px; }
.wf-chart-bars { display: flex; justify-content: space-around; width: 100%; height: 100%; align-items: flex-end; border-bottom: 1.5px solid #000000; }
.wf-bar-col { display: flex; flex-direction: column; align-items: center; gap: 4px; font-size: 9.5px; }
.wf-bar { width: 30px; background: #ced4da; border: 1px solid #000000; border-radius: 2px 2px 0 0; }
.wf-bar.active { background: #000000; }
.wf-rooms-status-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 6px; margin-top: 8px; }
.wf-room-dot-card { padding: 6px; border-radius: 2px; text-align: center; font-size: 9.5px; border: 1px solid #000000; }
.wf-room-dot-card.occupied { background: #f1f3f5; color: #000000; font-weight: 700; }
.wf-room-dot-card.available { background: #ffffff; color: #000000; }
.wf-room-dot-card.cleaning { background: #e9ecef; color: #000000; }

/* DATA TABLES (HITAM PUTIH MURNI) */
.wf-data-table { width: 100%; border-collapse: collapse; font-size: 11px; }
.wf-data-table th { background: #f1f3f5; text-align: left; padding: 8px; border-bottom: 2px solid #000000; font-weight: 800; color: #000000; border-top: 1px solid #000000; }
.wf-data-table td { padding: 8px; border-bottom: 1px solid #000000; vertical-align: middle; }
.wf-grand-total-row td { background: #f8f9fa; font-weight: 800; border-top: 2px solid #000000; border-bottom: 2px solid #000000; font-size: 12px; }
.wf-total-income { color: #000000; font-size: 14px; font-weight: 800; }

/* MODAL MOCK */
.wf-modal-mock-card { border: 2px solid #000000; background: #ffffff; }
.wf-modal-head { display: flex; justify-content: space-between; align-items: center; padding-bottom: 8px; border-bottom: 1.5px solid #000000; }
.wf-modal-foot { display: flex; justify-content: flex-end; gap: 8px; margin-top: 14px; padding-top: 10px; border-top: 1px solid #000000; }
.wf-upload-dropzone { border: 2px dashed #000000; border-radius: 4px; padding: 16px; text-align: center; font-size: 10.5px; color: #000000; background: #f8f9fa; }
.wf-pill-btn { padding: 5px 10px; border-radius: 2px; border: 1.5px solid #000000; background: #fff; font-size: 10.5px; font-weight: 700; cursor: pointer; color: #000000; }
.wf-pill-btn.active { background: #000000; color: #fff; }

/* MOBILE SCREEN */
.wf-mobile-screen {
  width: 375px;
  min-height: 580px;
  background: #ffffff;
  border: 10px solid #000000;
  border-radius: 28px;
  margin: 0 auto;
  overflow: hidden;
  font-size: 11px;
}
.wf-m-header { background: #000000; color: #fff; padding: 10px 14px; display: flex; justify-content: space-between; align-items: center; }
.wf-m-brand { font-weight: 800; font-size: 11px; }
.wf-m-body { padding: 12px; }
.wf-m-hero { background: #f8f9fa; color: #000; border-bottom: 1px solid #000; padding: 16px 12px; text-align: center; }
.wf-m-title { font-size: 15px; font-weight: 800; margin: 3px 0; }
.wf-m-sub { color: #495057; font-size: 9.5px; }
.wf-m-search { padding: 10px; background: #ffffff; border-bottom: 1px solid #000000; }
.wf-m-input { padding: 6px; background: #fff; border: 1px solid #000000; border-radius: 2px; font-size: 9.5px; margin-bottom: 5px; font-weight: 600; }
.wf-m-room { margin-bottom: 10px; padding: 8px; border: 1.5px solid #000000; }
.wf-report-signature-block { display: flex; justify-content: space-between; padding: 18px 8px 8px; margin-top: 12px; border-top: 1px dashed #000000; font-size: 10.5px; }
.wf-signature-line { margin-top: 40px; border-top: 1px solid #000000; padding-top: 4px; display: inline-block; font-weight: 700; }
CSS;

foreach ($wireframes as $wf) {
    $htmlContent = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{$wf['code']} - {$wf['title']}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    {$cssCommon}
  </style>
</head>
<body>
  {$wf['desktop_html']}
</body>
</html>
HTML;

    file_put_contents($tempDir . '/' . $wf['id'] . '.html', $htmlContent);
}

echo "Berhasil membuat file temp HTML hitam putih untuk seluruh 12 wireframe.\n";

// ============================================================================
// 2. MASTER VIEWER public/wireframes/index.html (HITAM PUTIH MURNI)
// ============================================================================

$cardsHtml = '';
foreach ($wireframes as $wf) {
    $annotListHtml = '';
    foreach ($wf['annotations'] as $ann) {
        $annotListHtml .= <<<ANN
        <div class="annot-item">
          <div class="annot-num">{$ann['num']}</div>
          <div class="annot-content">
            <div class="annot-title">{$ann['title']}</div>
            <div class="annot-desc">{$ann['desc']}</div>
          </div>
        </div>
ANN;
    }

    $cardsHtml .= <<<CARD
    <div class="wireframe-card" data-category="{$wf['category']}" id="card-{$wf['id']}">
      <div class="card-top">
        <div class="card-meta">
          <span class="wf-code-pill">{$wf['code']}</span>
          <span class="wf-role-badge">Aktor: {$wf['actor']}</span>
          <span class="wf-route-pill">Route: <code>{$wf['route']}</code></span>
          <span class="wf-uc-pill">{$wf['usecase']}</span>
        </div>
        <h2 class="card-heading">{$wf['title']}</h2>
        <p class="card-subheading">{$wf['subtitle']}</p>
      </div>

      <!-- CONTROL BAR PER CARD -->
      <div class="card-toolbar">
        <div class="view-toggles">
          <button class="toggle-btn active" onclick="switchCardView('{$wf['id']}', 'desktop', this)">[Desktop]</button>
          <button class="toggle-btn" onclick="switchCardView('{$wf['id']}', 'mobile', this)">[Mobile]</button>
          <button class="toggle-btn" onclick="switchCardView('{$wf['id']}', 'spec', this)">[Spesifikasi]</button>
        </div>
        <div class="card-actions">
          <button class="action-btn" onclick="toggleAnnotations('{$wf['id']}', this)">Toggle Anotasi</button>
          <button class="action-btn primary" onclick="printSingleWireframe('card-{$wf['id']}')">Cetak Layar</button>
        </div>
      </div>

      <!-- CONTENT PANES -->
      <div class="card-viewport">
        <!-- DESKTOP PANE -->
        <div class="pane pane-desktop active" id="pane-desktop-{$wf['id']}">
          {$wf['desktop_html']}
        </div>

        <!-- MOBILE PANE -->
        <div class="pane pane-mobile" id="pane-mobile-{$wf['id']}">
          {$wf['mobile_html']}
        </div>

        <!-- SPECIFICATION PANE -->
        <div class="pane pane-spec" id="pane-spec-{$wf['id']}">
          <div class="spec-sheet">
            <h3 class="spec-heading">Spesifikasi Detail Antarmuka: {$wf['code']}</h3>
            <table class="spec-meta-table">
              <tr><th>Kode Wireframe</th><td><strong>{$wf['code']}</strong></td></tr>
              <tr><th>Nama Layar</th><td>{$wf['title']}</td></tr>
              <tr><th>Aktor Utama</th><td>{$wf['actor']}</td></tr>
              <tr><th>URL Route Laravel</th><td><code>{$wf['route']}</code></td></tr>
              <tr><th>Skenario Use Case</th><td>{$wf['usecase']}</td></tr>
              <tr><th>Tujuan Layar</th><td>{$wf['subtitle']}</td></tr>
            </table>

            <h4 class="spec-subheading">Anotasi Elemen dan Interaksi Komponen:</h4>
            <div class="annot-list">
              {$annotListHtml}
            </div>
          </div>
        </div>
      </div>

      <!-- ANNOTATIONS ACCORDION -->
      <div class="card-annotations-tray" id="tray-{$wf['id']}">
        <div class="tray-header">
          <strong>Anotasi Komponen UI Layar Ini:</strong>
          <small>Nomor lingkaran hitam pada desain di atas merujuk ke tabel penjelasan berikut:</small>
        </div>
        <div class="annot-grid">
          {$annotListHtml}
        </div>
      </div>
    </div>
CARD;
}

$indexHtml = <<<HTML
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Wireframe Hitam Putih - Reservasi Rama Homestay</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
  <style>
    {$cssCommon}

    /* MASTER VIEWER APP STYLING (HITAM PUTIH MURNI) */
    body {
      background: #f1f3f5;
      color: #000000;
      padding: 0;
      margin: 0;
      font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    }

    /* TOP MASTER HEADER */
    .master-header {
      background: #000000;
      color: #ffffff;
      padding: 20px 30px;
      border-bottom: 2px solid #000000;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .header-top-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1300px;
      margin: 0 auto;
    }

    .brand-area {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .header-badge {
      background: #ffffff;
      color: #000000;
      border: 1px solid #ffffff;
      padding: 3px 8px;
      border-radius: 2px;
      font-size: 10px;
      font-weight: 800;
      letter-spacing: 0.5px;
    }

    .header-title {
      font-size: 18px;
      font-weight: 800;
      color: #ffffff;
      margin: 2px 0 0;
    }

    .header-sub {
      font-size: 11px;
      color: #ced4da;
    }

    .header-links {
      display: flex;
      gap: 10px;
    }

    /* FILTER & SEARCH BAR */
    .filter-master-bar {
      max-width: 1300px;
      margin: 14px auto 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 14px;
      border-top: 1px solid #343a40;
      padding-top: 12px;
    }

    .filter-pills-group {
      display: flex;
      gap: 8px;
    }

    .master-pill-btn {
      background: #212529;
      color: #ced4da;
      border: 1px solid #495057;
      padding: 5px 12px;
      border-radius: 2px;
      font-size: 11px;
      font-weight: 700;
      cursor: pointer;
    }

    .master-pill-btn.active {
      background: #ffffff;
      color: #000000;
      border-color: #ffffff;
    }

    .search-input-master {
      background: #212529;
      border: 1px solid #495057;
      color: #ffffff;
      padding: 5px 12px;
      border-radius: 2px;
      font-size: 11px;
      width: 280px;
      outline: none;
    }

    .search-input-master:focus {
      border-color: #ffffff;
    }

    /* MAIN CONTAINER */
    .catalog-container {
      max-width: 1300px;
      margin: 24px auto;
      padding: 0 20px;
    }

    /* CARD STYLING */
    .wireframe-card {
      background: #ffffff;
      border-radius: 4px;
      margin-bottom: 30px;
      overflow: hidden;
      border: 2px solid #000000;
    }

    .card-top {
      padding: 16px 20px 12px;
      background: #f8f9fa;
      border-bottom: 1.5px solid #000000;
    }

    .card-meta {
      display: flex;
      gap: 8px;
      align-items: center;
      margin-bottom: 6px;
      flex-wrap: wrap;
    }

    .wf-code-pill {
      background: #000000;
      color: #ffffff;
      font-weight: 800;
      font-size: 10.5px;
      padding: 2px 6px;
      border-radius: 2px;
    }

    .wf-role-badge {
      font-size: 10px;
      font-weight: 800;
      padding: 2px 6px;
      border-radius: 2px;
      background: #ffffff;
      color: #000000;
      border: 1px solid #000000;
    }

    .wf-route-pill {
      font-size: 10px;
      background: #ffffff;
      color: #000000;
      padding: 2px 6px;
      border-radius: 2px;
      border: 1px solid #000000;
    }
    .wf-route-pill code { font-family: 'JetBrains Mono', monospace; font-weight: 600; }

    .wf-uc-pill {
      font-size: 10px;
      background: #f8f9fa;
      color: #000000;
      padding: 2px 6px;
      border-radius: 2px;
      border: 1px solid #000000;
      font-weight: 600;
    }

    .card-heading {
      font-size: 16px;
      font-weight: 800;
      color: #000000;
      margin: 4px 0 2px;
    }

    .card-subheading {
      font-size: 11.5px;
      color: #495057;
    }

    /* CARD TOOLBAR */
    .card-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 20px;
      background: #ffffff;
      border-bottom: 1.5px solid #000000;
    }

    .view-toggles {
      display: flex;
      gap: 6px;
    }

    .toggle-btn {
      padding: 5px 10px;
      border: 1.5px solid #000000;
      background: #ffffff;
      color: #000000;
      font-size: 10.5px;
      font-weight: 700;
      border-radius: 2px;
      cursor: pointer;
    }

    .toggle-btn.active {
      background: #000000;
      color: #ffffff;
      border-color: #000000;
    }

    .card-actions {
      display: flex;
      gap: 8px;
    }

    .action-btn {
      padding: 5px 10px;
      font-size: 10.5px;
      font-weight: 700;
      border-radius: 2px;
      cursor: pointer;
      border: 1.5px solid #000000;
      background: #ffffff;
      color: #000000;
    }
    .action-btn.primary {
      background: #000000;
      color: #ffffff;
      border-color: #000000;
    }

    /* CARD VIEWPORT & PANES */
    .card-viewport {
      padding: 20px;
      background: #e9ecef;
    }

    .pane { display: none; }
    .pane.active { display: block; }

    /* SPEC SHEET */
    .spec-sheet {
      background: #ffffff;
      border: 2px solid #000000;
      border-radius: 2px;
      padding: 20px;
    }

    .spec-heading {
      font-size: 15px;
      font-weight: 800;
      margin-bottom: 12px;
      color: #000000;
    }

    .spec-meta-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 11.5px;
      margin-bottom: 18px;
    }
    .spec-meta-table th {
      width: 180px;
      background: #f1f3f5;
      padding: 7px 10px;
      text-align: left;
      border: 1px solid #000000;
      font-weight: 800;
      color: #000000;
    }
    .spec-meta-table td {
      padding: 7px 10px;
      border: 1px solid #000000;
    }

    .spec-subheading {
      font-size: 13px;
      font-weight: 800;
      margin: 14px 0 8px;
      color: #000000;
    }

    /* ANNOTATION LIST */
    .annot-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .annot-item {
      display: flex;
      gap: 10px;
      background: #ffffff;
      border: 1px solid #000000;
      border-radius: 2px;
      padding: 8px 10px;
    }

    .annot-num {
      width: 20px;
      height: 20px;
      background: #000000;
      color: #ffffff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 800;
      font-size: 10px;
      flex-shrink: 0;
    }

    .annot-title {
      font-weight: 800;
      font-size: 11px;
      color: #000000;
      margin-bottom: 2px;
    }

    .annot-desc {
      font-size: 10px;
      color: #495057;
      line-height: 1.4;
    }

    /* ANNOTATION TRAY AT CARD BOTTOM */
    .card-annotations-tray {
      background: #ffffff;
      border-top: 1.5px solid #000000;
      padding: 14px 20px;
    }

    .tray-header {
      margin-bottom: 10px;
      font-size: 11.5px;
    }
    .tray-header small {
      color: #495057;
      margin-left: 6px;
    }

    /* TOAST */
    .toast-msg {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #000000;
      color: #ffffff;
      padding: 10px 16px;
      border-radius: 4px;
      font-size: 11.5px;
      font-weight: 700;
      display: none;
      z-index: 9999;
    }

    /* PRINT STYLING */
    @media print {
      body { background: #fff; color: #000; }
      .master-header, .card-toolbar, .action-btn, .view-toggles { display: none !important; }
      .wireframe-card { border: 1.5px solid #000; margin-bottom: 24px; page-break-after: always; }
      .card-viewport { background: #fff; padding: 0; }
      .wf-screen { border: 1.5px solid #000; }
    }
  </style>
</head>
<body>

  <!-- MASTER TOP HEADER -->
  <header class="master-header">
    <div class="header-top-row">
      <div class="brand-area">
        <span class="header-badge">SISTEM RESERVASI RAMA HOMESTAY</span>
        <div>
          <h1 class="header-title">Katalog Wireframe Antarmuka Sistem (Hitam Putih)</h1>
          <div class="header-sub">12 Blueprint Desain Wireframe Resmi Standar Low-Fidelity Tanpa Ikon / Emotikon</div>
        </div>
      </div>
      <div class="header-links">
        <a href="/diagrams/index.html" class="action-btn" style="text-decoration:none;">Katalog Diagram UML</a>
        <a href="/" class="action-btn" style="text-decoration:none;">Halaman Utama Web</a>
        <button class="action-btn primary" onclick="window.print()">Cetak Semua Wireframe (PDF)</button>
      </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-master-bar">
      <div class="filter-pills-group">
        <button class="master-pill-btn active" onclick="filterCatalog('all', this)">Semua Wireframe (12)</button>
        <button class="master-pill-btn" onclick="filterCatalog('tamu', this)">Antarmuka Tamu / Publik (WF-01 - WF-08)</button>
        <button class="master-pill-btn" onclick="filterCatalog('admin', this)">Panel Administrator (WF-09 - WF-12)</button>
      </div>
      <div>
        <input type="text" class="search-input-master" placeholder="Pencarian wireframe (judul, route, kode)..." onkeyup="searchCards(this.value)">
      </div>
    </div>
  </header>

  <!-- MAIN CATALOG -->
  <main class="catalog-container" id="catalogContainer">
    {$cardsHtml}
  </main>

  <div class="toast-msg" id="toastMsg">Berhasil!</div>

  <script>
    // FILTER ROLE
    function filterCatalog(category, btn) {
      document.querySelectorAll('.master-pill-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const cards = document.querySelectorAll('.wireframe-card');
      cards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // SEARCH
    function searchCards(query) {
      const q = query.toLowerCase().trim();
      const cards = document.querySelectorAll('.wireframe-card');
      cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(q)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }

    // SWITCH CARD VIEW (DESKTOP / MOBILE / SPEC)
    function switchCardView(id, mode, btn) {
      const card = document.getElementById('card-' + id);
      card.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      card.querySelectorAll('.pane').forEach(p => p.classList.remove('active'));
      const targetPane = document.getElementById('pane-' + mode + '-' + id);
      if (targetPane) {
        targetPane.classList.add('active');
      }
    }

    // TOGGLE ANNOTATIONS TRAY & BADGES
    function toggleAnnotations(id, btn) {
      const card = document.getElementById('card-' + id);
      const tray = document.getElementById('tray-' + id);
      const badges = card.querySelectorAll('.wf-callout-badge');

      if (tray.style.display === 'none') {
        tray.style.display = 'block';
        badges.forEach(b => b.style.display = 'inline-flex');
        btn.textContent = 'Sembunyikan Anotasi';
      } else {
        tray.style.display = 'none';
        badges.forEach(b => b.style.display = 'none');
        btn.textContent = 'Tampilkan Anotasi';
      }
    }

    // PRINT SINGLE WIREFRAME
    function printSingleWireframe(cardId) {
      const card = document.getElementById(cardId);
      const prevDisplay = [];
      const allCards = document.querySelectorAll('.wireframe-card');

      allCards.forEach(c => {
        prevDisplay.push(c.style.display);
        if (c.id !== cardId) {
          c.style.display = 'none';
        } else {
          c.style.display = 'block';
        }
      });

      window.print();

      allCards.forEach((c, idx) => {
        c.style.display = prevDisplay[idx];
      });
    }

    function showToast(msg) {
      const t = document.getElementById('toastMsg');
      t.textContent = msg;
      t.style.display = 'block';
      setTimeout(() => { t.style.display = 'none'; }, 3000);
    }
  </script>
</body>
</html>
HTML;

file_put_contents(__DIR__ . '/public/wireframes/index.html', $indexHtml);
echo "Berhasil menulis file public/wireframes/index.html dalam format Hitam Putih murni tanpa icon/emotikon!\n";

// ============================================================================
// 3. RENDER PNG SNAPSHOTS MENGGUNAKAN HEADLESS EDGE
// ============================================================================

$targetId = $argv[1] ?? null;
foreach ($wireframes as $index => $wf) {
    if ($targetId && $wf['id'] !== $targetId) {
        continue;
    }
    $num = $index + 1;
    $id = $wf['id'];
    $tempHtmlFile = $tempDir . '/' . $id . '.html';
    $pngOutputFile = $outputDir . '/' . $id . '.png';
    $fileUrl = 'file:///' . str_replace('\\', '/', $tempHtmlFile);

    echo "[$num/" . count($wireframes) . "] Merender PNG wireframe hitam-putih: $id ...\n";
    $cmd = sprintf(
        '"%s" --headless --force-device-scale-factor=2 --window-size=%d,%d --virtual-time-budget=6000 --screenshot="%s" "%s"',
        $edgePath,
        $wf['width'] + 60,
        $wf['height'] + 80,
        $pngOutputFile,
        $fileUrl
    );
    exec($cmd);
}

echo "\nSemua proses pembuatan wireframe hitam putih selesai sempurna tanpa error!\n";

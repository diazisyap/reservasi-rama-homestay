@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<style>
    /* Homestay Info Hero Banner - Matched to Dashboard Theme */
    .homestay-info-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #ffffff;
        padding: 65px 0 60px;
        position: relative;
        overflow: hidden;
        border-bottom: 1px solid #1e293b;
    }
    .homestay-info-hero::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 340px;
        height: 340px;
        background: radial-gradient(circle, rgba(245,166,35,0.12) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .homestay-badge-top {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(245, 166, 35, 0.15);
        color: var(--primary);
        padding: 7px 16px;
        border-radius: 30px;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 16px;
        border: 1px solid rgba(245, 166, 35, 0.3);
    }
    .homestay-hero-title {
        font-family: 'Times New Roman', Times, serif;
        font-size: 2.8rem;
        color: #ffffff;
        font-weight: normal;
        margin: 0 0 14px 0;
        line-height: 1.2;
    }
    .homestay-hero-lead {
        color: #cbd5e1;
        font-size: 1.05rem;
        line-height: 1.7;
        margin: 0;
        max-width: 820px;
    }

    /* Stats Bar */
    .stats-bar { background:#fff; border-bottom:1px solid #e2e8f0; padding:28px 0; box-shadow:0 4px 20px rgba(15,23,42,0.04); }
    .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:0; }
    .stat-item { text-align:center; padding:10px 20px; border-right:1px solid #e2e8f0; }
    .stat-item:last-child { border-right:none; }
    .stat-number { font-size:2.2rem; font-weight:800; color:var(--primary); line-height:1; margin-bottom:4px; }
    .stat-label { font-size:0.8rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:1px; }

    /* CTA Section */
    .cta-section { background:linear-gradient(135deg,#1e293b 0%,#0f172a 100%); padding:85px 0; text-align:center; position:relative; overflow:hidden; }
    .cta-section::before { content:''; position:absolute; top:-60px; right:-60px; width:300px; height:300px; background:rgba(245,166,35,0.06); border-radius:50%; }
    .cta-section::after { content:''; position:absolute; bottom:-80px; left:-40px; width:250px; height:250px; background:rgba(245,166,35,0.04); border-radius:50%; }
    .cta-inner { position:relative; z-index:1; }

    .cta-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--primary);
        color: #111827 !important;
        font-weight: 800;
        font-size: 1.02rem;
        padding: 15px 36px;
        border-radius: 40px;
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 8px 24px rgba(245, 166, 35, 0.4);
        border: none;
        cursor: pointer;
    }
    .cta-btn-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(245, 166, 35, 0.55);
        color: #000000 !important;
    }
    .cta-btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.02rem;
        padding: 14px 34px;
        border-radius: 40px;
        border: 2px solid rgba(255, 255, 255, 0.5);
        text-decoration: none !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        backdrop-filter: blur(8px);
    }
    .cta-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.22);
        border-color: #ffffff;
        color: #ffffff !important;
        transform: translateY(-3px);
    }

    /* Section Badge & Headings */
    .section-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(245, 166, 35, 0.12);
        color: #d97706;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
        border: 1px solid rgba(245, 166, 35, 0.25);
    }
    .section-badge-pill i {
        width: 14px;
        height: 14px;
    }
    .section-heading-serif {
        font-family: 'Times New Roman', Times, serif;
        font-size: 2.5rem;
        color: #0f172a;
        font-weight: normal;
        line-height: 1.25;
        margin: 0 0 16px 0;
    }
    .section-lead-text {
        font-size: 1.05rem;
        color: #475569;
        line-height: 1.7;
        margin: 0;
    }

    /* Tentang Rama Homestay Section */
    .about-homestay-section {
        padding: 90px 0;
        background: #ffffff;
    }
    .about-grid {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 60px;
        align-items: center;
    }
    .about-features-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
        margin-top: 32px;
    }
    .about-feature-card {
        display: flex;
        align-items: flex-start;
        gap: 18px;
        padding: 20px 22px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .about-feature-card:hover {
        background: #ffffff;
        border-color: rgba(245, 166, 35, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.05);
    }
    .feature-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(245,166,35,0.2) 0%, rgba(245,166,35,0.08) 100%);
        color: var(--primary-hover);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .feature-icon-box i {
        width: 24px;
        height: 24px;
    }
    .feature-content h4 {
        margin: 0 0 6px 0;
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
    }
    .feature-content p {
        margin: 0;
        font-size: 0.92rem;
        color: #64748b;
        line-height: 1.6;
    }
    .about-image-wrapper {
        position: relative;
    }
    .about-main-img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12);
        display: block;
    }
    .about-floating-card-top {
        position: absolute;
        top: 25px;
        right: -20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        padding: 14px 20px;
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
        border: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .about-floating-card-bottom {
        position: absolute;
        bottom: -25px;
        left: -20px;
        background: #0f172a;
        color: #ffffff;
        padding: 22px 28px;
        border-radius: 20px;
        box-shadow: 0 16px 36px rgba(15, 23, 42, 0.2);
        border: 1px solid rgba(245, 166, 35, 0.3);
    }
    .about-floating-card-bottom .exp-num {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        margin-bottom: 4px;
    }
    .about-floating-card-bottom .exp-txt {
        font-size: 0.82rem;
        font-weight: 600;
        color: #cbd5e1;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width:992px) {
        .stats-grid { grid-template-columns:repeat(2,1fr); }
        .stat-item:nth-child(2) { border-right:none; }
        .stat-item:nth-child(3) { border-right:1px solid #e2e8f0; border-top:1px solid #e2e8f0; }
        .stat-item:nth-child(4) { border-top:1px solid #e2e8f0; border-right:none; }
        .about-grid { grid-template-columns: 1fr; gap: 40px; }
        .about-main-img { height: 360px; }
        .about-floating-card-bottom { position: static; margin-top: 15px; }
    }
    @media (max-width:640px) {
        .homestay-hero-title { font-size: 2rem; }
        .section-heading-serif { font-size: 2rem; }
        .stats-grid { grid-template-columns:repeat(2,1fr); }
        .cta-section { padding:50px 0; }
    }
</style>

<!-- Banner Header Informasi Homestay - Warna Selaras dengan Dashboard -->
<div class="homestay-info-hero">
    <div class="container">
        <span class="homestay-badge-top"><i data-lucide="map-pin"></i> Dekat Titik 0 KM Dieng &bull; Dataran Tinggi Dieng</span>
        <h1 class="homestay-hero-title">Informasi Resmi Rama Homestay</h1>
        <p class="homestay-hero-lead">Selamat datang di Rama Homestay, penginapan ramah dan nyaman berlokasi strategis di dekat Titik 0 KM Dataran Tinggi Dieng. Rasakan kehangatan istirahat seperti di rumah sendiri dengan panorama pegunungan yang asri di tengah sejuknya negeri di atas awan.</p>
    </div>
</div>

<!-- Statistik Homestay -->
<div class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item"><div class="stat-number">6</div><div class="stat-label">Kamar Tersedia</div></div>
            <div class="stat-item"><div class="stat-number">500+</div><div class="stat-label">Tamu Puas</div></div>
            <div class="stat-item"><div class="stat-number">4.9&starf;</div><div class="stat-label">Rating Rata-rata</div></div>
            <div class="stat-item"><div class="stat-number">25+</div><div class="stat-label">Tahun Berpengalaman</div></div>
        </div>
    </div>
</div>

<!-- SECTION: TENTANG RAMA HOMESTAY -->
<section class="about-homestay-section" id="tentang-kami">
    <div class="container">
        <div class="about-grid">
            <div class="about-content">
                <span class="section-badge-pill"><i data-lucide="info"></i> Tentang Rama Homestay</span>
                <h2 class="section-heading-serif">Kehangatan & Kenyamanan Istirahat di Negeri di Atas Awan</h2>
                <p class="section-lead-text">
                    Rama Homestay berlokasi strategis di dekat <strong>Titik 0 KM Dataran Tinggi Dieng</strong>, menjadikannya pilihan penginapan idaman bagi keluarga, pasangan, maupun backpacker. Kami menghadirkan suasana hunian yang bersih, tenang, dan hangat di tengah hawa dingin pegunungan Dieng.
                </p>
                <p style="color: #64748b; font-size: 0.96rem; line-height: 1.7; margin-top: 14px;">
                    Dengan keramahan khas masyarakat lokal dan dedikasi pelayanan sepenuh hati, kami selalu siap menyambut Anda seperti keluarga sendiri agar liburan Anda menjelajahi keindahan alam Dieng berjalan sempurna.
                </p>

                <!-- Keunggulan Pelayanan -->
                <div class="about-features-list">
                    <div class="about-feature-card">
                        <div class="feature-icon-box">
                            <i data-lucide="heart-handshake"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Pelayanan Ramah & Siaga 24 Jam</h4>
                            <p>Staf kami siap melayani check-in fleksibel, informasi rute wisata, dan kebutuhan Anda dengan senyuman tulus.</p>
                        </div>
                    </div>

                    <div class="about-feature-card">
                        <div class="feature-icon-box">
                            <i data-lucide="flame"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Kenyamanan Hangat di Suhu Dingin Dieng</h4>
                            <p>Setiap kamar dilengkapi kasur empuk, selimut tebal, water heater (pemanas air panas) lancar, serta sajian teh dan kopi hangat.</p>
                        </div>
                    </div>

                    <div class="about-feature-card">
                        <div class="feature-icon-box">
                            <i data-lucide="map-pinned"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Lokasi Emas & Titik 0 KM Dieng</h4>
                            <p>Hanya beberapa menit menuju Kompleks Candi Arjuna, Kawah Sikidang, Telaga Warna, serta rute sunrise Bukit Sikunir.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visual Image & Floating Badges -->
            <div class="about-image-wrapper">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="Kenyamanan Kamar Rama Homestay Dieng" 
                     class="about-main-img">
                
                <a href="{{ route('reviews') }}" style="text-decoration:none;color:inherit;">
                    <div class="about-floating-card-top" style="cursor:pointer;transition:transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        <i data-lucide="award" style="color:var(--primary);width:26px;height:26px;"></i>
                        <div>
                            <div style="font-weight:800;font-size:0.95rem;color:#0f172a;">Rating 4.9 &starf;</div>
                            <div style="font-size:0.75rem;color:#64748b;">Lihat Ulasan Tamu &rarr;</div>
                        </div>
                    </div>
                </a>

                <div class="about-floating-card-bottom">
                    <div class="exp-num">25+</div>
                    <div class="exp-txt">Tahun Pengalaman Melayani Tamu Dieng</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="cta-inner">
            <span style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:var(--primary);display:block;margin-bottom:16px;">Reservasi Sekarang</span>
            <h2 style="font-family:'Times New Roman',Times,serif;font-size:2.8rem;color:#fff;font-weight:normal;margin:0 0 18px 0;line-height:1.2;">Siap Menginap di Rama Homestay Dieng?</h2>
            <p style="color:#94a3b8;font-size:1rem;line-height:1.7;margin:0 auto 40px;max-width:540px;">Rasakan kesejukan alam Dataran Tinggi Dieng dan keramahan khas pedesaan di Rama Homestay. Pesan kamar Anda sekarang untuk liburan tak terlupakan.</p>
            <div style="display:flex;gap:18px;justify-content:center;flex-wrap:wrap;align-items:center;">
                @auth
                    @if(auth()->user()->role === 'tamu')
                        <a href="{{ route('rooms.index') }}" class="cta-btn-primary"><i data-lucide="calendar-check" style="width:18px;height:18px;"></i> Lihat Kamar &amp; Pesan</a>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="cta-btn-primary"><i data-lucide="layout-dashboard" style="width:18px;height:18px;"></i> Dashboard Admin</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="cta-btn-primary"><i data-lucide="user-plus" style="width:18px;height:18px;"></i> Daftar &amp; Pesan Sekarang</a>
                    <a href="{{ route('login') }}" class="cta-btn-secondary"><i data-lucide="log-in" style="width:18px;height:18px;"></i> Sudah Punya Akun</a>
                @endauth
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            window.lucide.createIcons();
        }
    });
</script>
@endsection


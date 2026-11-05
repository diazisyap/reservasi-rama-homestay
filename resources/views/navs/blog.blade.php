@extends('layouts.app')

@section('title', 'Artikel Blog - Rama Homestay')

@section('content')
<style>
    .blog-section {
        padding: 45px 0 80px 0;
        background: #f8fafc;
    }
    
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .blog-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.08);
        border-color: rgba(245, 166, 35, 0.3);
    }
    
    .blog-img {
        height: 220px;
        background-size: cover;
        background-position: center;
    }
    
    .blog-details {
        padding: 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .blog-tag {
        background: rgba(245, 166, 35, 0.1);
        color: var(--primary);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 4px 10px;
        border-radius: 12px;
        align-self: flex-start;
        margin-bottom: 15px;
    }
    
    .blog-meta-list {
        display: flex;
        gap: 15px;
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 12px;
        font-weight: 500;
    }
</style>

<section class="blog-section">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Artikel &amp; Panduan</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Blog &amp; Inspirasi Perjalanan</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Temukan tips menarik, panduan mendaki, dan cerita perjalanan terbaik seputar Kaliangkrik.</p>
        </div>
        
        <div class="blog-grid">
            <!-- Blog 1 -->
            <div class="blog-card">
                <div class="blog-img" style="background-image: url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                <div class="blog-details">
                    <span class="blog-tag">Tips & Trik</span>
                    <div class="blog-meta-list">
                        <span>15 Juni 2026</span>
                        <span>•</span>
                        <span>5 Menit Baca</span>
                    </div>
                    <h4 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0; line-height: 1.4;">Tips Mendaki Gunung Sumbing via Kaliangkrik</h4>
                    <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Persiapan fisik, perizinan, perlengkapan yang wajib dibawa, serta estimasi waktu pendakian menuju puncak tertinggi Gunung Sumbing...</p>
                    <a href="{{ route('pages') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px;">Selengkapnya <i data-lucide="arrow-right" style="width:16px; height:16px;"></i></a>
                </div>
            </div>
            
            <!-- Blog 2 -->
            <div class="blog-card">
                <div class="blog-img" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                <div class="blog-details">
                    <span class="blog-tag">Destinasi</span>
                    <div class="blog-meta-list">
                        <span>20 Juni 2026</span>
                        <span>•</span>
                        <span>4 Menit Baca</span>
                    </div>
                    <h4 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0; line-height: 1.4;">Menikmati Pesona Nepal Van Java Kaliangkrik</h4>
                    <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Mengapa desa Butuh Kaliangkrik disebut sebagai Nepal Van Java Indonesia? Ulasan lengkap keunikan tata desa, tiket masuk, dan rute terbaik...</p>
                    <a href="{{ route('pages') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px;">Selengkapnya <i data-lucide="arrow-right" style="width:16px; height:16px;"></i></a>
                </div>
            </div>
            
            <!-- Blog 3 -->
            <div class="blog-card">
                <div class="blog-img" style="background-image: url('https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                <div class="blog-details">
                    <span class="blog-tag">Kuliner</span>
                    <div class="blog-meta-list">
                        <span>28 Juni 2026</span>
                        <span>•</span>
                        <span>6 Menit Baca</span>
                    </div>
                    <h4 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0; line-height: 1.4;">Kuliner Khas Magelang yang Wajib Dicoba</h4>
                    <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Rekomendasi makanan tradisional terlezat, mulai dari Kupat Tahu Magelang, Sop Senerek, hingga Mangut Beong yang menggugah selera...</p>
                    <a href="{{ route('pages') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px;">Selengkapnya <i data-lucide="arrow-right" style="width:16px; height:16px;"></i></a>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection

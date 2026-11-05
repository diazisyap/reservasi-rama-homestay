@extends('layouts.app')

@section('title', 'Paket Tour Wisata - Rama Homestay')

@section('content')
<style>
    .tours-section {
        padding: 45px 0 80px 0;
        background: #f8fafc;
    }
    
    .tours-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .tour-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .tour-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.1);
        border-color: rgba(245, 166, 35, 0.3);
    }
    
    .tour-img {
        height: 240px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .tour-price-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary);
        color: #111;
        font-weight: 800;
        font-size: 1rem;
        padding: 8px 18px;
        border-radius: 30px;
        box-shadow: 0 4px 15px rgba(245, 166, 35, 0.25);
    }
    
    .tour-details {
        padding: 35px 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .tour-inclusion {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
        font-size: 0.88rem;
        color: #475569;
    }
    
    .tour-inclusion li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }
    
    .tour-inclusion i {
        color: #10b981;
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }
</style>

<section class="tours-section">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Paket Perjalanan</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Paket Tour Wisata</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Jelajahi Magelang dan sekitarnya tanpa ribet dengan paket perjalanan terorganisir bersama pemandu berpengalaman.</p>
        </div>
        
        <div class="tours-grid">
            <!-- Tour 1 -->
            <div class="tour-card">
                <div class="tour-img" style="background-image: url('https://images.unsplash.com/photo-1533587837-a281c79a998b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <div class="tour-price-badge">Rp 450K / Mobil</div>
                </div>
                <div class="tour-details">
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 15px 0;">Nepal Van Java Jeep Safari</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px;">Eksplorasi lereng Gunung Sumbing menggunakan Jeep off-road terbuka. Kunjungi Nepal Van Java, kebun kopi lokal, dan Silancur Highland.</p>
                    
                    <ul class="tour-inclusion">
                        <li><i data-lucide="check-circle-2"></i> <span>Jeep Off-Road & Driver</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Bahan Bakar & Tiket Parkir</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Tiket Masuk Nepal Van Java</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Kopi Tubruk & Camilan Gratis</span></li>
                    </ul>
                    
                    <a href="{{ route('contact') }}" class="btn btn-primary" style="border-radius: 12px; margin-top: auto; padding: 14px; text-align: center; width: 100%; color: white; background: var(--primary); text-decoration: none;">Hubungi Admin Tour</a>
                </div>
            </div>
            
            <!-- Tour 2 -->
            <div class="tour-card">
                <div class="tour-img" style="background-image: url('https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <div class="tour-price-badge">Rp 650K / Mobil</div>
                </div>
                <div class="tour-details">
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 15px 0;">Sumbing Sunrise Discovery</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px;">Mulai pukul 04:00 pagi. Saksikan matahari terbit dari ketinggian Silancur Highland, dilanjutkan dengan sarapan lokal khas Kaliangkrik.</p>
                    
                    <ul class="tour-inclusion">
                        <li><i data-lucide="check-circle-2"></i> <span>Antar Jemput Avanza/Xenia</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Air Mineral & Sarapan Hangat</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Tiket Silancur Highland</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Kunjungan Sentra Kerajinan</span></li>
                    </ul>
                    
                    <a href="{{ route('contact') }}" class="btn btn-primary" style="border-radius: 12px; margin-top: auto; padding: 14px; text-align: center; width: 100%; color: white; background: var(--primary); text-decoration: none;">Hubungi Admin Tour</a>
                </div>
            </div>
            
            <!-- Tour 3 -->
            <div class="tour-card">
                <div class="tour-img" style="background-image: url('https://images.unsplash.com/photo-1584810359583-96fc3448beaa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <div class="tour-price-badge">Rp 350K / Pax</div>
                </div>
                <div class="tour-details">
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 15px 0;">Borobudur Heritage Tour</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px;">Mempelajari warisan budaya leluhur di Candi Borobudur dengan didampingi pemandu wisata bersertifikat HPI. Makan siang di restoran tradisional.</p>
                    
                    <ul class="tour-inclusion">
                        <li><i data-lucide="check-circle-2"></i> <span>Transport AC Pulang Pergi</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Tiket Borobudur (Struktur Naik)</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Pemandu Wisata Resmi HPI</span></li>
                        <li><i data-lucide="check-circle-2"></i> <span>Makan Siang & Suvenir</span></li>
                    </ul>
                    
                    <a href="{{ route('contact') }}" class="btn btn-primary" style="border-radius: 12px; margin-top: auto; padding: 14px; text-align: center; width: 100%; color: white; background: var(--primary); text-decoration: none;">Hubungi Admin Tour</a>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Destinasi Terdekat - Rama Homestay')

@section('content')
<style>
    .dest-section {
        padding: 45px 0 80px 0;
        background: #f8fafc;
    }
    
    .dest-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .dest-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .dest-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.1);
        border-color: rgba(245, 166, 35, 0.3);
    }
    
    .dest-img {
        height: 240px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .dest-distance {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: var(--primary);
        color: #111;
        font-size: 0.8rem;
        font-weight: 800;
        padding: 6px 14px;
        border-radius: 20px;
        box-shadow: 0 5px 15px rgba(245, 166, 35, 0.25);
    }
    
    .dest-details {
        padding: 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .dest-meta-list {
        display: flex;
        gap: 15px;
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 15px;
        font-weight: 600;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 15px;
    }
</style>

<section class="dest-section">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Objek Wisata</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Destinasi Terdekat</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Jelajahi keindahan tempat wisata alam dan budaya populer di sekitar homestay kami dengan akses yang mudah.</p>
        </div>
        
        <div class="dest-grid">
            <!-- Destination 1 -->
            <div class="dest-card">
                <div class="dest-img" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <div class="dest-distance">15 Menit</div>
                </div>
                <div class="dest-details">
                    <div class="dest-meta-list">
                        <span><i data-lucide="car" style="width:14px; height:14px; vertical-align:middle; margin-right:4px;"></i> 5 km dari Homestay</span>
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0;">Nepal Van Java (Desa Butuh)</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Desa wisata di lereng Gunung Sumbing yang terkenal dengan rumah-rumah bertumpuk warna-warni menyerupai tata desa di negara Nepal. Spot fotografi terbaik.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="border-radius: 8px;">Dapatkan Rute Maps</a>
                </div>
            </div>
            
            <!-- Destination 2 -->
            <div class="dest-card">
                <div class="dest-img" style="background-image: url('https://images.unsplash.com/photo-1584810359583-96fc3448beaa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <div class="dest-distance">40 Menit</div>
                </div>
                <div class="dest-details">
                    <div class="dest-meta-list">
                        <span><i data-lucide="car" style="width:14px; height:14px; vertical-align:middle; margin-right:4px;"></i> 22 km dari Homestay</span>
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0;">Candi Borobudur</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Monumen Buddha terbesar di dunia dan salah satu Situs Warisan Dunia UNESCO. Nikmati kemegahan sejarah arsitektur kuno dinasti Syailendra.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="border-radius: 8px;">Dapatkan Rute Maps</a>
                </div>
            </div>
            
            <!-- Destination 3 -->
            <div class="dest-card">
                <div class="dest-img" style="background-image: url('https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <div class="dest-distance">20 Menit</div>
                </div>
                <div class="dest-details">
                    <div class="dest-meta-list">
                        <span><i data-lucide="car" style="width:14px; height:14px; vertical-align:middle; margin-right:4px;"></i> 8 km dari Homestay</span>
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0;">Silancur Highland</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Bukit wisata gardu pandang dengan taman bunga yang indah. Tempat terbaik menikmati golden sunrise berlatar belakang Gunung Merapi, Merbabu, dan Andong.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="border-radius: 8px;">Dapatkan Rute Maps</a>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection

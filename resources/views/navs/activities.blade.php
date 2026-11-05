@extends('layouts.app')

@section('title', 'Aktivitas Seru - Rama Homestay')

@section('content')
<style>
    .activity-section {
        padding: 45px 0 80px 0;
        background: #f8fafc;
    }
    
    .activity-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .activity-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .activity-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.1);
        border-color: rgba(245, 166, 35, 0.3);
    }
    
    .activity-img {
        height: 240px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .activity-tag {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(5px);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 5px 12px;
        border-radius: 20px;
    }
    
    .activity-details {
        padding: 30px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .activity-meta-list {
        display: flex;
        gap: 15px;
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 15px;
        font-weight: 600;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 15px;
    }
    
    .activity-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
</style>

<section class="activity-section">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Petualangan &amp; Relaksasi</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Aktivitas &amp; Rekreasi</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Mulai dari petualangan alam hingga relaksasi pedesaan, rasakan pengalaman liburan yang tak terlupakan.</p>
        </div>
        
        <div class="activity-grid">
            <!-- Activity 1 -->
            <div class="activity-card">
                <div class="activity-img" style="background-image: url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <span class="activity-tag">Petualangan</span>
                </div>
                <div class="activity-details">
                    <div class="activity-meta-list">
                        <span class="activity-meta-item"><i data-lucide="clock" style="width:14px; height:14px; color:var(--primary);"></i> 8 Jam</span>
                        <span class="activity-meta-item"><i data-lucide="trending-up" style="width:14px; height:14px; color:var(--primary);"></i> Tinggi</span>
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0;">Hiking Gunung Sumbing</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Nikmati sensasi mendaki salah satu gunung tertinggi di Jawa Tengah bersama porter dan pemandu berlisensi kami. Saksikan pemandangan awan pagi yang menakjubkan.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="border-radius: 8px; width: 100%; text-align: center;">Tanyakan Detail</a>
                </div>
            </div>
            
            <!-- Activity 2 -->
            <div class="activity-card">
                <div class="activity-img" style="background-image: url('https://images.unsplash.com/photo-1517457373958-b7bdd4587205?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <span class="activity-tag">Kuliner</span>
                </div>
                <div class="activity-details">
                    <div class="activity-meta-list">
                        <span class="activity-meta-item"><i data-lucide="clock" style="width:14px; height:14px; color:var(--primary);"></i> 3 Jam</span>
                        <span class="activity-meta-item"><i data-lucide="trending-up" style="width:14px; height:14px; color:var(--primary);"></i> Rendah</span>
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0;">Eksplorasi Kebun Kopi</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Mengunjungi kebun kopi lokal Kaliangkrik. Pelajari proses penanaman, pemetikan buah ceri merah, penyangraian tradisional, hingga cara menyeduh kopi tubruk yang nikmat.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="border-radius: 8px; width: 100%; text-align: center;">Tanyakan Detail</a>
                </div>
            </div>
            
            <!-- Activity 3 -->
            <div class="activity-card">
                <div class="activity-img" style="background-image: url('https://images.unsplash.com/photo-1485965120184-e220f721d03e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <span class="activity-tag">Rekreasi</span>
                </div>
                <div class="activity-details">
                    <div class="activity-meta-list">
                        <span class="activity-meta-item"><i data-lucide="clock" style="width:14px; height:14px; color:var(--primary);"></i> 4 Jam</span>
                        <span class="activity-meta-item"><i data-lucide="trending-up" style="width:14px; height:14px; color:var(--primary);"></i> Sedang</span>
                    </div>
                    <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0;">Sepeda Santai Pedesaan</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Gunakan sepeda gunung kami untuk menyusuri jalan desa Kaliangkrik yang tenang dengan panorama sawah terasering yang eksotis layaknya pedesaan di Nepal.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="border-radius: 8px; width: 100%; text-align: center;">Tanyakan Detail</a>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection

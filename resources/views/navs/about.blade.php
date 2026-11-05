@extends('layouts.app')

@section('title', 'Tentang Kami - Rama Homestay')

@section('content')
<style>
    .about-story-section {
        padding: 45px 0 80px;
        background: #ffffff;
    }
    
    .stats-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 80px 0;
        color: white;
        text-align: center;
    }
    
    .stat-box h3 {
        font-size: 3rem;
        color: var(--primary);
        font-weight: 800;
        margin: 0 0 10px;
        line-height: 1;
    }
    
    .stat-box p {
        color: #94a3b8;
        font-size: 0.95rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
    }
    
    .value-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 40px 30px;
        transition: all 0.3s ease;
    }
    .value-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.04);
        border-color: rgba(245, 166, 35, 0.2);
    }
    
    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.02);
        border: 1px solid #e2e8f0;
        position: relative;
    }
    
    .testimonial-quote {
        font-size: 1.1rem;
        color: #475569;
        font-style: italic;
        line-height: 1.8;
        margin-bottom: 25px;
    }
</style>

<!-- History / Story Section -->
<section class="about-story-section">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Profil &amp; Dedikasi</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Tentang Kami</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Mengenal lebih dekat sejarah, dedikasi, dan komitmen pelayanan hangat Rama Homestay.</p>
        </div>
        <div style="display: grid; grid-template-columns: 1.2fr 1fr; gap: 60px; align-items: center;">
            <div>
                <span style="font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; color: var(--primary); font-weight: 700; display: block; margin-bottom: 12px;">Kisah Kami</span>
                <h3 style="font-family: 'Times New Roman', Times, serif; font-size: 2.6rem; color: #0f172a; line-height: 1.2; font-weight: normal; margin: 0 0 25px 0;">Sejarah Kehangatan & Kenyamanan Sejak 1999</h3>
                
                <p style="font-size: 1.05rem; color: #475569; line-height: 1.8; margin-bottom: 20px;">
                    Didirikan pada tahun 1999 di lereng asri Gunung Sumbing, Rama Homestay bermula dari sebuah rumah kayu sederhana milik keluarga yang sering menyambut para pendaki gunung dan pelancong lokal yang membutuhkan tempat beristirahat hangat.
                </p>
                <p style="font-size: 1.05rem; color: #475569; line-height: 1.8; margin-bottom: 0;">
                    Seiring berjalannya waktu, dedikasi kami untuk memberikan kenyamanan modern tanpa meninggalkan sentuhan keramahan tradisional Jawa membuat homestay kami terus berkembang. Hari ini, kami bangga dapat menawarkan akomodasi berkelas bintang lima yang tetap mempertahankan kehangatan seperti rumah sendiri.
                </p>
            </div>
            
            <div style="position: relative;">
                <div style="width: 100%; height: 450px; border-radius: 24px; background-image: url('https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center; box-shadow: 0 20px 40px rgba(0,0,0,0.08);"></div>
                <div style="position: absolute; bottom: -30px; left: -30px; background: var(--primary); padding: 25px 35px; border-radius: 20px; color: #111; box-shadow: 0 15px 30px rgba(245, 166, 35, 0.3); font-weight: 800;">
                    <span style="font-size: 2rem; display: block; line-height: 1;">27+</span>
                    <span style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">Tahun Pengalaman</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter Grid -->
<section class="stats-section">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
            <div class="stat-box">
                <h3>10+</h3>
                <p>Kamar Pilihan</p>
            </div>
            <div class="stat-box">
                <h3>5,000+</h3>
                <p>Tamu Terlayani</p>
            </div>
            <div class="stat-box">
                <h3>4.9★</h3>
                <p>Ulasan Kepuasan</p>
            </div>
            <div class="stat-box">
                <h3>100%</h3>
                <p>Higienis & Bersih</p>
            </div>
        </div>
    </div>
</section>

<!-- Values Pillars -->
<section style="padding: 100px 0; background: #ffffff;">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 60px;">
            <span style="font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; color: var(--primary); font-weight: 700;">Pilar Pelayanan</span>
            <h3 style="font-family: 'Times New Roman', Times, serif; font-size: 2.4rem; color: #0f172a; margin-top: 10px; margin-bottom: 20px; font-weight: normal;">Komitmen Utama Kami</h3>
            <p style="color: #64748b; font-size: 1.05rem; line-height: 1.6;">Kami mengedepankan tiga prinsip dasar untuk menjamin masa tinggal Anda menjadi pengalaman yang menyenangkan.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <!-- Pillar 1 -->
            <div class="value-card">
                <div style="background: rgba(245, 166, 35, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 25px;">
                    <i data-lucide="heart" style="width: 28px; height: 28px;"></i>
                </div>
                <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Keramahan Otentik</h4>
                <p style="color: #64748b; font-size: 0.92rem; line-height: 1.6; margin: 0;">Menyambut Anda layaknya keluarga sendiri dengan pelayanan yang hangat, tanggap, dan ikhlas dari lubuk hati.</p>
            </div>
            
            <!-- Pillar 2 -->
            <div class="value-card">
                <div style="background: rgba(245, 166, 35, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 25px;">
                    <i data-lucide="shield-check" style="width: 28px; height: 28px;"></i>
                </div>
                <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Privasi & Keamanan</h4>
                <p style="color: #64748b; font-size: 0.92rem; line-height: 1.6; margin: 0;">Setiap sudut dirancang untuk menjaga keamanan dan keheningan menginap Anda agar terhindar dari kebisingan.</p>
            </div>
            
            <!-- Pillar 3 -->
            <div class="value-card">
                <div style="background: rgba(245, 166, 35, 0.1); width: 60px; height: 60px; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin-bottom: 25px;">
                    <i data-lucide="leaf" style="width: 28px; height: 28px;"></i>
                </div>
                <h4 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Harmoni Alam</h4>
                <p style="color: #64748b; font-size: 0.92rem; line-height: 1.6; margin: 0;">Mengadopsi konsep eco-friendly dengan pemanfaatan tanaman lokal dan mengurangi limbah plastik sekali pakai.</p>
            </div>
        </div>
    </div>
</section>

<!-- Guest Testimonials -->
<section style="padding: 100px 0 140px 0; background: #f8fafc; border-top: 1px solid #e2e8f0;">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 60px;">
            <span style="font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; color: var(--primary); font-weight: 700;">Ulasan Menginap</span>
            <h3 style="font-family: 'Times New Roman', Times, serif; font-size: 2.4rem; color: #0f172a; margin-top: 10px; margin-bottom: 20px; font-weight: normal;">Apa Kata Tamu Kami?</h3>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px;">
            <div class="testimonial-card">
                <div style="color: var(--primary); margin-bottom: 15px;"><i data-lucide="quote" style="width: 32px; height: 32px; opacity: 0.3;"></i></div>
                <p class="testimonial-quote">"Pengalaman menginap yang luar biasa! Pemandangan lereng Sumbing di pagi hari dari jendela kamar sangat menakjubkan. Kamarnya wangi, kasurnya empuk sekali, dan teh hangat gratis di pagi hari rasanya nikmat sekali."</p>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #e2e8f0; background-image: url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'); background-size: cover; background-position: center;"></div>
                    <div>
                        <h5 style="font-weight: 700; color: #0f172a; margin: 0 0 3px 0;">Budi Santoso</h5>
                        <p style="font-size: 0.8rem; color: #64748b; margin: 0;">Tamu asal Jakarta</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div style="color: var(--primary); margin-bottom: 15px;"><i data-lucide="quote" style="width: 32px; height: 32px; opacity: 0.3;"></i></div>
                <p class="testimonial-quote">"Homestay terbersih yang pernah saya kunjungi. Fasilitasnya lengkap, Wi-Fi kencang sehingga saya bisa bekerja remote dengan lancar. Pelayanan dari staf Rama sangat bersahabat dan membantu kebutuhan kami."</p>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #e2e8f0; background-image: url('https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'); background-size: cover; background-position: center;"></div>
                    <div>
                        <h5 style="font-weight: 700; color: #0f172a; margin: 0 0 3px 0;">Siti Rahma</h5>
                        <p style="font-size: 0.8rem; color: #64748b; margin: 0;">Solo Traveler</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Fasilitas Kami - Rama Homestay')

@section('content')
<style>
    .facilities-page-wrapper {
        padding: 45px 0 80px 0;
        background: #f8fafc;
    }
    
    .facility-detail-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        display: flex;
        align-items: flex-start;
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .facility-detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.05);
        border-color: rgba(245, 166, 35, 0.2);
    }
    
    .facility-icon-wrapper {
        background: rgba(245, 166, 35, 0.1);
        color: var(--primary);
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 8px 20px -5px rgba(245, 166, 35, 0.2);
    }
    
    .facility-icon-wrapper i {
        width: 32px;
        height: 32px;
        stroke-width: 1.8px;
    }
    
    .facility-info h3 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 10px 0;
    }
    
    .facility-info p {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }
</style>

<div class="facilities-page-wrapper">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Kelengkapan Akomodasi</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Fasilitas Homestay</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Nikmati kenyamanan tinggal terbaik dengan kelengkapan fasilitas modern yang membuat Anda serasa di rumah sendiri.</p>
        </div>
        
        <!-- Grid of Facilities -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 30px;">
            
            <!-- Facility 1: Wi-Fi -->
            <div class="facility-detail-card">
                <div class="facility-icon-wrapper">
                    <i data-lucide="wifi"></i>
                </div>
                <div class="facility-info">
                    <h3>Wi-Fi Kecepatan Tinggi (150 Mbps)</h3>
                    <p>Jangan khawatir kehilangan koneksi selama liburan. Seluruh area penginapan, lobby, hingga kamar tidur dilengkapi akses internet nirkabel fiber optik berkecepatan tinggi secara gratis tanpa batas kuota.</p>
                </div>
            </div>
            
            <!-- Facility 2: Kitchen -->
            <div class="facility-detail-card">
                <div class="facility-icon-wrapper">
                    <i data-lucide="coffee"></i>
                </div>
                <div class="facility-info">
                    <h3>Dapur Lengkap & Kopi/Teh Gratis</h3>
                    <p>Tersedia akses ke dapur bersama modern lengkap dengan kompor, microwave, alat masak, dan kulkas. Nikmati juga racikan teh premium dan kopi lokal gratis yang disediakan setiap pagi di ruang santai.</p>
                </div>
            </div>
            
            <!-- Facility 3: Parking -->
            <div class="facility-detail-card">
                <div class="facility-icon-wrapper">
                    <i data-lucide="car"></i>
                </div>
                <div class="facility-info">
                    <h3>Lahan Parkir Luas & Aman</h3>
                    <p>Membawa kendaraan pribadi kini lebih tenang. Homestay kami menyediakan area parkir kendaraan roda dua dan roda empat yang sangat luas, teduh, aman, serta diawasi oleh petugas keamanan dan CCTV 24 jam.</p>
                </div>
            </div>
            
            <!-- Facility 4: Water Heater & TV -->
            <div class="facility-detail-card">
                <div class="facility-icon-wrapper">
                    <i data-lucide="flame"></i>
                </div>
                <div class="facility-info">
                    <h3>Pemanas Air (Water Heater) &amp; Smart TV</h3>
                    <p>Mengingat udara sejuk khas Dieng, setiap kamar mandi telah dilengkapi fasilitas water heater air hangat 24 jam serta Smart TV untuk hiburan santai Anda.</p>
                </div>
            </div>
            

            
        </div>
        
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Layanan & Kebijakan - Rama Homestay')

@section('content')
<style>
    .pages-section {
        padding: 45px 0 80px 0;
        background: #f8fafc;
    }
    
    .services-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-bottom: 60px;
    }
    
    .service-item-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: flex-start;
        gap: 20px;
        transition: all 0.3s ease;
    }
    .service-item-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    }
    
    .service-item-icon {
        background: rgba(245, 166, 35, 0.1);
        color: var(--primary);
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    /* FAQ Accordion Styles */
    .faq-wrapper {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.03);
        margin-top: 50px;
    }
    
    .faq-item {
        border-bottom: 1px solid #f1f5f9;
        padding: 20px 0;
    }
    .faq-item:last-child {
        border-bottom: none;
    }
    
    .faq-trigger {
        width: 100%;
        background: none;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: left;
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        cursor: pointer;
        padding: 0;
    }
    .faq-trigger:focus {
        outline: none;
    }
    
    .faq-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
    }
</style>

<section class="pages-section">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Informasi &amp; Aturan</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Layanan &amp; Informasi Umum</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Informasi lengkap mengenai layanan tambahan, aturan menginap, dan pertanyaan umum seputar Rama Homestay.</p>
        </div>
        
        <!-- Layanan Tambahan -->
        <div>
            
            <div class="services-grid">
                <!-- Service 1 -->
                <div class="service-item-card">
                    <div class="service-item-icon"><i data-lucide="bed" style="width:22px; height:22px;"></i></div>
                    <div>
                        <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Extra Bed (Kasur Tambahan)</h4>
                        <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin: 0;">Membutuhkan kapasitas lebih? Sewa kasur tambahan berkualitas tinggi seharga Rp 75.000 / malam, lengkap dengan sarapan pagi tambahan.</p>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="service-item-card">
                    <div class="service-item-icon"><i data-lucide="car" style="width:22px; height:22px;"></i></div>
                    <div>
                        <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0;">Antar Jemput Bandara / Stasiun</h4>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="service-item-card">
                    <div class="service-item-icon"><i data-lucide="shirt" style="width:22px; height:22px;"></i></div>
                    <div>
                        <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0;">Layanan Binatu (Laundry)</h4>
                    </div>
                </div>
                
                <!-- Service 4 -->
                <div class="service-item-card">
                    <div class="service-item-icon"><i data-lucide="utensils" style="width:22px; height:22px;"></i></div>
                    <div>
                        <h4 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Catering Hidangan Lokal</h4>
                        <p style="color: #64748b; font-size: 0.88rem; line-height: 1.6; margin: 0;">Pesan hidangan makan siang atau malam dengan menu masakan rumahan khas Kaliangkrik yang dimasak langsung menggunakan bahan segar pilihan.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Kebijakan Menginap -->
        <div style="margin-top: 80px;">
            <div style="text-align: center; max-width: 600px; margin: 0 auto 50px;">
                <span style="font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; color: var(--primary); font-weight: 700;">Aturan Kenyamanan Bersama</span>
                <h3 style="font-family: 'Times New Roman', Times, serif; font-size: 2.2rem; color: #0f172a; margin-top: 10px; margin-bottom: 15px; font-weight: normal;">Kebijakan Rama Homestay</h3>
            </div>
            
            <div style="background: #ffffff; border-radius: 24px; padding: 40px; border: 1px solid #e2e8f0; display:grid; grid-template-columns:1fr 1fr; gap:40px;">
                <div>
                    <h5 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 0 0 15px 0; display:flex; align-items:center; gap:8px;"><i data-lucide="info" style="color:var(--primary); width:20px; height:20px;"></i> Waktu & Prosedur</h5>
                    <ul style="padding-left: 20px; color: #64748b; font-size: 0.9rem; line-height: 1.8;">
                        <li style="margin-bottom:8px;">Check-in dapat dilakukan mulai pukul 14:00 WIB ke atas.</li>
                        <li style="margin-bottom:8px;">Check-out wajib diselesaikan maksimal pukul 12:00 WIB.</li>
                        <li style="margin-bottom:8px;">Tamu wajib menunjukkan KTP/Paspor asli saat proses registrasi.</li>
                        <li style="margin-bottom:8px;">Pembatalan reservasi gratis jika dilakukan minimal H-3.</li>
                    </ul>
                </div>
                <div>
                    <h5 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 0 0 15px 0; display:flex; align-items:center; gap:8px;"><i data-lucide="alert-triangle" style="color:#ef4444; width:20px; height:20px;"></i> Larangan Utama</h5>
                    <ul style="padding-left: 20px; color: #64748b; font-size: 0.9rem; line-height: 1.8;">
                        <li style="margin-bottom:8px;">Dilarang keras merokok di dalam kamar tidur (tersedia area khusus merokok di luar).</li>
                        <li style="margin-bottom:8px;">Tidak diperkenankan membawa hewan peliharaan apa pun.</li>
                        <li style="margin-bottom:8px;">Dilarang membawa senjata tajam, narkotika, dan barang berbahaya.</li>
                        <li style="margin-bottom:8px;">Menjaga keheningan lingkungan di atas pukul 22:00 WIB.</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Pertanyaan Umum (FAQ) -->
        <div class="faq-wrapper">
            <div style="text-align: center; margin-bottom: 40px;">
                <span style="font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; color: var(--primary); font-weight: 700;">Tanya Jawab</span>
                <h3 style="font-family: 'Times New Roman', Times, serif; font-size: 2rem; color: #0f172a; margin-top: 10px; margin-bottom: 0; font-weight: normal;">Pertanyaan Sering Diajukan</h3>
            </div>
            
            <!-- FAQ 1 -->
            <div class="faq-item">
                <button class="faq-trigger">
                    <span>Apakah tarif sewa kamar sudah termasuk sarapan pagi?</span>
                    <i data-lucide="chevron-down" style="width:18px; height:18px; transition:transform 0.3s;"></i>
                </button>
                <div class="faq-content">
                    <p style="padding-top: 12px; margin: 0;">Ya, seluruh tarif sewa kamar yang tertera di website kami sudah termasuk sarapan pagi bergizi gratis untuk maksimal 2 orang tamu dewasa per kamar.</p>
                </div>
            </div>
            
            <!-- FAQ 2 -->
            <div class="faq-item">
                <button class="faq-trigger">
                    <span>Bagaimana metode pembayaran reservasi di homestay?</span>
                    <i data-lucide="chevron-down" style="width:18px; height:18px; transition:transform 0.3s;"></i>
                </button>
                <div class="faq-content">
                    <p style="padding-top: 12px; margin: 0;">Kami menerima pembayaran melalui transfer Bank lokal (BCA, Mandiri, BNI, BRI) serta metode E-Wallet digital seperti QRIS, GoPay, dan ShopeePay untuk proses verifikasi otomatis yang cepat.</p>
                </div>
            </div>
            
            <!-- FAQ 3 -->
            <div class="faq-item">
                <button class="faq-trigger">
                    <span>Apakah tersedia akses internet nirkabel (Wi-Fi) gratis?</span>
                    <i data-lucide="chevron-down" style="width:18px; height:18px; transition:transform 0.3s;"></i>
                </button>
                <div class="faq-content">
                    <p style="padding-top: 12px; margin: 0;">Ya, kami menyediakan koneksi internet nirkabel (Wi-Fi) berkecepatan tinggi secara gratis yang menjangkau seluruh area kamar tidur dan ruang komunal/dapur bersama homestay.</p>
                </div>
            </div>
        </div>
        
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqTriggers = document.querySelectorAll('.faq-trigger');
        
        faqTriggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
                const parent = this.parentElement;
                const content = parent.querySelector('.faq-content');
                const icon = this.querySelector('svg');
                
                // Close other items
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== parent) {
                        item.querySelector('.faq-content').style.maxHeight = null;
                        const otherIcon = item.querySelector('.faq-trigger svg');
                        if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                    }
                });
                
                // Toggle current item
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    if (icon) icon.style.transform = 'rotate(0deg)';
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    if (icon) icon.style.transform = 'rotate(180deg)';
                }
            });
        });
    });
</script>
@endsection

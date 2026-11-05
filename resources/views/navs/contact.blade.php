@extends('layouts.app')

@section('title', 'Hubungi Kontak - Rama Homestay')

@section('content')
<style>
    .contact-section {
        padding: 45px 0 80px 0;
        background: #f8fafc;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 45px;
        align-items: start;
    }
    
    .info-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 25px 30px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.04);
        border-color: rgba(245, 166, 35, 0.3);
    }
    
    .info-card-link:hover {
        border-color: #22c55e !important;
        box-shadow: 0 12px 30px rgba(34, 197, 94, 0.15) !important;
        transform: translateY(-3px);
    }
    
    .info-icon {
        background: rgba(245, 166, 35, 0.1);
        color: var(--primary);
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .form-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.04);
    }
    
    .map-card {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        height: 280px;
        margin-top: 25px;
    }

    .form-control-custom {
        width: 100%;
        padding: 13px 18px;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        color: #0f172a;
        background: #f8fafc;
        box-sizing: border-box;
        transition: all 0.25s ease;
    }
    .form-control-custom:focus {
        border-color: var(--primary);
        outline: none;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.15);
    }

    @media (max-width: 900px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .form-card {
            padding: 25px 20px;
        }
    }
</style>

<section class="contact-section">
    <div class="container">
        
        {{-- Page Header --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Hubungi Kami</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Informasi &amp; Layanan Kontak</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Ada pertanyaan seputar reservasi kamar atau wisata Dieng? Kami siap membantu melayani kebutuhan informasi liburan Anda.</p>
        </div>
        
        <div class="contact-grid">
            <!-- Left Info Panel -->
            <div>
                <h3 style="font-size: 1.35rem; font-weight: 700; color: #0f172a; margin: 0 0 20px 0;">Bagaimana Kami Bisa Membantu Anda?</h3>
                
                <!-- Card 1: Lokasi -->
                <div class="info-card">
                    <div class="info-icon"><i data-lucide="map-pin" style="width:24px; height:24px;"></i></div>
                    <div>
                        <h5 style="font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0 0 5px 0;">Lokasi Homestay</h5>
                        <p style="color: #64748b; font-size: 0.88rem; line-height: 1.5; margin: 0;">Jl. Telaga Warna, RT.02 RW.01, Dieng Wetan, Kec. Kejajar, Kabupaten Wonosobo, Jawa Tengah 56354</p>
                    </div>
                </div>
                
                <!-- Card 2: Layanan Telepon & WhatsApp (Navigasi ke WhatsApp 081225711350) -->
                <a href="https://wa.me/6281225711350" target="_blank" rel="noopener noreferrer" class="info-card info-card-link" style="text-decoration: none; color: inherit; cursor: pointer;">
                    <div class="info-icon" style="background: rgba(34, 197, 94, 0.12); color: #16a34a;">
                        <i data-lucide="phone-call" style="width:24px; height:24px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 6px; margin-bottom: 4px;">
                            <h5 style="font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0;">Layanan Telepon &amp; WhatsApp</h5>
                            <span style="display: inline-flex; align-items: center; gap: 4px; background: #dcfce7; color: #15803d; font-size: 0.75rem; font-weight: 700; padding: 3px 10px; border-radius: 20px; border: 1px solid #bbf7d0;">
                                <i data-lucide="message-circle" style="width:12px; height:12px;"></i> Chat Sekarang
                            </span>
                        </div>
                        <p style="color: #0f172a; font-size: 0.98rem; font-weight: 800; line-height: 1.5; margin: 0 0 3px 0;">+62 812-2571-1350</p>
                        <span style="color: #64748b; font-size: 0.82rem;">(Customer Service 24 Jam &bull; Klik untuk chat langsung via WhatsApp)</span>
                    </div>
                </a>
                
                <!-- Card 3: Email -->
                <a href="mailto:info@ramahomestay.com" class="info-card" style="text-decoration: none; color: inherit;">
                    <div class="info-icon"><i data-lucide="mail" style="width:24px; height:24px;"></i></div>
                    <div>
                        <h5 style="font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0 0 5px 0;">Alamat Surat Elektronik (Email)</h5>
                        <p style="color: #64748b; font-size: 0.88rem; line-height: 1.5; margin: 0;">info@ramahomestay.com</p>
                    </div>
                </a>
                
                <!-- Interactive Google Map -->
                <div class="map-card">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.3!2d109.9166!3d-7.2050!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7088a4f8cbbd3b%3A0x5027a76e356a2f0!2sDieng%2C%20Kejajar%2C%20Wonosobo%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1700000000001!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
            <!-- Right Form Panel: Kirimkan Pesan Anda -->
            <div>
                <div class="form-card">
                    <h4 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0 0 10px 0;">Kirimkan Pesan Anda</h4>
                    <p style="color: #64748b; font-size: 0.9rem; line-height: 1.5; margin-bottom: 25px;">Tuliskan pertanyaan, saran, atau keluhan Anda. Tim admin kami akan segera merespon pesan Anda kurang dari 24 jam.</p>
                    
                    <!-- Notifikasi Terkirim -->
                    <div id="contact-success" style="display:none; background:#dcfce7; color:#15803d; border:1px solid #bbf7d0; border-radius:12px; padding:15px 18px; font-weight:700; font-size:0.9rem; margin-bottom:20px; align-items:center; gap:8px;">
                        <i data-lucide="check-circle" style="width:20px; height:20px; color:#16a34a; flex-shrink:0;"></i>
                        <span>Pesan Anda berhasil dikirim! Terima kasih telah menghubungi Rama Homestay.</span>
                    </div>
                    
                    <form id="contact-form" onsubmit="event.preventDefault(); document.getElementById('contact-success').style.display='flex'; if (window.lucide) { window.lucide.createIcons(); } this.reset();">
                        <div style="margin-bottom: 18px;">
                            <label style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:8px; text-transform:uppercase;">Nama Lengkap Anda</label>
                            <input type="text" class="form-control-custom" placeholder="Contoh: Budi Luhur" required>
                        </div>
                        
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom: 18px;">
                            <div>
                                <label style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:8px; text-transform:uppercase;">Alamat Email</label>
                                <input type="email" class="form-control-custom" placeholder="budi@email.com" required>
                            </div>
                            <div>
                                <label style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:8px; text-transform:uppercase;">Nomor Telepon</label>
                                <input type="tel" class="form-control-custom" placeholder="0812xxxxxx" required>
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 18px;">
                            <label style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:8px; text-transform:uppercase;">Judul Pesan (Subjek)</label>
                            <input type="text" class="form-control-custom" placeholder="Tanya Paket Tour / Reservasi Kamar" required>
                        </div>
                        
                        <div style="margin-bottom: 22px;">
                            <label style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:8px; text-transform:uppercase;">Isi Pesan Anda secara Detail</label>
                            <textarea class="form-control-custom" rows="5" placeholder="Tuliskan detail pertanyaan Anda di sini..." required style="resize:none; padding-top:14px;"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width:100%; border-radius:12px; padding:15px; font-weight:700; font-size:1rem; color:white; background:var(--primary); border:none; box-shadow:0 4px 15px rgba(245, 166, 35, 0.25); cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px;">
                            <i data-lucide="send" style="width:18px; height:18px;"></i>
                            <span>Kirim Pesan Sekarang</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</section>
@endsection

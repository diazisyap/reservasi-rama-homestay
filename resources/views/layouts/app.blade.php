<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rama Homestay') - Reservasi Kamar</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Load modern icons -->
    <link href="https://unpkg.com/lucide@latest" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Language selector & Profile Dropdown style */
        .nav-actions-container {
            display: flex;
            align-items: center;
        }
        
        .language-selector, .user-profile-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .lang-btn, .profile-dropdown-btn {
            background: transparent;
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 18px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        
        .lang-btn:hover, .profile-dropdown-btn:hover {
            color: var(--primary);
        }
        
        .lang-btn i, .profile-dropdown-btn i {
            stroke-width: 2px;
            width: 16px;
            height: 16px;
        }
        
        .lang-dropdown, .profile-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            min-width: 180px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            overflow: hidden;
            z-index: 1000;
            border: 1px solid rgba(226, 232, 240, 0.8);
            padding: 6px 0;
            animation: dropDownFade 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        .profile-dropdown-menu {
            min-width: 220px;
        }
        
        @keyframes dropDownFade {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .language-selector:hover .lang-dropdown,
        .language-selector.active .lang-dropdown,
        .lang-dropdown.show,
        .user-profile-dropdown:hover .profile-dropdown-menu,
        .user-profile-dropdown.active .profile-dropdown-menu {
            display: block;
        }
        
        .lang-dropdown a, .profile-dropdown-menu a, .dropdown-logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 18px;
            color: #334155;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-align: left;
            width: 100%;
            background: transparent;
            border: none;
            cursor: pointer;
            font-family: inherit;
        }
        
        .lang-dropdown a:hover, .profile-dropdown-menu a:hover, .dropdown-logout-btn:hover {
            background: rgba(245, 166, 35, 0.08);
            color: var(--primary);
        }
        
        .lang-dropdown a.active {
            color: var(--primary);
            font-weight: 700;
            background: rgba(245, 166, 35, 0.05);
        }
        
        .profile-dropdown-menu hr {
            margin: 6px 0;
            border: 0;
            border-top: 1px solid #cbd5e1;
            opacity: 0.5;
        }
        
        .dropdown-logout-btn {
            color: #ef4444;
        }
        .dropdown-logout-btn:hover {
            background: rgba(239, 68, 68, 0.05);
            color: #ef4444;
        }

        /* Nav login/register link adjustments */
        .nav-auth-link {
            color: white;
            padding: 18px 15px;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1px;
            transition: color 0.3s;
        }
        /* Dashboard Sidebar Styles */
        .dashboard-grid {
            margin-top: 50px;
        }
        
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 12px;
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        
        .sidebar-link:hover {
            background: rgba(245, 166, 35, 0.05);
            color: var(--primary);
        }
        
        .sidebar-link.active {
            background: rgba(245, 166, 35, 0.1);
            color: var(--primary);
        }
        
        .sidebar-link i {
            width: 18px;
            height: 18px;
            stroke-width: 2.2px;
        }
        
        .sidebar-link-logout:hover {
            background: rgba(239, 68, 68, 0.05) !important;
            color: #ef4444 !important;
        }
        .sidebar-link-logout i {
            width: 18px;
            height: 18px;
            stroke-width: 2.2px;
        }

        /* Footer Styles */
        .site-footer {
            background: #111827;
            color: #f3f4f6;
            padding: 80px 0 30px;
            margin-top: 0;
            border-top: 1px solid #1f2937;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 50px;
        }
        
        .footer-logo {
            margin-bottom: 20px;
        }
        
        .footer-logo h2 {
            font-size: 2.2rem;
            font-family: 'Times New Roman', Times, serif;
            color: #fff;
            margin: 0;
            line-height: 1;
        }
        
        .footer-logo span {
            font-size: 0.8rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--primary);
        }
        
        .footer-text {
            color: #9ca3af;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        
        .footer-socials {
            display: flex;
            gap: 15px;
        }
        
        .footer-social-link {
            width: 40px;
            height: 40px;
            background: #1f2937;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-social-link:hover {
            background: var(--primary);
            color: #111;
            transform: translateY(-3px);
        }
        
        .footer-social-link i {
            width: 18px;
            height: 18px;
        }
        
        .footer-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 25px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--primary);
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .footer-links a:hover {
            color: var(--primary);
            padding-left: 5px;
        }
        
        .footer-contact {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-contact li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: #9ca3af;
        }
        
        .footer-contact i {
            color: var(--primary);
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }
        
        .footer-bottom {
            border-top: 1px solid #1f2937;
            padding-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 0.85rem;
            color: #6b7280;
        }
        
        @media (max-width: 992px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
@if(!auth()->check() || auth()->user()->role !== 'admin')
    <header class="site-header @yield('header_class', 'solid-header')">
        <div class="top-bar">
            <div class="container top-bar-inner">
                <div class="top-contact">
                    <i data-lucide="mail"></i>
                    <div>
                        <span class="label">Email Homestay:</span>
                        <span class="value">info@ramahomestay.com</span>
                    </div>
                </div>
                
                <div class="logo-area">
                    <h1 class="site-title">R</h1>
                    <div class="site-subtitle">Rama Homestay</div>
                </div>
                
                <a href="https://wa.me/6281225711350" target="_blank" rel="noopener noreferrer" class="top-contact" style="text-align: right; text-decoration: none; color: inherit; cursor: pointer;">
                    <div>
                        <span class="label">Hubungi WhatsApp:</span>
                        <span class="value">+62 812-2571-1350</span>
                    </div>
                    <i data-lucide="phone"></i>
                </a>
            </div>
        </div>
        
        <nav class="main-nav">
            <div class="container nav-inner">
                <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Buka Menu Navigasi">
                    <i data-lucide="menu"></i>
                </button>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('rooms.index') }}">Kamar</a></li>
                    <li><a href="{{ route('facilities') }}">Fasilitas</a></li>
                    <li><a href="{{ route('reviews') }}">Ulasan</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                </ul>
                <div class="nav-actions-container">
                    <!-- Language Dropdown -->
                    <div class="language-selector">
                        <button class="lang-btn" type="button" id="currentLangBtn">
                            <i data-lucide="globe"></i>
                            <span id="currentLangLabel">ID</span>
                            <i data-lucide="chevron-down" style="width:12px; height:12px;"></i>
                        </button>
                        <div class="lang-dropdown">
                            <a href="javascript:void(0)" onclick="setSiteLanguage('id')" id="langOptionID" class="active">Bahasa Indonesia (ID)</a>
                            <a href="javascript:void(0)" onclick="setSiteLanguage('en')" id="langOptionEN">English (EN)</a>
                        </div>
                    </div>

                    <!-- Auth Actions -->
                    @auth
                        <!-- Profile Dropdown for Authenticated User -->
                        <div class="user-profile-dropdown">
                            <button class="profile-dropdown-btn">
                                <i data-lucide="user"></i>
                                <span>{{ explode(' ', auth()->user()->name)[0] }}</span>
                                <i data-lucide="chevron-down" style="width:12px; height:12px;"></i>
                            </button>
                            <div class="profile-dropdown-menu">
                                <a href="{{ route('tamu.dashboard') }}"><i data-lucide="calendar" style="width:16px; height:16px;"></i> Reservasi Saya</a>
                                <a href="{{ route('profile') }}"><i data-lucide="user-cog" style="width:16px; height:16px;"></i> Profil Saya</a>
                                <hr>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-logout-btn"><i data-lucide="log-out" style="width:16px; height:16px;"></i> Keluar Akun</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-auth-link">Login</a>
                        <a href="{{ route('register') }}" class="nav-auth-link">Register</a>
                    @endauth
                    
                    <button class="search-btn" onclick="document.getElementById('rooms') ? document.getElementById('rooms').scrollIntoView({behavior: 'smooth'}) : window.location.href='{{ route('rooms.index') }}'"><i data-lucide="search" style="width:20px; height:20px;"></i></button>
                </div>
            </div>
        </nav>
    </header>
@endif

    @if(session('success'))
        <div class="container" style="margin-top: 25px; margin-bottom: 25px;">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="container" style="margin-top: 25px; margin-bottom: 25px;">
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @yield('content')

@if(!auth()->check() || auth()->user()->role !== 'admin')
    <!-- Premium Footer Section -->
    <footer class="site-footer no-print">
        <div class="container">
            <div class="footer-grid">
                <!-- Branding Column -->
                <div>
                    <div class="footer-logo">
                        <h2>R</h2>
                        <span>Rama Homestay</span>
                    </div>
                    <p class="footer-text">
                        Penginapan nyaman, tenteram, dan berkelas di lereng pegunungan indah. Kami berkomitmen memberikan kenyamanan terbaik dengan keramahan lokal sejak 2014.
                    </p>
                    <div class="footer-socials">
                        <a href="#" class="footer-social-link" aria-label="Facebook"><i data-lucide="facebook"></i></a>
                        <a href="#" class="footer-social-link" aria-label="Instagram"><i data-lucide="instagram"></i></a>
                        <a href="#" class="footer-social-link" aria-label="Twitter"><i data-lucide="twitter"></i></a>
                        <a href="#" class="footer-social-link" aria-label="Youtube"><i data-lucide="youtube"></i></a>
                    </div>
                </div>

                <!-- Navigation Column -->
                <div>
                    <h3 class="footer-title">Halaman Utama</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i data-lucide="chevron-right" style="width:12px; height:12px;"></i> Beranda</a></li>
                        <li><a href="{{ route('rooms.index') }}"><i data-lucide="chevron-right" style="width:12px; height:12px;"></i> Katalog Kamar</a></li>
                        <li><a href="{{ route('facilities') }}"><i data-lucide="chevron-right" style="width:12px; height:12px;"></i> Fasilitas</a></li>
                        <li><a href="{{ route('reviews') }}"><i data-lucide="chevron-right" style="width:12px; height:12px;"></i> Ulasan Tamu</a></li>
                        <li><a href="{{ route('contact') }}"><i data-lucide="chevron-right" style="width:12px; height:12px;"></i> Hubungi Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div>
                    <h3 class="footer-title">Kontak & Lokasi</h3>
                    <ul class="footer-contact">
                        <li>
                            <i data-lucide="map-pin"></i>
                            <span>Jl. Telaga Warna, RT.02 RW.01, Dieng Wetan, Kec. Kejajar, Kabupaten Wonosobo, Jawa Tengah 56354</span>
                        </li>
                        <li>
                            <i data-lucide="phone"></i>
                            <a href="https://wa.me/6281225711350" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none;">+62 812-2571-1350</a>
                        </li>
                        <li>
                            <i data-lucide="mail"></i>
                            <span>info@ramahomestay.com</span>
                        </li>
                        <li>
                            <i data-lucide="clock"></i>
                            <span>Check-in: 14:00 | Check-out: 12:00</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom Bar -->
            <div class="footer-bottom">
                <p>&copy; 2026 Rama Homestay. Hak Cipta Dilindungi Undang-Undang.</p>
                <div style="display:flex; gap:20px;">
                    <a href="{{ route('pages') }}" style="color:#6b7280; text-decoration:none;">Syarat & Ketentuan</a>
                    <a href="{{ route('pages') }}" style="color:#6b7280; text-decoration:none;">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>
@endif


    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('mobileMenuToggle');
            const navMenu = document.getElementById('navMenu');
            
            if (toggleBtn && navMenu) {
                toggleBtn.addEventListener('click', function() {
                    navMenu.classList.toggle('show-mobile');
                    const icon = toggleBtn.querySelector('i');
                    if (navMenu.classList.contains('show-mobile')) {
                        icon.setAttribute('data-lucide', 'x');
                    } else {
                        icon.setAttribute('data-lucide', 'menu');
                    }
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
            }
        });
    </script>

    <!-- Google Translate Integration & Fallback Widget -->
    <div id="google_translate_element" style="display:none;"></div>
    <style>
        .goog-te-banner-frame.skiptranslate, .goog-te-banner-frame, iframe.goog-te-banner-frame { display: none !important; }
        body { top: 0px !important; }
        .goog-logo-link, .goog-te-gadget span { display: none !important; }
        .goog-te-gadget { font-size: 0px !important; }
        #goog-gt-tt, .goog-te-balloon-frame { display: none !important; }
        .goog-text-highlight { background: none !important; box-shadow: none !important; }
        font { background: transparent !important; }
    </style>
    <script type="text/javascript">
        // BILINGUAL TRANSLATION DICTIONARY (INDONESIAN -> ENGLISH)
        const appTranslations = [
            // Topbar & Nav
            { id: "Email Homestay:", en: "Homestay Email:" },
            { id: "Hubungi kami:", en: "Contact Us:" },
            { id: "Beranda", en: "Home" },
            { id: "Kamar", en: "Rooms" },
            { id: "Fasilitas", en: "Facilities" },
            { id: "Ulasan", en: "Reviews" },
            { id: "Kontak", en: "Contact" },
            { id: "Login", en: "Login" },
            { id: "Masuk", en: "Log In" },
            { id: "Register", en: "Register" },
            { id: "Daftar", en: "Register" },
            { id: "Reservasi Saya", en: "My Bookings" },
            { id: "Profil Saya", en: "My Profile" },
            { id: "Keluar", en: "Logout" },

            // Welcome Page Hero & Stats
            { id: "Informasi Resmi Rama Homestay", en: "Rama Homestay Official Information" },
            { id: "Dekat Titik 0 KM Dieng • Dataran Tinggi Dieng", en: "Near 0 KM Point Dieng • Dieng Plateau" },
            { id: "Selamat datang di Rama Homestay, penginapan ramah dan nyaman berlokasi strategis di dekat Titik 0 KM Dataran Tinggi Dieng. Rasakan kehangatan istirahat seperti di rumah sendiri dengan panorama pegunungan yang asri di tengah sejuknya negeri di atas awan.", en: "Welcome to Rama Homestay, a friendly and comfortable accommodation strategically located near the 0 KM Point of Dieng Plateau. Experience warm rest just like at home with serene mountain panoramas in the cool land above the clouds." },
            { id: "Kamar Tersedia", en: "Available Rooms" },
            { id: "Tamu Puas", en: "Satisfied Guests" },
            { id: "Rating Rata-rata", en: "Average Rating" },
            { id: "Tahun Berpengalaman", en: "Years Experience" },
            
            // About Section
            { id: "Tentang Rama Homestay", en: "About Rama Homestay" },
            { id: "Kehangatan & Kenyamanan Istirahat di Negeri di Atas Awan", en: "Warmth & Comfort of Rest in the Land Above the Clouds" },
            { id: "Rama Homestay berlokasi strategis di dekat Titik 0 KM Dataran Tinggi Dieng, menjadikannya pilihan penginapan idaman bagi keluarga, pasangan, maupun backpacker. Kami menghadirkan suasana hunian yang bersih, tenang, dan hangat di tengah hawa dingin pegunungan Dieng.", en: "Rama Homestay is strategically located near the 0 KM Point of Dieng Plateau, making it an ideal choice for families, couples, and backpackers. We provide a clean, quiet, and warm home atmosphere amidst the cold Dieng mountain air." },
            { id: "Dengan keramahan khas masyarakat lokal dan dedikasi pelayanan sepenuh hati, kami selalu siap menyambut Anda seperti keluarga sendiri agar liburan Anda menjelajahi keindahan alam Dieng berjalan sempurna.", en: "With genuine local hospitality and dedicated service, we always welcome you like family so that your holiday exploring the natural beauty of Dieng runs perfectly." },
            { id: "Pelayanan Hangat & Ramah", en: "Warm & Friendly Hospitality" },
            { id: "Staf dan pemilik homestay siap membantu kebutuhan Anda 24 jam dengan suasana kekeluargaan yang ramah.", en: "Staff and homestay owners are ready to assist your needs 24 hours with a warm family atmosphere." },
            { id: "Lokasi Strategis Wisata", en: "Strategic Sightseeing Location" },
            { id: "Sangat dekat dengan Candi Arjuna, Kawah Sikidang, Telaga Warna, dan spot sunrise Bukit Sikunir.", en: "Very close to Arjuna Temple, Sikidang Crater, Color Lake, and Sikunir Hill sunrise spot." },
            { id: "Air Panas & Kenyamanan", en: "Hot Water & Comfort" },
            { id: "Fasilitas water heater 24 jam dan kamar mandi bersih untuk kenyamanan istirahat di udara dingin Dieng.", en: "24-hour hot water heater and clean bathrooms for comfortable rest in Dieng's cool climate." },
            { id: "Pilihan Kamar Penginapan", en: "Homestay Room Selections" },
            { id: "Kamar Nyaman & Bersih", en: "Clean & Comfortable Rooms" },
            { id: "Pilihan kamar terbaik kami yang siap dihuni untuk istirahat optimal selama liburan di Dieng.", en: "Our best room choices ready for your optimal rest during vacation in Dieng." },
            { id: "Kapasitas 3 Tamu", en: "Capacity: 3 Guests" },
            { id: "3 Tamu", en: "3 Guests" },
            { id: "Lihat Detail", en: "View Details" },
            { id: "Pesan Sekarang", en: "Book Now" },
            { id: "Lihat Semua Kamar", en: "View All Rooms" },
            { id: "Fasilitas Unggulan Homestay", en: "Featured Homestay Facilities" },
            { id: "Kenyamanan Anda Prioritas Kami", en: "Your Comfort is Our Priority" },
            { id: "Semua fasilitas dirancang untuk memberikan pengalaman menginap terbaik dan menghangatkan liburan Anda.", en: "All facilities are designed to provide the best lodging experience and warm your vacation." },
            { id: "Ulasan Tamu Nyata", en: "Real Guest Reviews" },
            { id: "Pengalaman Tamu Menginap", en: "Guest Stay Experiences" },
            { id: "Lihat Semua Ulasan", en: "View All Reviews" },
            { id: "Siap Berlibur ke Dataran Tinggi Dieng?", en: "Ready for Holiday in Dieng Plateau?" },
            { id: "Pesan kamar Anda sekarang juga sebelum kehabisan, terutama saat akhir pekan atau musim liburan panjang.", en: "Book your room now before running out, especially during weekends or holiday seasons." },
            { id: "Hubungi WhatsApp", en: "Contact via WhatsApp" },

            // Contact Page
            { id: "Hubungi Kontak - Rama Homestay", en: "Contact Us - Rama Homestay" },
            { id: "Hubungi Kami", en: "Contact Us" },
            { id: "Informasi & Layanan Kontak", en: "Contact Information & Services" },
            { id: "Ada pertanyaan? Kami siap membantu melayani kebutuhan informasi liburan Anda.", en: "Have questions? We are ready to help assist your vacation information needs." },
            { id: "Bagaimana Kami Bisa Membantu Anda?", en: "How Can We Help You?" },
            { id: "Lokasi Homestay", en: "Homestay Location" },
            { id: "Layanan Telepon & WhatsApp", en: "Phone & WhatsApp Services" },
            { id: "Alamat Surat Elektronik (Email)", en: "Email Address" },
            { id: "Customer Service 24 Jam", en: "24-Hour Customer Service" },
            { id: "Kirimkan Pesan Anda", en: "Send Your Message" },
            { id: "Tuliskan pertanyaan, saran, atau keluhan Anda. Tim admin kami akan segera merespon pesan Anda kurang dari 24 jam.", en: "Write your questions, suggestions, or feedback. Our admin team will respond in under 24 hours." },
            { id: "Pesan Anda berhasil dikirim! Terima kasih.", en: "Your message was sent successfully! Thank you." },
            { id: "Nama Lengkap Anda", en: "Your Full Name" },
            { id: "Alamat Email", en: "Email Address" },
            { id: "Nomor Telepon", en: "Phone Number" },
            { id: "Subjek Pertanyaan", en: "Inquiry Subject" },
            { id: "Pilih Topik Pertanyaan", en: "Select Inquiry Topic" },
            { id: "Informasi Kamar & Ketersediaan", en: "Room Info & Availability" },
            { id: "Bantuan Pembayaran", en: "Payment Assistance" },
            { id: "Paket Wisata & Layanan", en: "Tour Packages & Services" },
            { id: "Keluhan & Saran", en: "Feedback & Complaints" },
            { id: "Lainnya", en: "Other" },
            { id: "Tulis Pesan Lengkap", en: "Write Complete Message" },
            { id: "Kirim Pesan Sekarang", en: "Send Message Now" },

            // Rooms Pages
            { id: "Daftar Kamar Rama Homestay", en: "Rama Homestay Room Listing" },
            { id: "Temukan kamar yang sesuai dengan kebutuhan istirahat Anda di Dataran Tinggi Dieng.", en: "Find the room that suits your rest needs in Dieng Plateau." },
            { id: "Semua Kamar", en: "All Rooms" },
            { id: "Kamar 1", en: "Room 1" },
            { id: "Kamar 2", en: "Room 2" },
            { id: "Kamar 3", en: "Room 3" },
            { id: "Kamar 4", en: "Room 4" },
            { id: "Kamar 5", en: "Room 5" },
            { id: "Kamar 6", en: "Room 6" },
            { id: "Kamar 7", en: "Room 7" },
            { id: "Kamar 8", en: "Room 8" },
            { id: "Harga per malam:", en: "Price per night:" },
            { id: "Kapasitas Maksimal:", en: "Max Capacity:" },
            { id: "Fasilitas Kamar", en: "Room Facilities" },
            { id: "Deskripsi Kamar", en: "Room Description" },
            { id: "Pesan Kamar Ini", en: "Book This Room" },
            { id: "Pilih Tanggal Menginap", en: "Select Stay Dates" },
            { id: "Tanggal Check-In", en: "Check-In Date" },
            { id: "Tanggal Check-Out", en: "Check-Out Date" },
            { id: "Cek Ketersediaan Kamar", en: "Check Room Availability" },

            // Facilities Page
            { id: "Fasilitas Homestay", en: "Homestay Facilities" },
            { id: "Fasilitas Lengkap untuk Kenyamanan Anda", en: "Complete Facilities for Your Comfort" },
            { id: "Nikmati berbagai fasilitas pendukung terbaik selama menginap di Rama Homestay Dieng.", en: "Enjoy top supporting facilities during your stay at Rama Homestay Dieng." },
            { id: "Water Heater 24 Jam", en: "24-Hour Water Heater" },
            { id: "WiFi Cepat Gratis", en: "Free Fast WiFi" },
            { id: "Parkir Luas & Aman", en: "Safe & Spacious Parking" },
            { id: "Dapur Bersama Lengkap", en: "Fully Equipped Shared Kitchen" },
            { id: "Ruang Tamu & Bersantai", en: "Living Room & Lounge" },
            { id: "Teh, Kopi & Air Mineral", en: "Tea, Coffee & Mineral Water" },

            // Reviews Page
            { id: "Ulasan & Testimoni Tamu", en: "Guest Reviews & Testimonials" },
            { id: "Apa Kata Tamu Kami?", en: "What Our Guests Say?" },
            { id: "Pengalaman nyata dari tamu yang pernah menginap di Rama Homestay Dieng.", en: "Authentic experiences from guests who stayed at Rama Homestay Dieng." },
            { id: "Beri Penilaian & Ulasan", en: "Submit Review & Rating" },
            { id: "Tulis Ulasan Anda", en: "Write Your Review" },

            // Auth Pages
            { id: "Masuk ke Akun Anda", en: "Sign In to Your Account" },
            { id: "Masuk Ke Akun", en: "Log In to Account" },
            { id: "Silakan masukkan email dan password untuk melanjutkan", en: "Please enter your email and password to continue" },
            { id: "Belum punya akun?", en: "Don't have an account?" },
            { id: "Daftar Sekarang", en: "Register Now" },
            { id: "Sudah punya akun?", en: "Already have an account?" },
            { id: "Daftar Akun Baru", en: "Create New Account" },
            { id: "Nama Lengkap", en: "Full Name" },
            { id: "Kata Sandi", en: "Password" },
            { id: "Konfirmasi Kata Sandi", en: "Confirm Password" },
            { id: "Ingat Saya", en: "Remember Me" },
            { id: "Lupa Kata Sandi?", en: "Forgot Password?" },

            // Booking / Tamu
            { id: "Dashboard Tamu", en: "Guest Dashboard" },
            { id: "Riwayat Reservasi", en: "Booking History" },
            { id: "Detail Reservasi", en: "Reservation Details" },
            { id: "Status Pembayaran", en: "Payment Status" },
            { id: "Lunas", en: "Paid" },
            { id: "Menunggu Pembayaran", en: "Pending Payment" },
            { id: "Belum Lunas", en: "Unpaid" },
            { id: "Dikonfirmasi", en: "Confirmed" },
            { id: "Selesai", en: "Completed" },
            { id: "Dibatalkan", en: "Cancelled" },
            { id: "Metode Pembayaran", en: "Payment Method" },
            { id: "Total Pembayaran", en: "Total Payment" },
            { id: "Bayar Sekarang", en: "Pay Now" },
            { id: "Unggah Bukti Pembayaran", en: "Upload Payment Proof" },

            // Footer & Common
            { id: "Tentang Homestay", en: "About Homestay" },
            { id: "Tautan Cepat", en: "Quick Links" },
            { id: "Kontak & Alamat", en: "Contact & Address" },
            { id: "Kebijakan Privasi", en: "Privacy Policy" },
            { id: "Syarat & Ketentuan", en: "Terms & Conditions" },
            { id: "Hak Cipta Dilindungi", en: "All Rights Reserved" },
            { id: "Semua Hak Cipta Dilindungi", en: "All Rights Reserved" },
            { id: "malam", en: "night" },
            { id: "/ malam", en: "/ night" }
        ];

        function applySiteLanguage(lang) {
            const isEn = (lang === 'en');
            
            // Update labels and active states in dropdown
            const label = document.getElementById('currentLangLabel');
            const optID = document.getElementById('langOptionID');
            const optEN = document.getElementById('langOptionEN');
            if (label) label.innerText = isEn ? 'EN' : 'ID';
            if (optID) optID.classList.toggle('active', !isEn);
            if (optEN) optEN.classList.toggle('active', isEn);

            // Close dropdown
            const dropdown = document.querySelector('.lang-dropdown');
            if (dropdown) dropdown.classList.remove('show');
            const selector = document.querySelector('.language-selector');
            if (selector) selector.classList.remove('active');

            // Replace text nodes
            const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);
            let node;
            while ((node = walker.nextNode())) {
                if (!node.parentElement) continue;
                const tag = node.parentElement.tagName;
                if (tag === 'SCRIPT' || tag === 'STYLE' || tag === 'NOSCRIPT' || node.parentElement.closest('.lang-dropdown') || node.parentElement.id === 'currentLangBtn' || node.parentElement.closest('#google_translate_element')) {
                    continue;
                }
                if (typeof node._origText === 'undefined') {
                    node._origText = node.nodeValue;
                }
                if (isEn) {
                    let val = node._origText;
                    for (let i = 0; i < appTranslations.length; i++) {
                        const item = appTranslations[i];
                        if (val.includes(item.id)) {
                            val = val.split(item.id).join(item.en);
                        }
                    }
                    node.nodeValue = val;
                } else {
                    node.nodeValue = node._origText;
                }
            }

            // Replace input placeholders
            document.querySelectorAll('input[placeholder], textarea[placeholder]').forEach(el => {
                if (typeof el._origPlaceholder === 'undefined') {
                    el._origPlaceholder = el.placeholder;
                }
                if (isEn) {
                    let val = el._origPlaceholder;
                    for (let i = 0; i < appTranslations.length; i++) {
                        const item = appTranslations[i];
                        if (val.includes(item.id)) {
                            val = val.split(item.id).join(item.en);
                        }
                    }
                    el.placeholder = val;
                } else {
                    el.placeholder = el._origPlaceholder;
                }
            });

            // Replace page title
            if (typeof document._origTitle === 'undefined') {
                document._origTitle = document.title;
            }
            if (isEn) {
                let titleVal = document._origTitle;
                for (let i = 0; i < appTranslations.length; i++) {
                    const item = appTranslations[i];
                    if (titleVal.includes(item.id)) {
                        titleVal = titleVal.split(item.id).join(item.en);
                    }
                }
                document.title = titleVal;
            } else {
                document.title = document._origTitle;
            }
        }

        function setSiteLanguage(lang) {
            localStorage.setItem('site_lang', lang);
            document.cookie = "site_lang=" + lang + "; path=/; max-age=31536000";
            if (lang === 'en') {
                document.cookie = "googtrans=/id/en; path=/";
                document.cookie = "googtrans=/id/en; domain=" + window.location.hostname + "; path=/";
            } else {
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + window.location.hostname + "; path=/;";
            }
            applySiteLanguage(lang);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Setup interactive click toggle for language dropdown button
            const langBtn = document.getElementById('currentLangBtn');
            const langSelector = document.querySelector('.language-selector');
            const langDropdown = document.querySelector('.lang-dropdown');
            if (langBtn && langDropdown) {
                langBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    langDropdown.classList.toggle('show');
                    if (langSelector) langSelector.classList.toggle('active');
                });
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.language-selector')) {
                        langDropdown.classList.remove('show');
                        if (langSelector) langSelector.classList.remove('active');
                    }
                });
            }

            // Apply saved or current language
            const currentLang = localStorage.getItem('site_lang') || (document.cookie.indexOf('site_lang=en') !== -1 ? 'en' : 'id');
            if (currentLang === 'en') {
                applySiteLanguage('en');
            }
        });

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>

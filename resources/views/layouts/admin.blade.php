<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Rama Homestay</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0; padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        .admin-wrapper { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .admin-sidebar {
            width: 260px;
            background: #0f172a;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 28px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            flex-shrink: 0;
        }
        .sidebar-brand-logo {
            font-size: 2rem;
            font-family: 'Times New Roman', serif;
            color: #fff;
            line-height: 1; font-weight: 700;
        }
        .sidebar-brand-sub {
            font-size: 0.7rem;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: #f5a623;
            margin-top: 2px;
            display: block;
        }
        .sidebar-section-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #475569;
            font-weight: 800;
            padding: 20px 24px 8px;
        }
        .sidebar-nav { list-style: none; padding: 0 12px; margin: 0; }
        .sidebar-nav li { margin-bottom: 2px; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem; font-weight: 600;
            transition: all 0.2s ease;
        }
        .sidebar-nav a:hover { background: rgba(255,255,255,0.07); color: #f8fafc; }
        .sidebar-nav a.active { background: rgba(245,166,35,0.15); color: #f5a623; }
        .sidebar-nav a i { width: 18px; height: 18px; flex-shrink: 0; stroke-width: 2px; }
        .sidebar-divider { border:0; border-top:1px solid rgba(255,255,255,0.07); margin:12px; }
        .sidebar-logout { padding: 12px; }
        .sidebar-logout form button {
            display: flex; align-items: center; gap: 12px;
            width: 100%; padding: 12px 14px;
            background: transparent; border: none; border-radius: 10px;
            color: #ef4444; font-size: 0.9rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s ease; font-family: inherit;
        }
        .sidebar-logout form button:hover { background: rgba(239,68,68,0.1); }
        .sidebar-logout form button i { width: 18px; height: 18px; stroke-width: 2px; }

        /* MAIN */
        .admin-main {
            margin-left: 260px;
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
        }

        /* TOP BAR */
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 32px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .admin-topbar-title { font-size: 1.1rem; font-weight: 800; color: #0f172a; }
        .admin-topbar-user {
            display: flex; align-items: center; gap: 10px;
            font-size: 0.88rem; font-weight: 600; color: #475569;
        }
        .admin-topbar-avatar {
            width: 36px; height: 36px;
            background: rgba(245,166,35,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #f5a623;
        }

        /* PAGE CONTENT */
        .admin-page-content { padding: 36px 40px; flex: 1; }

        /* ALERTS */
        .admin-alert-success {
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px;
            color: #15803d; padding: 14px 20px; margin-bottom: 24px;
            font-weight: 600; font-size: 0.92rem;
            display: flex; align-items: center; gap: 10px;
        }
        .admin-alert-error {
            background: #fef2f2; border: 1px solid #fecaca; border-radius: 12px;
            color: #dc2626; padding: 14px 20px; margin-bottom: 24px;
            font-weight: 600; font-size: 0.92rem;
            display: flex; align-items: center; gap: 10px;
        }

        /* CARD */
        .admin-card {
            background: #fff; border-radius: 16px;
            border: 1px solid #e2e8f0; padding: 28px 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        /* STAT */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px; margin-bottom: 28px;
        }
        .stat-card {
            background: #fff; border-radius: 16px; border: 1px solid #e2e8f0;
            padding: 22px;
            display: flex; justify-content: space-between; align-items: center;
            transition: all 0.25s ease;
        }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
        .stat-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #64748b; margin: 0 0 6px; }
        .stat-value { font-size: 1.9rem; font-weight: 800; color: #0f172a; margin: 0; }
        .stat-icon-wrap { width: 50px; height: 50px; border-radius: 14px; display: flex; align-items: center; justify-content: center; }

        /* TABLE */
        .admin-table-wrap { overflow-x: auto; }
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table thead tr { border-bottom: 2px solid #f1f5f9; }
        .admin-table th { padding: 14px 12px; color: #64748b; font-weight: 700; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 1px; text-align: left; }
        .admin-table tbody tr { border-bottom: 1px solid #f8fafc; transition: background 0.15s; }
        .admin-table tbody tr:hover { background: #f8fafc; }
        .admin-table td { padding: 16px 12px; font-size: 0.9rem; vertical-align: middle; }

        /* BADGES */
        .badge { display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-pending   { background: rgba(245,158,11,0.1); color: #d97706; }
        .badge-confirmed { background: rgba(59,130,246,0.1); color: #2563eb; }
        .badge-completed { background: rgba(16,185,129,0.1); color: #059669; }
        .badge-cancelled { background: rgba(239,68,68,0.1); color: #dc2626; }
        .badge-paid   { background: rgba(16,185,129,0.12); color: #059669; }
        .badge-unpaid { background: rgba(245,158,11,0.12); color: #d97706; }

        /* BUTTONS */
        .btn-admin-primary {
            background: #f5a623; color: #fff; border: none; border-radius: 10px;
            padding: 9px 18px; font-size: 0.88rem; font-weight: 700;
            cursor: pointer; font-family: inherit; transition: all 0.2s ease;
            text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        }
        .btn-admin-primary:hover { background: #e0951a; transform: translateY(-1px); }
        .btn-admin-outline {
            background: transparent; color: #475569; border: 1.5px solid #e2e8f0;
            border-radius: 10px; padding: 9px 16px; font-size: 0.88rem; font-weight: 600;
            cursor: pointer; font-family: inherit; transition: all 0.2s ease;
            text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        }
        .btn-admin-outline:hover { border-color: #f5a623; color: #f5a623; }
        .btn-admin-danger {
            background: #fef2f2; color: #dc2626; border: 1.5px solid #fecaca;
            border-radius: 10px; padding: 9px 16px; font-size: 0.88rem; font-weight: 700;
            cursor: pointer; font-family: inherit; transition: all 0.2s ease;
            text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        }
        .btn-admin-danger:hover { background: #fee2e2; }
        .btn-admin-info {
            background: rgba(59,130,246,0.08); color: #2563eb; border: 1.5px solid rgba(59,130,246,0.2);
            border-radius: 10px; padding: 9px 16px; font-size: 0.88rem; font-weight: 700;
            cursor: pointer; font-family: inherit; transition: all 0.2s ease;
            text-decoration: none; display: inline-flex; align-items: center; gap: 7px;
        }
        .btn-admin-info:hover { background: rgba(59,130,246,0.15); }

        .form-select-admin {
            padding: 8px 12px; border-radius: 9px; border: 1px solid #cbd5e1;
            font-size: 0.88rem; font-weight: 600; color: #334155;
            background: #fff; font-family: inherit; outline: none; cursor: pointer;
        }

        @media print {
            .admin-sidebar, .admin-topbar, .no-print { display: none !important; }
            .admin-main { margin-left: 0 !important; }
            .admin-page-content { padding: 0 !important; }
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="admin-wrapper">
    {{-- SIDEBAR --}}
    <aside class="admin-sidebar no-print">
        <div class="sidebar-brand">
            <div class="sidebar-brand-logo">R</div>
            <span class="sidebar-brand-sub">Rama Homestay</span>
        </div>

        <div class="sidebar-section-label">Menu Utama</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i><span>Ringkasan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.rooms.index') }}" class="{{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                    <i data-lucide="door-open"></i><span>Kelola Kamar</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
                    <i data-lucide="calendar-check"></i><span>Kelola Reservasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                    <i data-lucide="bar-chart-2"></i><span>Laporan</span>
                </a>
            </li>
        </ul>

        <hr class="sidebar-divider" style="margin-top:auto;">
        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i data-lucide="log-out"></i><span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="admin-main">
        <div class="admin-topbar no-print">
            <div class="admin-topbar-title">@yield('page_title', 'Dashboard Admin')</div>
            <div style="display:flex; align-items:center; gap:16px;">
                <!-- Language Toggle -->
                <div style="display:inline-flex; align-items:center; background:#f1f5f9; border-radius:20px; padding:3px; border:1px solid #e2e8f0; font-size:0.75rem; font-weight:700;">
                    <button type="button" onclick="setSiteLanguage('id')" id="adminLangID" style="border:none; background:#fff; color:#0f172a; padding:4px 10px; border-radius:16px; cursor:pointer; font-weight:700; box-shadow:0 1px 2px rgba(0,0,0,0.06); transition:all 0.2s;">ID</button>
                    <button type="button" onclick="setSiteLanguage('en')" id="adminLangEN" style="border:none; background:transparent; color:#64748b; padding:4px 10px; border-radius:16px; cursor:pointer; font-weight:700; transition:all 0.2s;">EN</button>
                </div>

                <div class="admin-topbar-user">
                    <div class="admin-topbar-avatar">
                        <i data-lucide="user" style="width:18px;height:18px;"></i>
                    </div>
                    <span>{{ auth()->user()->name }}</span>
                    <span style="color:#cbd5e1;">|</span>
                    <span style="color:#f5a623;font-size:0.75rem;font-weight:800;">ADMIN</span>
                </div>
            </div>
        </div>

        <div class="admin-page-content">
            @if(session('success'))
                <div class="admin-alert-success">
                    <i data-lucide="check-circle" style="width:18px;height:18px;"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="admin-alert-error">
                    <i data-lucide="alert-circle" style="width:18px;height:18px;"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

<script>lucide.createIcons();</script>

    <!-- Google Translate Integration -->
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
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en',
                autoDisplay: false
            }, 'google_translate_element');
        }

        function setSiteLanguage(lang) {
            if (lang === 'en') {
                document.cookie = "googtrans=/id/en; path=/";
                document.cookie = "googtrans=/id/en; domain=" + window.location.hostname + "; path=/";
                localStorage.setItem('site_lang', 'en');
            } else {
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + window.location.hostname + "; path=/;";
                localStorage.setItem('site_lang', 'id');
            }
            window.location.reload();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const isEnglish = document.cookie.indexOf('googtrans=/id/en') !== -1 || localStorage.getItem('site_lang') === 'en';
            const btnID = document.getElementById('adminLangID');
            const btnEN = document.getElementById('adminLangEN');
            if (isEnglish) {
                if (btnID) { btnID.style.background = 'transparent'; btnID.style.color = '#64748b'; btnID.style.boxShadow = 'none'; }
                if (btnEN) { btnEN.style.background = '#fff'; btnEN.style.color = '#0f172a'; btnEN.style.boxShadow = '0 1px 2px rgba(0,0,0,0.06)'; }
            } else {
                if (btnID) { btnID.style.background = '#fff'; btnID.style.color = '#0f172a'; btnID.style.boxShadow = '0 1px 2px rgba(0,0,0,0.06)'; }
                if (btnEN) { btnEN.style.background = 'transparent'; btnEN.style.color = '#64748b'; btnEN.style.boxShadow = 'none'; }
            }
        });
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@stack('scripts')
</body>
</html>

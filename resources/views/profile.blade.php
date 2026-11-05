@extends('layouts.app')

@section('title', 'Profil Saya - Rama Homestay')

@section('content')
<style>
    .profile-wrapper {
        padding: 40px 0 80px;
        background: #f8fafc;
        min-height: 80vh;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 28px;
        align-items: start;
    }

    @media (max-width: 900px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    /* SIDEBAR CARD */
    .profile-sidebar {
        background: #ffffff;
        border-radius: 20px;
        padding: 28px 22px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        border: 1px solid #e2e8f0;
    }

    .profile-avatar-wrap {
        text-align: center;
        padding-bottom: 22px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 20px;
    }

    .profile-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, #ffc15e 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
        color: white;
        font-weight: 800;
        font-size: 1.5rem;
        box-shadow: 0 10px 22px -5px rgba(245, 166, 35, 0.35);
    }

    .profile-menu {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .profile-menu-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border-radius: 12px;
        color: #475569;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .profile-menu-link:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .profile-menu-link.active {
        background: rgba(245, 166, 35, 0.12);
        color: var(--primary);
        font-weight: 700;
    }

    /* MAIN FORM CARD */
    .profile-main-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 36px 40px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        border: 1px solid #e2e8f0;
    }

    @media (max-width: 640px) {
        .profile-main-card {
            padding: 24px 20px;
        }
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 1.5px solid #f1f5f9;
    }

    .section-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(245, 166, 35, 0.12);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    /* INPUT GROUP WITH ICON */
    .input-field-group {
        position: relative;
        margin-bottom: 20px;
    }

    .input-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #475569;
        margin-bottom: 8px;
    }

    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon-box {
        position: absolute;
        left: 14px;
        color: #94a3b8;
        pointer-events: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-input {
        width: 100%;
        padding: 13px 16px 13px 44px;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        font-size: 0.92rem;
        font-family: inherit;
        color: #0f172a;
        background: #ffffff;
        transition: all 0.2s ease;
        outline: none;
        box-sizing: border-box;
    }

    .profile-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.15);
        background: #fff;
    }

    .profile-input.has-error {
        border-color: #ef4444;
        background: #fff5f5;
    }

    .input-hint {
        font-size: 0.78rem;
        color: #64748b;
        margin-top: 6px;
    }

    .error-feedback {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 6px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .form-two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 640px) {
        .form-two-col {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }

    .btn-submit-profile {
        padding: 14px 28px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary) 0%, #d97706 100%);
        color: #ffffff;
        border: none;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(245, 166, 35, 0.28);
        font-family: inherit;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .btn-submit-profile:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(245, 166, 35, 0.35);
    }

    .btn-back-dashboard {
        padding: 13px 22px;
        border-radius: 12px;
        background: transparent;
        color: #475569;
        border: 1.5px solid #cbd5e1;
        font-weight: 700;
        text-decoration: none;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .btn-back-dashboard:hover {
        background: #f1f5f9;
        color: #0f172a;
    }
</style>

<div class="profile-wrapper">
    <div class="container" style="max-width: 1040px; margin: 0 auto; padding: 0 20px;">

        {{-- Page Header --}}
        <div style="margin-bottom: 28px;">
            <div style="display:inline-flex; align-items:center; gap:6px; font-size:0.75rem; text-transform:uppercase; letter-spacing:1.5px; font-weight:800; color:var(--primary); margin-bottom:6px;">
                <i data-lucide="shield-check" style="width:14px; height:14px;"></i>
                <span>Area Tamu Rama Homestay</span>
            </div>
            <h1 style="font-size: 2rem; font-weight: 800; color: #0f172a; margin: 0 0 6px 0; font-family:'Playfair Display', Georgia, serif;">
                Profil &amp; Pengaturan Akun
            </h1>
            <p style="color: #64748b; font-size: 0.92rem; margin: 0; line-height: 1.5;">
                Kelola data pribadi, nomor WhatsApp, dan kata sandi akun Anda untuk kenyamanan proses reservasi.
            </p>
        </div>

        <div class="profile-grid">

            {{-- ============================ --}}
            {{-- SIDEBAR AKUN TAMU            --}}
            {{-- ============================ --}}
            <aside class="profile-sidebar">
                <div class="profile-avatar-wrap">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: #0f172a; margin: 0 0 4px 0;">
                        {{ $user->name }}
                    </h3>
                    <p style="font-size: 0.8rem; color: #64748b; margin: 0 0 10px 0; word-break: break-all;">
                        {{ $user->email }}
                    </p>
                    <span style="display:inline-flex; align-items:center; gap:4px; font-size:0.7rem; font-weight:700; background:#dcfce7; color:#166534; padding:3px 10px; border-radius:20px; border:1px solid #bbf7d0;">
                        <i data-lucide="check" style="width:11px; height:11px;"></i> Tamu Terdaftar
                    </span>
                    <div style="font-size:0.72rem; color:#94a3b8; margin-top:8px;">
                        Bergabung: {{ $user->created_at ? $user->created_at->format('M Y') : 'Member' }}
                    </div>
                </div>

                <nav class="profile-menu">
                    <a href="{{ route('profile') }}" class="profile-menu-link active">
                        <i data-lucide="user-cog" style="width:18px; height:18px;"></i>
                        <span>Profil Saya</span>
                    </a>

                    <a href="{{ route('tamu.dashboard') }}" class="profile-menu-link">
                        <i data-lucide="calendar-check" style="width:18px; height:18px;"></i>
                        <span>Reservasi Saya</span>
                    </a>

                    <a href="{{ route('rooms.index') }}" class="profile-menu-link">
                        <i data-lucide="door-open" style="width:18px; height:18px;"></i>
                        <span>Pesan Kamar Baru</span>
                    </a>

                    <hr style="margin: 12px 0; border: 0; border-top: 1px solid #f1f5f9;">

                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="profile-menu-link" style="width:100%; border:none; background:transparent; cursor:pointer; color:#ef4444; font-family:inherit; text-align:left;">
                            <i data-lucide="log-out" style="width:18px; height:18px;"></i>
                            <span>Keluar Akun</span>
                        </button>
                    </form>
                </nav>
            </aside>

            {{-- ============================ --}}
            {{-- MAIN FORM AREA               --}}
            {{-- ============================ --}}
            <main class="profile-main-card">

                {{-- Alert Sukses --}}
                @if(session('success'))
                    <div style="background: #f0fdf4; border: 1.5px solid #bbf7d0; color: #166534; padding: 14px 18px; border-radius: 14px; display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 0.9rem; margin-bottom: 24px;">
                        <i data-lucide="check-circle" style="width: 20px; height: 20px; color: #16a34a; flex-shrink:0;"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Alert Error Global --}}
                @if(isset($errors) && $errors->any())
                    <div style="background: #fef2f2; border: 1.5px solid #fecaca; color: #991b1b; padding: 14px 18px; border-radius: 14px; margin-bottom: 24px;">
                        <div style="display:flex; align-items:center; gap:8px; font-weight:800; font-size:0.9rem; margin-bottom:4px;">
                            <i data-lucide="alert-circle" style="width:18px; height:18px; color:#ef4444;"></i>
                            <span>Periksa kembali data formulir:</span>
                        </div>
                        <ul style="margin:0; padding-left:24px; font-size:0.83rem;">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf

                    {{-- SECTION 1: DATA KONTAK --}}
                    <div class="section-header">
                        <div class="section-icon">
                            <i data-lucide="user" style="width: 18px; height: 18px;"></i>
                        </div>
                        <h2 class="section-title">Data Kontak &amp; Pribadi</h2>
                    </div>

                    <div class="form-two-col">
                        <!-- Nama Lengkap -->
                        <div class="input-field-group">
                            <label class="input-label" for="name">Nama Lengkap</label>
                            <div class="input-with-icon">
                                <div class="input-icon-box">
                                    <i data-lucide="user" style="width:18px; height:18px;"></i>
                                </div>
                                <input type="text" id="name" name="name" 
                                       class="profile-input @error('name') has-error @enderror" 
                                       value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama lengkap Anda">
                            </div>
                            @error('name')
                                <div class="error-feedback">
                                    <i data-lucide="alert-circle" style="width:13px; height:13px;"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="input-field-group">
                            <label class="input-label" for="email">Alamat Email</label>
                            <div class="input-with-icon">
                                <div class="input-icon-box">
                                    <i data-lucide="mail" style="width:18px; height:18px;"></i>
                                </div>
                                <input type="email" id="email" name="email" 
                                       class="profile-input @error('email') has-error @enderror" 
                                       value="{{ old('email', $user->email) }}" required placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <div class="error-feedback">
                                    <i data-lucide="alert-circle" style="width:13px; height:13px;"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="input-field-group">
                        <label class="input-label" for="phone">Nomor Telepon / WhatsApp</label>
                        <div class="input-with-icon">
                            <div class="input-icon-box">
                                <i data-lucide="phone" style="width:18px; height:18px;"></i>
                            </div>
                            <input type="tel" id="phone" name="phone" 
                                   class="profile-input @error('phone') has-error @enderror" 
                                   value="{{ old('phone', $user->phone) }}" required placeholder="Contoh: 081234567890">
                        </div>
                        <div class="input-hint">Nomor aktif ini digunakan admin homestay untuk konfirmasi dan panduan check-in.</div>
                        @error('phone')
                            <div class="error-feedback">
                                <i data-lucide="alert-circle" style="width:13px; height:13px;"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- SECTION 2: GANTI KATA SANDI --}}
                    <div class="section-header" style="margin-top: 36px;">
                        <div class="section-icon" style="background: rgba(59, 130, 246, 0.1); color: #2563eb;">
                            <i data-lucide="shield" style="width: 18px; height: 18px;"></i>
                        </div>
                        <div>
                            <h2 class="section-title">Keamanan &amp; Kata Sandi</h2>
                        </div>
                    </div>

                    <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 12px 16px; margin-bottom: 20px; font-size: 0.83rem; color: #64748b; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="info" style="width:16px; height:16px; color:#0284c7; flex-shrink:0;"></i>
                        <span>Kosongkan kolom di bawah jika Anda <strong>tidak ingin mengubah</strong> kata sandi akun Anda.</span>
                    </div>

                    <div class="form-two-col">
                        <!-- Password Baru -->
                        <div class="input-field-group">
                            <label class="input-label" for="password">Kata Sandi Baru</label>
                            <div class="input-with-icon">
                                <div class="input-icon-box">
                                    <i data-lucide="lock" style="width:18px; height:18px;"></i>
                                </div>
                                <input type="password" id="password" name="password" 
                                       class="profile-input @error('password') has-error @enderror" 
                                       placeholder="Minimal 8 karakter">
                            </div>
                            @error('password')
                                <div class="error-feedback">
                                    <i data-lucide="alert-circle" style="width:13px; height:13px;"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="input-field-group">
                            <label class="input-label" for="password_confirmation">Ulangi Kata Sandi Baru</label>
                            <div class="input-with-icon">
                                <div class="input-icon-box">
                                    <i data-lucide="check-circle-2" style="width:18px; height:18px;"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                       class="profile-input" 
                                       placeholder="Ketik ulang kata sandi baru">
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL AKSI --}}
                    <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;">
                        <button type="submit" class="btn-submit-profile">
                            <i data-lucide="save" style="width: 18px; height: 18px;"></i>
                            <span>Simpan Perubahan</span>
                        </button>

                        <a href="{{ route('tamu.dashboard') }}" class="btn-back-dashboard">
                            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
                            <span>Kembali ke Dashboard</span>
                        </a>
                    </div>

                </form>

            </main>

        </div>
    </div>
</div>
@endsection

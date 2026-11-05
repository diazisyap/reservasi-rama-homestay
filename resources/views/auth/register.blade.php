@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="auth-wrapper">
    <div class="auth-overlay"></div>
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-logo">
                    <i data-lucide="user-plus" class="logo-icon"></i>
                </div>
                <h2>Buat Akun Baru</h2>
                <p>Bergabunglah dengan kami untuk kemudahan reservasi homestay</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <div class="input-with-icon">
                        <i data-lucide="user" class="input-icon"></i>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                               placeholder="Nama lengkap Anda" value="{{ old('name') }}" required autofocus>
                    </div>
                    @error('name')
                        <div class="error-message">
                            <i data-lucide="alert-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email</label>
                    <div class="input-with-icon">
                        <i data-lucide="mail" class="input-icon"></i>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i data-lucide="alert-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <div class="input-with-icon">
                        <i data-lucide="phone" class="input-icon"></i>
                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               placeholder="Contoh: 08123456789" value="{{ old('phone') }}" required>
                    </div>
                    @error('phone')
                        <div class="error-message">
                            <i data-lucide="alert-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Kata Sandi</label>
                    <div class="input-with-icon">
                        <i data-lucide="key-round" class="input-icon"></i>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Min. 8 karakter" required>
                        <button type="button" id="toggle-password" class="password-toggle-btn" tabindex="-1" aria-label="Tampilkan kata sandi">
                            <i data-lucide="eye" class="toggle-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i data-lucide="alert-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="input-with-icon">
                        <i data-lucide="shield-check" class="input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                               placeholder="Ulangi kata sandi" required>
                        <button type="button" id="toggle-password-conf" class="password-toggle-btn" tabindex="-1" aria-label="Tampilkan konfirmasi kata sandi">
                            <i data-lucide="eye" class="toggle-icon"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-login">
                    <span>Daftar Sekarang</span>
                    <i data-lucide="user-check" class="btn-arrow"></i>
                </button>
            </form>
            
            <div class="auth-footer">
                Sudah punya akun? <a href="{{ route('login') }}" class="register-link">Masuk di sini</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Scenic mountain background with smooth overlay */
    .auth-wrapper {
        min-height: calc(100vh - 162px);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background-image: url('{{ asset('images/auth-bg.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 35px 15px;
        overflow: hidden;
    }

    /* Soft dimming overlay for contrast & readability */
    .auth-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.35) 0%, rgba(15, 23, 42, 0.65) 100%);
        z-index: 0;
    }

    /* Transparent glassmorphism card (frosted glass) */
    .auth-card {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.82);
        backdrop-filter: blur(16px) saturate(180%);
        -webkit-backdrop-filter: blur(16px) saturate(180%);
        border: 1px solid rgba(255, 255, 255, 0.65);
        max-width: 410px;
        width: 100%;
        margin: 0 auto;
        padding: 28px 24px;
        border-radius: 18px;
        box-shadow: 
            0 20px 40px -10px rgba(0, 0, 0, 0.35),
            inset 0 1px 0 rgba(255, 255, 255, 0.8);
        animation: fadeInUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Compact header */
    .auth-header {
        text-align: center;
        margin-bottom: 18px;
    }

    .auth-logo {
        width: 46px;
        height: 46px;
        background: linear-gradient(135deg, var(--primary) 0%, #ffc15e 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        box-shadow: 0 4px 12px -2px rgba(245, 166, 35, 0.4);
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .auth-card:hover .auth-logo {
        transform: scale(1.05) rotate(5deg);
    }

    .logo-icon {
        color: white;
        width: 22px;
        height: 22px;
    }

    .auth-header h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px 0;
        letter-spacing: -0.3px;
    }

    .auth-header p {
        color: #64748b;
        font-size: 0.8rem;
        line-height: 1.4;
        margin: 0;
    }

    /* Compact Form Fields */
    .auth-form .form-group {
        margin-bottom: 12px;
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 0.68rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        transition: color 0.3s;
    }

    .input-with-icon {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 12px;
        width: 16px;
        height: 16px;
        color: #64748b;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .form-control {
        width: 100%;
        padding: 9px 12px 9px 38px;
        background: rgba(255, 255, 255, 0.92);
        border: 1.5px solid rgba(203, 213, 225, 0.9);
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #0f172a;
        transition: all 0.25s ease;
    }

    .form-control::placeholder {
        color: #94a3b8;
    }

    .form-control:focus {
        background: #ffffff;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(245, 166, 35, 0.15);
        outline: none;
    }

    .form-control:focus + .input-icon {
        color: var(--primary);
    }

    .form-control.is-invalid {
        border-color: #ef4444;
        background-color: rgba(254, 242, 242, 0.8);
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
    }

    /* Compact password eye button */
    .password-toggle-btn {
        position: absolute;
        right: 8px;
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .password-toggle-btn .toggle-icon {
        width: 16px;
        height: 16px;
    }

    .password-toggle-btn:hover {
        color: var(--primary);
        background-color: rgba(245, 166, 35, 0.08);
    }

    .password-toggle-btn:focus {
        outline: none;
    }

    /* Error Validation Alerts */
    .error-message {
        color: #ef4444;
        font-size: 0.78rem;
        font-weight: 600;
        margin-top: 4px;
        display: flex;
        align-items: flex-start;
        gap: 5px;
        animation: fadeInDown 0.3s ease-out;
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .error-message i {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* Compact register button */
    .btn-login {
        width: 100%;
        padding: 10px 14px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
        color: white !important;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-top: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        border: none;
        cursor: pointer;
        box-shadow: 0 3px 10px rgba(245, 166, 35, 0.25);
        transition: all 0.25s ease;
    }

    .btn-login:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(245, 166, 35, 0.35);
    }

    .btn-login:active {
        transform: translateY(0) scale(0.99);
    }

    .btn-arrow {
        width: 16px;
        height: 16px;
        transition: transform 0.3s ease;
    }

    .btn-login:hover .btn-arrow {
        transform: translateX(3px);
    }

    /* Compact footer */
    .auth-footer {
        margin-top: 16px;
        text-align: center;
        color: #334155;
        font-size: 0.82rem;
        font-weight: 600;
        border-top: 1px solid rgba(226, 232, 240, 0.8);
        padding-top: 12px;
    }

    .register-link {
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s;
    }

    .register-link:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    /* Responsive adjustments */
    @media (max-width: 480px) {
        .auth-wrapper {
            padding: 20px 12px;
        }

        .auth-card {
            padding: 22px 16px;
            border-radius: 12px;
        }

        .auth-header h2 {
            font-size: 1.2rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main password toggle
        const toggleBtn = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        
        if (toggleBtn && passwordInput) {
            toggleBtn.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                const icon = toggleBtn.querySelector('.toggle-icon');
                if (type === 'text') {
                    icon.setAttribute('data-lucide', 'eye-off');
                } else {
                    icon.setAttribute('data-lucide', 'eye');
                }
                
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        }

        // Confirmation password toggle
        const toggleConfBtn = document.getElementById('toggle-password-conf');
        const confInput = document.getElementById('password_confirmation');
        
        if (toggleConfBtn && confInput) {
            toggleConfBtn.addEventListener('click', function() {
                const type = confInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confInput.setAttribute('type', type);
                
                const icon = toggleConfBtn.querySelector('.toggle-icon');
                if (type === 'text') {
                    icon.setAttribute('data-lucide', 'eye-off');
                } else {
                    icon.setAttribute('data-lucide', 'eye');
                }
                
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });
        }
    });
</script>
@endsection

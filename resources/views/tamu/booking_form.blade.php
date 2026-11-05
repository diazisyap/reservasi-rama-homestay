@extends('layouts.app')

@section('title', 'Pesan Kamar - Multi-Step Checkout')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_orange.css">

<!-- Custom Page CSS and styling context -->
<style>
    .checkout-wrapper {
        padding: 45px 0 80px 0;
        background: #f8fafc;
        min-height: 100vh;
    }
    
    /* Interactive Process Timeline */
    .timeline-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
        padding: 24px 30px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.02);
        border: 1px solid #e2e8f0;
        margin-bottom: 40px;
        overflow-x: auto;
    }
    
    .timeline-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        flex: 1;
        position: relative;
        min-width: 100px;
    }
    
    .timeline-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 20px;
        right: -50%;
        width: 100%;
        height: 3px;
        background: #cbd5e1;
        z-index: 1;
        transition: background 0.3s ease;
    }
    
    .timeline-step.active:not(:last-child)::after,
    .timeline-step.completed:not(:last-child)::after {
        background: var(--primary);
    }
    
    .step-badge {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #cbd5e1;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.05rem;
        z-index: 2;
        border: 4px solid #fff;
        box-shadow: 0 0 0 1px #cbd5e1;
        transition: all 0.3s ease;
    }
    
    .timeline-step.active .step-badge {
        background: var(--primary);
        color: white;
        box-shadow: 0 0 0 1px var(--primary), 0 8px 16px rgba(245, 166, 35, 0.25);
    }
    
    .timeline-step.completed .step-badge {
        background: #10b981;
        color: white;
        box-shadow: 0 0 0 1px #10b981;
    }
    
    .step-title {
        font-size: 0.78rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-top: 10px;
        transition: color 0.3s ease;
    }
    
    .timeline-step.active .step-title {
        color: var(--primary);
    }
    
    .timeline-step.completed .step-title {
        color: #10b981;
    }

    /* Checkout Card Structure */
    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 30px;
        align-items: start;
    }
    
    .step-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
        display: none;
        animation: cardSlide 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    .step-card.active {
        display: block;
    }
    
    @keyframes cardSlide {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .summary-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.03);
        border: 1px solid #e2e8f0;
        position: sticky;
        top: 120px;
    }
    
    .payment-method-card {
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.25s ease;
        margin-bottom: 15px;
        position: relative;
    }
    
    .payment-method-card:hover {
        border-color: #cbd5e1;
        background: #fafafa;
    }
    
    .payment-method-card.selected {
        border-color: var(--primary);
        background: rgba(245, 166, 35, 0.04);
    }
    
    .payment-method-card input[type="radio"] {
        position: absolute;
        right: 20px;
        width: 20px;
        height: 20px;
        accent-color: var(--primary);
    }
    
    .payment-logo {
        width: 60px;
        height: 35px;
        object-fit: contain;
        background: #f1f5f9;
        padding: 4px;
        border-radius: 6px;
    }
    
    .btn-step-nav {
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        font-family: inherit;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        border: none;
    }
    
    .btn-step-next {
        background: var(--primary);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 166, 35, 0.2);
    }
    .btn-step-next:hover {
        background: #e0921b;
    }
    
    .btn-step-prev {
        background: #e2e8f0;
        color: #475569;
    }
    .btn-step-prev:hover {
        background: #cbd5e1;
    }

    /* ===== Modal Ubah Tanggal ===== */
    .date-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(4px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .date-modal-overlay.open {
        display: flex;
        animation: fadeInOverlay 0.22s ease;
    }
    @keyframes fadeInOverlay {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .date-modal {
        background: #ffffff;
        border-radius: 24px;
        padding: 36px 40px;
        box-shadow: 0 24px 60px rgba(0,0,0,0.18);
        width: 100%;
        max-width: 500px;
        animation: slideUpModal 0.3s cubic-bezier(0.16,1,0.3,1);
        position: relative;
    }
    @media (max-width: 520px) {
        .date-modal {
            padding: 24px 20px;
            border-radius: 20px;
        }
        .date-modal-grid {
            grid-template-columns: 1fr !important;
            gap: 12px !important;
        }
    }
    @keyframes slideUpModal {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .date-modal-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 6px;
    }
    .date-modal-sub {
        font-size: 0.88rem;
        color: #64748b;
        margin: 0 0 28px;
    }
    .date-modal-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }
    .date-modal-label {
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #475569;
        display: block;
        margin-bottom: 7px;
    }
    .date-modal-input {
        width: 100%;
        padding: 13px 16px;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        color: #0f172a;
        background: #f8fafc;
        box-sizing: border-box;
        transition: all 0.2s ease;
    }
    .date-modal-input:focus {
        border-color: var(--primary);
        outline: none;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(245,166,35,0.12);
    }
    .date-modal-error {
        font-size: 0.82rem;
        color: #dc2626;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 10px 14px;
        margin-bottom: 16px;
        display: none;
    }
    .date-modal-preview {
        background: rgba(245,166,35,0.08);
        border: 1px solid rgba(245,166,35,0.25);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.88rem;
        color: #92400e;
        font-weight: 700;
        margin-bottom: 22px;
        display: none;
    }
    .date-modal-actions {
        display: flex;
        gap: 12px;
    }
    .btn-modal-cancel {
        flex: 1;
        padding: 13px;
        background: #f1f5f9;
        color: #475569;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-family: inherit;
        font-size: 0.95rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-modal-cancel:hover { background: #e2e8f0; }
    .btn-modal-confirm {
        flex: 2;
        padding: 13px;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-family: inherit;
        font-size: 0.95rem;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(245,166,35,0.25);
        transition: all 0.2s;
    }
    .btn-modal-confirm:hover { background: #b45309; transform: translateY(-1px); }
    .btn-ubah-tanggal {
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--primary);
        background: rgba(245,166,35,0.07);
        border: 1px solid rgba(245,166,35,0.3);
        padding: 6px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-ubah-tanggal:hover { background: rgba(245,166,35,0.15); border-color: var(--primary); }
</style>

<div class="checkout-wrapper">
    <div class="container">

        {{-- Server Validation Errors --}}
        @if($errors->any())
            <div style="background:#fef2f2; border:1.5px solid #fecaca; border-radius:14px; padding:18px 22px; margin-bottom:25px; color:#991b1b; box-shadow:0 4px 12px rgba(239,68,68,0.08);">
                <div style="font-weight:800; font-size:1rem; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                    <i data-lucide="alert-octagon" style="width:20px;height:20px;color:#dc2626;"></i>
                    <span>Pemesanan Tidak Dapat Diproses:</span>
                </div>
                <ul style="margin:0; padding-left:22px; font-size:0.92rem; line-height:1.6;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tamu.book.confirm') }}" method="POST" id="bookingMultiStepForm">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            
            <div class="checkout-grid">
                
                <!-- Main Flow Content Steps -->
                <div>

                    <!-- Step 2: Detail & Data Tamu -->
                    <div class="step-card active" id="step-2-card">
                        <h2 style="font-size:1.6rem; font-weight:700; color:#0f172a; margin:0 0 8px 0;">Detail & Data Tamu</h2>
                        <p style="color:#64748b; font-size:0.95rem; margin-bottom:25px;">Tentukan tanggal menginap dan periksa data diri Anda sebelum melanjutkan.</p>

                        {{-- Alert Jika Jadwal Sedang Bertabrakan dengan Reservasi Lain --}}
                        <div id="date-conflict-warning" style="display: {{ $isCurrentAvailable ? 'none' : 'block' }}; background: #fef2f2; border: 1.5px solid #f87171; border-radius: 14px; padding: 18px 22px; margin-bottom: 24px; color: #991b1b;">
                            <div style="display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1rem; margin-bottom: 6px;">
                                <i data-lucide="alert-triangle" style="width: 22px; height: 22px; color: #dc2626;"></i>
                                <span>Kamar Sudah Terisi pada Tanggal Ini!</span>
                            </div>
                            <p style="margin: 0 0 12px; font-size: 0.92rem; line-height: 1.6; color: #7f1d1d;">
                                Maaf, kamar <strong>{{ $room->name }}</strong> sudah terisi / memiliki reservasi pada jadwal yang dipilih (<span class="jadwal-conflict-text">{{ \Carbon\Carbon::parse($checkIn)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($checkOut)->format('d M Y') }}</span>). Anda <strong>tidak dapat melanjutkan booking</strong> sebelum mengubah tanggal.
                            </p>
                            <button type="button" class="btn-ubah-tanggal" onclick="openDateModal()" style="background:#fee2e2; border-color:#fca5a5; color:#991b1b; padding:8px 18px; font-size:0.88rem;">
                                <i data-lucide="calendar" style="width:15px;height:15px;"></i> Klik untuk Ubah Tanggal
                            </button>
                        </div>

                        {{-- Informasi Jadwal Check-in & Check-out --}}
                        <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 20px 24px; margin-bottom: 26px; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(245, 166, 35, 0.15); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i data-lucide="calendar" style="width: 24px; height: 24px;"></i>
                                    </div>
                                    <div>
                                        <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; color: #64748b; display: block; margin-bottom: 3px;">Jadwal Menginap</span>
                                        <div data-jadwal style="font-size: 1.05rem; font-weight: 800; color: #0f172a;">
                                            <span class="jadwal-date-display">{{ \Carbon\Carbon::parse($checkIn)->format('d M Y') }}</span>
                                            <span style="color: #94a3b8; font-weight: 400; margin: 0 6px;">&rarr;</span>
                                            <span class="jadwal-date-display">{{ \Carbon\Carbon::parse($checkOut)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span data-nights-badge style="background: white; border: 1px solid #cbd5e1; color: #0f172a; font-size: 0.85rem; font-weight: 700; padding: 6px 14px; border-radius: 20px; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                        <i data-lucide="moon" style="width: 14px; height: 14px; color: var(--primary);"></i>
                                        <span>{{ $nights }} Malam</span>
                                    </span>
                                    <button type="button" class="btn-ubah-tanggal" onclick="openDateModal()">
                                        <i data-lucide="calendar-days" style="width:13px; height:13px;"></i>
                                        Ubah Tanggal
                                    </button>
                                </div>
                            </div>

                            {{-- Note Info Booking Kalender --}}
                            <div style="margin-top:14px; padding-top:12px; border-top:1px dashed #cbd5e1; display:flex; align-items:center; gap:8px; font-size:0.82rem; color:#64748b;">
                                <i data-lucide="info" style="width:15px;height:15px;color:var(--primary);flex-shrink:0;"></i>
                                <span><strong>Catatan:</strong> Tanggal yang tidak bisa dipilih berarti sudah ada yang booking.</span>
                            </div>

                            {{-- Hidden inputs for form submission & scripts --}}
                            <input type="hidden" id="check_in" name="check_in" value="{{ $checkIn }}">
                            <input type="hidden" id="check_out" name="check_out" value="{{ $checkOut }}">
                        </div>

                        <hr style="border:0; border-top:1px solid #f1f5f9; margin:4px 0 24px;">

                        {{-- Data Tamu --}}
                        <div class="form-group" style="margin-bottom: 24px;">
                            <label class="form-label" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #475569; margin-bottom: 8px; display:block;">Nama Lengkap Tamu</label>
                            <input type="text" id="guest_name" name="guest_name" class="form-control" value="{{ $user->name }}" required style="width:100%; padding:14px; border:1.5px solid #cbd5e1; border-radius:12px; font-family:inherit; box-sizing:border-box;">
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                            <div class="form-group">
                                <label class="form-label" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #475569; margin-bottom: 8px; display:block;">Alamat Email</label>
                                <input type="email" id="guest_email" name="guest_email" class="form-control" value="{{ $user->email }}" required style="width:100%; padding:14px; border:1.5px solid #cbd5e1; border-radius:12px; font-family:inherit; box-sizing:border-box;">
                            </div>
                            <div class="form-group">
                                <label class="form-label" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #475569; margin-bottom: 8px; display:block;">Nomor Telepon</label>
                                <input type="tel" id="guest_phone" name="guest_phone" class="form-control" value="{{ $user->phone }}" required placeholder="Contoh: 0812345678" style="width:100%; padding:14px; border:1.5px solid #cbd5e1; border-radius:12px; font-family:inherit; box-sizing:border-box;">
                            </div>
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 15px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                            <button type="button" class="btn-step-nav btn-step-next" onclick="goToStep(3)">
                                <span>Selanjutnya: Metode Pembayaran</span>
                                <i data-lucide="arrow-right" style="width:16px; height:16px;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 3: Pilih Metode Pembayaran -->
                    <div class="step-card" id="step-3-card">
                        <h2 style="font-size:1.6rem; font-weight:700; color:#0f172a; margin:0 0 8px 0;">Pilih Metode Pembayaran</h2>
                        <p style="color:#64748b; font-size:0.95rem; margin-bottom:30px;">Pilih metode pembayaran aman yang ingin Anda gunakan untuk menyelesaikan booking kamar ini.</p>
                        
                        <div class="payment-method-card selected" onclick="selectPayment('midtrans')">
                            <div style="width: 60px; height: 35px; background: #0f172a; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #38bdf8; font-weight: 800; font-size: 0.82rem; letter-spacing: 0.5px;">
                                MIDTRANS
                            </div>
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 3px; flex-wrap: wrap;">
                                    <h4 style="font-weight: 700; color: #0f172a; margin: 0; font-size: 0.98rem;">Midtrans Payment Gateway</h4>
                                </div>
                                <p style="font-size: 0.82rem; color: #64748b; margin: 0 0 6px 0;">Bayar via QRIS (GoPay/ShopeePay/Dana), Virtual Account Semua Bank, dan Kartu Kredit.</p>
                                <div style="display: flex; gap: 6px; flex-wrap: wrap; font-size: 0.72rem; font-weight: 700; color: #475569;">
                                    <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">QRIS</span>
                                    <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">BCA VA</span>
                                    <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">BNI VA</span>
                                    <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">BRI VA</span>
                                    <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">Mandiri Bill</span>
                                    <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">Credit Card</span>
                                </div>
                            </div>
                            <input type="radio" name="payment_method" value="Midtrans (QRIS, VA Bank & E-Wallet)" checked id="pay-midtrans">
                        </div>
                        
                        <div class="payment-method-card" onclick="selectPayment('cash')" style="align-items: flex-start;">
                            <div style="background:#ecfdf5; padding:10px 12px; border-radius:10px; font-weight:800; font-size:0.85rem; color:#059669; display:flex; align-items:center; margin-top:2px;">
                                <i data-lucide="banknote" style="width:22px; height:22px;"></i>
                            </div>
                            <div style="flex: 1; padding-right: 25px;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px; flex-wrap: wrap;">
                                    <h4 style="font-weight: 700; color: #0f172a; margin: 0; font-size: 0.98rem;">Bayar di Tempat (Cash on Arrival)</h4>
                                    <span style="background: #fef3c7; color: #b45309; font-size: 0.72rem; font-weight: 800; padding: 2px 8px; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;">
                                        <i data-lucide="info" style="width: 12px; height: 12px;"></i> Wajib DP 50%
                                    </span>
                                </div>
                                <p style="font-size: 0.82rem; color: #64748b; margin: 0 0 10px 0;">Bayar tunai kepada pengelola homestay saat Anda tiba di lokasi (check-in).</p>
                                
                                {{-- Kotak Informasi DP 50% & Kebijakan Refund --}}
                                <div style="background: #fffbeb; border: 1.5px solid #fde68a; border-radius: 12px; padding: 14px 16px; font-size: 0.82rem; color: #92400e; line-height: 1.6;">
                                    <div style="font-weight: 800; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; font-size: 0.86rem; color: #b45309;">
                                        <i data-lucide="alert-circle" style="width: 16px; height: 16px; color: #d97706;"></i>
                                        <span>Ketentuan Pembayaran Tunai (Cash):</span>
                                    </div>
                                    <ul style="margin: 0; padding-left: 20px;">
                                        <li style="margin-bottom: 4px;">
                                            Tamu wajib membayar <strong>Down Payment (DP) sebesar 50%</strong> terlebih dahulu untuk mengunci tanggal dan mengonfirmasi reservasi kamar.
                                        </li>
                                        <li style="margin-bottom: 4px;">
                                            Sisa 50% biaya menginap dilunasi saat Anda tiba di Rama Homestay saat check-in.
                                        </li>
                                        <li>
                                            <strong style="color: #15803d;">Garansi Refund 100%:</strong> Apabila Anda tidak jadi menginap (membatalkan reservasi), uang DP 50% Anda akan <strong>dikembalikan / di-refund secara penuh (100%)</strong>.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <input type="radio" name="payment_method" value="Bayar di Tempat (Cash - Wajib DP 50%)" id="pay-cash">
                        </div>

                        <div style="display: flex; justify-content: space-between; gap: 15px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                            <button type="button" class="btn-step-nav btn-step-prev" onclick="goToStep(2)">
                                <i data-lucide="arrow-left" style="width:16px; height:16px;"></i>
                                <span>Kembali</span>
                            </button>
                            <button type="button" class="btn-step-nav btn-step-next" onclick="goToStep(4)">
                                <span>Selanjutnya: Konfirmasi</span>
                                <i data-lucide="arrow-right" style="width:16px; height:16px;"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 4: Konfirmasi Final -->
                    <div class="step-card" id="step-4-card">
                        <h2 style="font-size: 1.6rem; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;">Konfirmasi Booking</h2>
                        <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 30px;">Tinjau kembali seluruh detail reservasi Anda sebelum melakukan pembayaran akhir.</p>
                        
                        <div style="background:#f8fafc; border-radius:12px; padding:25px; border:1px solid #e2e8f0; margin-bottom:30px;">
                            <h4 style="font-weight:700; color:#0f172a; margin:0 0 15px 0; font-size:1rem; border-bottom:1px solid #e2e8f0; padding-bottom:10px;"><i data-lucide="file-text" style="width:16px; height:16px; vertical-align:middle;"></i> Rincian Summary</h4>
                            
                            <table style="width:100%; font-size:0.92rem; line-height:1.8;">
                                <tr>
                                    <td style="color:#64748b; font-weight:600;">Nama Kamar:</td>
                                    <td style="text-align:right; font-weight:700; color:#0f172a;">{{ $room->name }}</td>
                                </tr>
                                <tr>
                                    <td style="color:#64748b; font-weight:600;">Tanggal Menginap:</td>
                                    <td style="text-align:right; font-weight:700; color:#0f172a;" id="confirm-dates">-</td>
                                </tr>
                                <tr>
                                    <td style="color:#64748b; font-weight:600;">Durasi:</td>
                                    <td style="text-align:right; font-weight:700; color:#0f172a;" id="confirm-duration">-</td>
                                </tr>
                                <tr>
                                    <td style="color:#64748b; font-weight:600;">Nama Tamu:</td>
                                    <td style="text-align:right; font-weight:700; color:#0f172a;" id="confirm-name">-</td>
                                </tr>
                                <tr>
                                    <td style="color:#64748b; font-weight:600;">Nomor Telepon:</td>
                                    <td style="text-align:right; font-weight:700; color:#0f172a;" id="confirm-phone">-</td>
                                </tr>
                                <tr>
                                    <td style="color:#64748b; font-weight:600;">Metode Pembayaran:</td>
                                    <td style="text-align:right; font-weight:700; color:#059669;" id="confirm-paymethod">-</td>
                                </tr>
                                <tr style="border-top: 1px dashed #cbd5e1;">
                                    <td style="color:#64748b; font-weight:600; padding-top:8px;">Total Biaya Kamar:</td>
                                    <td style="text-align:right; font-weight:700; color:#0f172a; padding-top:8px;" id="confirm-total">Rp {{ number_format($room->price * $nights, 0, ',', '.') }}</td>
                                </tr>
                                <tr style="background: rgba(245, 166, 35, 0.08);">
                                    <td style="color:#b45309; font-weight:800; padding: 6px 8px; border-radius: 6px 0 0 6px;" id="confirm-tag-label">Tagihan Pembayaran:</td>
                                    <td style="text-align:right; font-weight:800; color:var(--primary); font-size:1.05rem; padding: 6px 8px; border-radius: 0 6px 6px 0;" id="confirm-dp">Rp {{ number_format($room->price * $nights, 0, ',', '.') }}</td>
                                </tr>
                                <tr id="confirm-remaining-tr" style="display: none;">
                                    <td style="color:#64748b; font-weight:600; font-size:0.85rem; padding-top:4px;" id="confirm-remaining-label">Sisa Pelunasan saat Check-in:</td>
                                    <td style="text-align:right; font-weight:700; color:#0f172a; font-size:0.88rem; padding-top:4px;" id="confirm-remaining">-</td>
                                </tr>
                            </table>
                        </div>

                        {{-- Notifikasi Khusus Pembayaran Cash --}}
                        <div id="cash-dp-notice" style="display: none; background: #fffbeb; border: 1.5px solid #fde68a; border-radius: 12px; padding: 16px 20px; margin-bottom: 25px; color: #92400e; font-size: 0.85rem; line-height: 1.6;">
                            <div style="font-weight: 800; display: flex; align-items: center; gap: 8px; color: #b45309; margin-bottom: 6px; font-size: 0.9rem;">
                                <i data-lucide="alert-circle" style="width: 18px; height: 18px; color: #d97706;"></i>
                                <span>Pengingat Pembayaran Cash (Wajib DP 50%):</span>
                            </div>
                            <p style="margin: 0 0 6px;">
                                Anda memilih metode <strong>Bayar di Tempat (Cash)</strong>. Sesuai ketentuan, Anda diwajibkan membayar <strong>DP 50%</strong> terlebih dahulu untuk mengunci jadwal reservasi.
                            </p>
                            <div style="display: flex; align-items: center; gap: 6px; font-weight: 700; color: #15803d;">
                                <i data-lucide="check-circle-2" style="width: 15px; height: 15px;"></i>
                                <span>Garansi Uang Kembali: Jika Anda tidak jadi reservasi (batal), uang DP 50% akan di-refund 100%.</span>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; gap: 15px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                            <button type="button" class="btn-step-nav btn-step-prev" onclick="goToStep(3)">
                                <i data-lucide="arrow-left" style="width:16px; height:16px;"></i>
                                <span>Kembali</span>
                            </button>
                            <button type="submit" class="btn-step-nav btn-step-next" style="background:#10b981; box-shadow:0 4px 15px rgba(16, 185, 129, 0.2);">
                                <i data-lucide="credit-card" style="width:18px; height:18px;"></i>
                                <span>Selesaikan & Konfirmasi Booking</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Side Sidebar Summary (Real-time calculation info) -->
                <aside class="summary-card">
                    <h3 style="font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 15px 0;">Ringkasan Kamar</h3>
                    
                    <div style="border-radius:12px; overflow:hidden; margin-bottom:20px;">
                        @if($room->image)
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}" style="width:100%; height:180px; object-fit:cover;">
                        @else
                            <div style="width:100%; height:180px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#cbd5e1;">
                                <i data-lucide="image" style="width:48px; height:48px;"></i>
                            </div>
                        @endif
                    </div>
                    
                    <h4 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">{{ $room->name }}</h4>
                    <p style="font-size: 0.85rem; color: #64748b; margin: 0 0 15px 0;">Rama Homestay Premium Room</p>
                    
                    <hr style="margin: 15px 0; border: 0; border-top: 1px solid #f1f5f9;">
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.9rem;">
                        <span style="color: #64748b;">Biaya per malam:</span>
                        <span style="font-weight: 700; color: #0f172a;">Rp {{ number_format($room->price, 0, ',', '.') }}</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.9rem;">
                        <span style="color: #64748b;">Jumlah malam:</span>
                        <span style="font-weight: 700; color: #0f172a;" id="summary-nights">{{ $nights }} malam</span>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 0.95rem;">
                        <span style="color: #64748b; font-weight: 600;">Total Biaya Kamar:</span>
                        <span style="font-weight: 800; color: #0f172a;" id="summary-total">Rp {{ number_format($room->price * $nights, 0, ',', '.') }}</span>
                    </div>
                    
                    <hr style="margin: 15px 0; border: 0; border-top: 1px dashed #cbd5e1;">

                    {{-- Kotak Sorotan Tagihan Pembayaran --}}
                    <div style="background: linear-gradient(135deg, rgba(245, 166, 35, 0.08) 0%, rgba(245, 166, 35, 0.16) 100%); border: 1.5px solid rgba(245, 166, 35, 0.4); border-radius: 14px; padding: 14px 16px; margin-bottom: 8px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                            <span style="font-size: 0.8rem; font-weight: 800; color: #b45309; text-transform: uppercase; letter-spacing: 0.5px;" id="summary-tag-title">Tagihan Pembayaran</span>
                            <span style="font-size: 0.68rem; font-weight: 800; background: #e0f2fe; color: #0284c7; padding: 2px 8px; border-radius: 10px; border: 1px solid #bae6fd;" id="summary-tag-badge">Online</span>
                        </div>
                        <div style="font-size: 1.4rem; font-weight: 900; color: var(--primary);" id="summary-dp">
                            Rp {{ number_format($room->price * $nights, 0, ',', '.') }}
                        </div>
                        <div id="summary-remaining-box" style="font-size: 0.78rem; color: #64748b; margin-top: 6px; display: none; justify-content: space-between; border-top: 1px dashed rgba(245, 166, 35, 0.3); padding-top: 6px;">
                            <span id="summary-remaining-label">Sisa saat Check-in:</span>
                            <strong style="color: #0f172a;" id="summary-remaining">-</strong>
                        </div>
                    </div>
                </aside>
                
            </div>
        </form>
    </div>
</div>

<!-- ===== Modal Ubah Tanggal ===== -->
<div class="date-modal-overlay" id="dateModalOverlay" onclick="handleOverlayClick(event)">
    <div class="date-modal" id="dateModal">
        <button type="button" onclick="closeDateModal()" style="position:absolute;top:18px;right:20px;background:none;border:none;cursor:pointer;color:#94a3b8;font-size:1.4rem;line-height:1;" aria-label="Tutup">&times;</button>
        <div class="date-modal-title">Ubah Tanggal Menginap</div>
        <p class="date-modal-sub">Pilih tanggal check-in dan check-out yang baru.</p>

        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:10px 14px; margin-bottom:18px; display:flex; align-items:center; gap:8px; font-size:0.82rem; color:#64748b;">
            <i data-lucide="info" style="width:15px;height:15px;color:var(--primary);flex-shrink:0;"></i>
            <span><strong>Catatan:</strong> Tanggal yang tidak bisa dipilih berarti sudah ada yang booking.</span>
        </div>

        <div class="date-modal-grid">
            <div>
                <label class="date-modal-label">Check-in</label>
                <input type="text" id="modal_checkin" class="date-modal-input" placeholder="Pilih check-in" readonly style="background:#fff; cursor:pointer;">
            </div>
            <div>
                <label class="date-modal-label">Check-out</label>
                <input type="text" id="modal_checkout" class="date-modal-input" placeholder="Pilih check-out" readonly style="background:#fff; cursor:pointer;">
            </div>
        </div>

        <div class="date-modal-error" id="modalError"></div>
        <div class="date-modal-preview" id="modalPreview"></div>

        <div class="date-modal-actions">
            <button type="button" class="btn-modal-cancel" onclick="closeDateModal()">Batal</button>
            <button type="button" class="btn-modal-confirm" onclick="confirmDateChange()">
                <i data-lucide="check" style="width:15px;height:15px;display:inline;vertical-align:middle;margin-right:5px;"></i>
                Terapkan Tanggal
            </button>
        </div>
    </div>
</div>

<!-- Flatpickr JS & Indonesian Locale -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<!-- Real-time calculation and navigation Script -->
<script>
    const roomPrice   = @json($room->price);
    const roomId      = @json($room->id);
    const bookedDates = @json($bookedDatesList);
    let isCurrentAvailable = @json($isCurrentAvailable);

    function isRangeOverlappingBooked(ci, co) {
        if (!ci || !co) return false;
        const ciDate = new Date(ci + 'T00:00:00');
        const coDate = new Date(co + 'T00:00:00');
        if (coDate <= ciDate) return true;

        for (let dStr of bookedDates) {
            const d = new Date(dStr + 'T00:00:00');
            // If booked night d is on or after check-in and strictly before check-out, it conflicts
            if (d >= ciDate && d < coDate) {
                return true;
            }
        }
        return false;
    }

    function selectPayment(id) {
        document.querySelectorAll('.payment-method-card').forEach(c => c.classList.remove('selected'));
        if (id === 'midtrans') {
            document.getElementById('pay-midtrans').checked = true;
            document.getElementById('pay-midtrans').closest('.payment-method-card').classList.add('selected');
        } else if (id === 'cash') {
            document.getElementById('pay-cash').checked = true;
            document.getElementById('pay-cash').closest('.payment-method-card').classList.add('selected');
        }
        updatePaymentSummaryDisplay();
    }

    function getDateValues() {
        const inEl = document.getElementById('check_in');
        const outEl = document.getElementById('check_out');
        return {
            checkIn: inEl ? inEl.value : @json($checkIn),
            checkOut: outEl ? outEl.value : @json($checkOut)
        };
    }

    function calculateNights() {
        const { checkIn, checkOut } = getDateValues();
        let diffDays = {{ $nights }};
        const fmt = (d) => new Date(d + 'T00:00:00').toLocaleDateString('id-ID', {day:'2-digit', month:'short', year:'numeric'});
        let datesStr = '{{ \Carbon\Carbon::parse($checkIn)->format("d M Y") }} s/d {{ \Carbon\Carbon::parse($checkOut)->format("d M Y") }}';

        if (checkIn && checkOut) {
            const ci = new Date(checkIn + 'T00:00:00');
            const co = new Date(checkOut + 'T00:00:00');
            if (co > ci) {
                diffDays = Math.ceil(Math.abs(co - ci) / (1000 * 60 * 60 * 24));
                datesStr = `${fmt(checkIn)} s/d ${fmt(checkOut)}`;
            }
        }

        const totalPrice = diffDays * roomPrice;
        const dpPrice = Math.round(totalPrice * 0.5);
        const remainingPrice = totalPrice - dpPrice;

        const formatRupiah = (val) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(val);

        return {
            nights: diffDays,
            dates: datesStr,
            totalNum: totalPrice,
            dpNum: dpPrice,
            remainingNum: remainingPrice,
            totalFormatted: formatRupiah(totalPrice),
            dpFormatted: formatRupiah(dpPrice),
            remainingFormatted: formatRupiah(remainingPrice),
        };
    }

    function updatePaymentSummaryDisplay() {
        const data = calculateNights();
        if (!data) return;

        const paymentRadio = document.querySelector('input[name="payment_method"]:checked');
        const isCash = paymentRadio && paymentRadio.value.toLowerCase().includes('cash');

        // Sidebar elements
        const summaryTotal = document.getElementById('summary-total');
        const summaryTagTitle = document.getElementById('summary-tag-title');
        const summaryTagBadge = document.getElementById('summary-tag-badge');
        const summaryDp = document.getElementById('summary-dp');
        const summaryRemBox = document.getElementById('summary-remaining-box');
        const summaryRemLabel = document.getElementById('summary-remaining-label');
        const summaryRem = document.getElementById('summary-remaining');

        // Step 4 elements
        const confirmTotal = document.getElementById('confirm-total');
        const confirmTagLabel = document.getElementById('confirm-tag-label');
        const confirmDp = document.getElementById('confirm-dp');
        const confirmRemTr = document.getElementById('confirm-remaining-tr');
        const confirmRemLabel = document.getElementById('confirm-remaining-label');
        const confirmRem = document.getElementById('confirm-remaining');
        const cashNotice = document.getElementById('cash-dp-notice');

        if (summaryTotal) summaryTotal.textContent = data.totalFormatted;
        if (confirmTotal) confirmTotal.textContent = data.totalFormatted;

        if (isCash) {
            // Cash on Arrival requires DP 50%
            if (summaryTagTitle) summaryTagTitle.textContent = 'Wajib Bayar DP (50%)';
            if (summaryTagBadge) {
                summaryTagBadge.textContent = 'DP 50%';
                summaryTagBadge.style.background = '#fef3c7';
                summaryTagBadge.style.color = '#b45309';
                summaryTagBadge.style.borderColor = '#fde68a';
            }
            if (summaryDp) summaryDp.textContent = data.dpFormatted;
            if (summaryRemBox) summaryRemBox.style.display = 'flex';
            if (summaryRemLabel) summaryRemLabel.textContent = 'Sisa saat Check-in (50%):';
            if (summaryRem) {
                summaryRem.textContent = data.remainingFormatted;
                summaryRem.style.color = '#0f172a';
            }

            if (confirmTagLabel) confirmTagLabel.textContent = 'Tagihan DP 50% (Dibayar Sekarang):';
            if (confirmDp) confirmDp.textContent = data.dpFormatted;
            if (confirmRemTr) confirmRemTr.style.display = 'table-row';
            if (confirmRemLabel) confirmRemLabel.textContent = 'Sisa Pelunasan saat Check-in:';
            if (confirmRem) {
                confirmRem.textContent = data.remainingFormatted;
                confirmRem.style.color = '#0f172a';
            }
            if (cashNotice) cashNotice.style.display = 'block';
        } else {
            // Midtrans Online Payment
            if (summaryTagTitle) summaryTagTitle.textContent = 'Tagihan Pembayaran';
            if (summaryTagBadge) {
                summaryTagBadge.textContent = 'Online';
                summaryTagBadge.style.background = '#e0f2fe';
                summaryTagBadge.style.color = '#0284c7';
                summaryTagBadge.style.borderColor = '#bae6fd';
            }
            if (summaryDp) summaryDp.textContent = data.totalFormatted;
            if (summaryRemBox) summaryRemBox.style.display = 'none';

            if (confirmTagLabel) confirmTagLabel.textContent = 'Tagihan Pembayaran:';
            if (confirmDp) confirmDp.textContent = data.totalFormatted;
            if (confirmRemTr) confirmRemTr.style.display = 'none';
            if (cashNotice) cashNotice.style.display = 'none';
        }
    }

    let fpCheckin = null;
    let fpCheckout = null;

    function initModalFlatpickr() {
        const curCi = document.getElementById('check_in').value;
        const curCo = document.getElementById('check_out').value;

        fpCheckin = flatpickr("#modal_checkin", {
            locale: "id",
            minDate: "today",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d M Y",
            defaultDate: curCi || null,
            disable: bookedDates,  // tanggal yang sudah dipesan tidak bisa dipilih
            onChange: function(selectedDates, dateStr) {
                if (!dateStr || !selectedDates.length) return;

                const nextDay = new Date(selectedDates[0]);
                nextDay.setDate(nextDay.getDate() + 1);

                if (fpCheckout) {
                    fpCheckout.set('minDate', nextDay);
                    fpCheckout.set('maxDate', null); // tidak ada batasan maksimum

                    // Hanya hapus checkout jika nilainya <= check-in yang baru
                    const curCoVal = document.getElementById('modal_checkout').value;
                    if (curCoVal && new Date(curCoVal + 'T00:00:00') <= selectedDates[0]) {
                        fpCheckout.clear();
                    }
                }
                updateModalPreview();
            }
        });

        fpCheckout = flatpickr("#modal_checkout", {
            locale: "id",
            minDate: new Date().fp_incr(1),
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d M Y",
            defaultDate: curCo || null,
            disable: bookedDates,  // tanggal yang sudah dipesan tidak bisa dipilih sebagai checkout
            onChange: function() {
                updateModalPreview();
            }
        });

        // Set initial minDate for checkout based on curCi
        if (curCi && fpCheckout) {
            const ciDate = new Date(curCi + 'T00:00:00');
            const nextDay = new Date(ciDate);
            nextDay.setDate(nextDay.getDate() + 1);
            fpCheckout.set('minDate', nextDay);
            fpCheckout.set('maxDate', null);
        }
    }

    // Auto-update on page load
    window.addEventListener('DOMContentLoaded', function() {
        const data = calculateNights();
        if (data) {
            document.getElementById('summary-nights').textContent = `${data.nights} malam`;
        }
        updatePaymentSummaryDisplay();
        initModalFlatpickr();

        // If currently not available, disable next step button on Step 2
        if (!isCurrentAvailable) {
            const nextBtn = document.querySelector('#step-2-card .btn-step-next');
            if (nextBtn) {
                nextBtn.style.opacity = '0.6';
            }
        }
    });

    /* ===== Modal Ubah Tanggal Logic ===== */
    function openDateModal() {
        const curCi = document.getElementById('check_in').value;
        const curCo = document.getElementById('check_out').value;
        
        if (fpCheckin && curCi) fpCheckin.setDate(curCi);
        if (fpCheckout && curCo) fpCheckout.setDate(curCo);

        document.getElementById('modalError').style.display   = 'none';
        document.getElementById('modalPreview').style.display = 'none';
        document.getElementById('dateModalOverlay').classList.add('open');
        updateModalPreview();
        lucide.createIcons();
    }

    function closeDateModal() {
        document.getElementById('dateModalOverlay').classList.remove('open');
    }

    function handleOverlayClick(e) {
        if (e.target === document.getElementById('dateModalOverlay')) closeDateModal();
    }

    function updateModalPreview() {
        const ci = document.getElementById('modal_checkin').value;
        const co = document.getElementById('modal_checkout').value;
        const preview = document.getElementById('modalPreview');
        const err = document.getElementById('modalError');
        const confirmBtn = document.querySelector('.btn-modal-confirm');

        if (!ci || !co) {
            preview.style.display = 'none';
            err.style.display = 'none';
            if (confirmBtn) {
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.5';
                confirmBtn.style.pointerEvents = 'none';
            }
            return;
        }

        const ciDate = new Date(ci + 'T00:00:00');
        const coDate = new Date(co + 'T00:00:00');
        if (coDate <= ciDate) {
            err.textContent = 'Tanggal check-out harus setelah check-in!';
            err.style.display = 'block';
            preview.style.display = 'none';
            if (confirmBtn) {
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.5';
                confirmBtn.style.pointerEvents = 'none';
            }
            return;
        }

        // Check if selected range crosses any booked nights
        if (isRangeOverlappingBooked(ci, co)) {
            err.innerHTML = '<i data-lucide="alert-triangle" style="width:15px;height:15px;display:inline;vertical-align:middle;margin-right:5px;"></i>Maaf, jadwal tanggal tersebut bertabrakan dengan jadwal yang sudah terisi! Silakan pilih tanggal lain.';
            err.style.display = 'block';
            preview.style.display = 'none';
            lucide.createIcons();
            if (confirmBtn) {
                confirmBtn.disabled = true;
                confirmBtn.style.opacity = '0.5';
                confirmBtn.style.pointerEvents = 'none';
            }
            return;
        }

        err.style.display = 'none';
        const nights = Math.ceil((coDate - ciDate) / (1000 * 60 * 60 * 24));
        const fmt = (d) => new Date(d + 'T00:00:00').toLocaleDateString('id-ID', {day:'numeric', month:'short', year:'numeric'});
        const total = nights * roomPrice;
        const fmtRp = (v) => new Intl.NumberFormat('id-ID', {style:'currency', currency:'IDR', minimumFractionDigits:0}).format(v);

        preview.style.display = 'block';
        preview.style.background = '#f0fdf4';
        preview.style.borderColor = '#bbf7d0';
        preview.style.color = '#15803d';
        preview.innerHTML = `<i data-lucide="check-circle" style="width:15px;height:15px;display:inline;vertical-align:middle;margin-right:5px;"></i>Kamar Tersedia! &bull; ${fmt(ci)} &rarr; ${fmt(co)} &bull; <strong>${nights} malam</strong> &bull; Total: <strong>${fmtRp(total)}</strong>`;
        lucide.createIcons();

        if (confirmBtn) {
            confirmBtn.disabled = false;
            confirmBtn.style.opacity = '1';
            confirmBtn.style.pointerEvents = 'auto';
        }
    }

    function confirmDateChange() {
        const ci = document.getElementById('modal_checkin').value;
        const co = document.getElementById('modal_checkout').value;
        const err = document.getElementById('modalError');
        if (!ci || !co) {
            err.textContent = 'Harap isi kedua tanggal terlebih dahulu.';
            err.style.display = 'block';
            return;
        }
        const ciDate = new Date(ci + 'T00:00:00');
        const coDate = new Date(co + 'T00:00:00');
        if (coDate <= ciDate) {
            err.textContent = 'Tanggal check-out harus setelah check-in!';
            err.style.display = 'block';
            return;
        }

        if (isRangeOverlappingBooked(ci, co)) {
            err.textContent = 'Tanggal yang dipilih bertabrakan dengan jadwal yang sudah terisi! Silakan pilih tanggal lain.';
            err.style.display = 'block';
            return;
        }

        // Update hidden form fields
        document.getElementById('check_in').value  = ci;
        document.getElementById('check_out').value = co;
        isCurrentAvailable = true;

        // Hide warning banner
        const warnBanner = document.getElementById('date-conflict-warning');
        if (warnBanner) warnBanner.style.display = 'none';

        // Update displayed dates in the jadwal block
        const fmtDisp = (d) => new Date(d + 'T00:00:00').toLocaleDateString('id-ID', {day:'2-digit', month:'short', year:'numeric'});
        const nights = Math.ceil((coDate - ciDate) / (1000 * 60 * 60 * 24));

        // Update the visible date spans in the booking header
        const spans = document.querySelectorAll('#step-2-card .jadwal-date-display');
        if (spans.length >= 2) {
            spans[0].textContent = fmtDisp(ci);
            spans[1].textContent = fmtDisp(co);
        } else {
            const jadwalBlock = document.querySelector('#step-2-card [data-jadwal]');
            if (jadwalBlock) jadwalBlock.innerHTML = `${fmtDisp(ci)} <span style="color:#94a3b8;font-weight:400;margin:0 6px;">&rarr;</span> ${fmtDisp(co)}`;
        }

        // Update night badge while preserving icon
        const nightBadge = document.querySelector('#step-2-card [data-nights-badge]');
        if (nightBadge) {
            const badgeSpan = nightBadge.querySelector('span');
            if (badgeSpan) {
                badgeSpan.textContent = `${nights} Malam`;
            } else {
                nightBadge.innerHTML = `<i data-lucide="moon" style="width: 14px; height: 14px; color: var(--primary);"></i> <span>${nights} Malam</span>`;
            }
        }

        // Re-enable step 2 next button
        const nextBtn = document.querySelector('#step-2-card .btn-step-next');
        if (nextBtn) {
            nextBtn.style.opacity = '1';
        }

        // Refresh sidebar + summary
        document.getElementById('summary-nights').textContent = `${nights} malam`;
        updatePaymentSummaryDisplay();

        closeDateModal();
        lucide.createIcons();
    }

    function goToStep(step) {
        // Validate dates always required before proceeding past step 2
        if (step >= 3) {
            const data = calculateNights();
            if (!data) {
                alert('Jadwal check-in dan check-out tidak valid!');
                return;
            }
            const { checkIn, checkOut } = getDateValues();
            if (isRangeOverlappingBooked(checkIn, checkOut) || !isCurrentAvailable) {
                alert('Maaf, kamar ' + @json($room->name) + ' sudah terisi pada tanggal yang dipilih (' + (data ? data.dates : '') + ')! Silakan klik "Ubah Tanggal" untuk memilih jadwal yang masih kosong.');
                openDateModal();
                return;
            }
        }
        if (step === 3) {
            const name = document.getElementById('guest_name').value.trim();
            const email = document.getElementById('guest_email').value.trim();
            const phone = document.getElementById('guest_phone').value.trim();
            if (!name || !email || !phone) {
                alert('Silakan isi lengkap data diri tamu terlebih dahulu!');
                return;
            }
        }
        if (step === 4) {
            const data = calculateNights();
            const name = document.getElementById('guest_name').value.trim();
            const phone = document.getElementById('guest_phone').value.trim();
            const paymentRadio = document.querySelector('input[name="payment_method"]:checked');
            document.getElementById('confirm-dates').textContent = data ? data.dates : '{{ $checkIn }} s/d {{ $checkOut }}';
            document.getElementById('confirm-duration').textContent = data ? `${data.nights} malam` : '{{ $nights }} malam';
            document.getElementById('confirm-name').textContent = name;
            document.getElementById('confirm-phone').textContent = phone;
            document.getElementById('confirm-paymethod').textContent = paymentRadio ? paymentRadio.value : '-';

            updatePaymentSummaryDisplay();
        }
        // Hide all cards, show requested card
        document.querySelectorAll('.step-card').forEach(card => card.classList.remove('active'));
        document.getElementById(`step-${step}-card`).classList.add('active');
        // Timeline badges (steps 2–4 now)
        for (let i = 2; i <= 5; i++) {
            const tl = document.getElementById(`tl-${i}`);
            if (tl) {
                if (i < step) {
                    tl.classList.add('completed'); tl.classList.remove('active');
                    tl.querySelector('.step-badge').innerHTML = '<i class="fa fa-check" style="color:white; font-size:0.8rem;"></i>';
                } else if (i === step) {
                    tl.classList.add('active'); tl.classList.remove('completed');
                    tl.querySelector('.step-badge').innerHTML = `${i}`;
                } else {
                    tl.classList.remove('active', 'completed');
                    tl.querySelector('.step-badge').innerHTML = `${i}`;
                }
            }
        }
        window.scrollTo({ top: 100, behavior: 'smooth' });
    }
</script>
@endsection

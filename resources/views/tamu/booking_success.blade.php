@extends('layouts.app')

@section('title', 'Bukti Booking - Reservasi Berhasil')

@section('content')
<style>
    .success-wrapper {
        padding: 40px 0 80px 0;
        background: #f0f4f8;
        min-height: 100vh;
    }

    .success-container {
        max-width: 1160px;
        width: 100%;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }

    /* SIDE-BY-SIDE GRID */
    .booking-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        align-items: start;
    }

    @media (max-width: 860px) {
        .booking-grid {
            grid-template-columns: 1fr;
        }
    }

    .payment-panel {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    /* Voucher Card */
    .voucher-card {
        background: #ffffff;
        border-radius: 24px;
        width: 100%;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.09);
        border: 1px solid #e2e8f0;
        overflow: hidden;
        position: relative;
        box-sizing: border-box;
    }

    .voucher-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        padding: 28px 32px;
        color: white;
        text-align: center;
        position: relative;
    }

    .voucher-badge {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1.5px;
        padding: 5px 14px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
    }

    .voucher-body {
        padding: 26px 32px;
        position: relative;
        box-sizing: border-box;
    }

    .ticket-divider {
        height: 4px;
        background-image: radial-gradient(circle, #f0f4f8 8px, transparent 9px);
        background-size: 22px 22px;
        background-position: -4px -10px;
        background-repeat: repeat-x;
        position: relative;
        margin: 4px 0;
    }
    .ticket-divider::before {
        content: '';
        position: absolute;
        left: -12px;
        top: -10px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #f0f4f8;
    }
    .ticket-divider::after {
        content: '';
        position: absolute;
        right: -12px;
        top: -10px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #f0f4f8;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.9rem;
        gap: 12px;
    }

    .detail-label {
        color: #64748b;
        font-weight: 600;
        flex-shrink: 0;
        font-size: 0.85rem;
    }

    .detail-val {
        color: #0f172a;
        font-weight: 700;
        text-align: right;
        word-break: break-word;
        font-size: 0.88rem;
    }

    .qr-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px dashed #cbd5e1;
    }

    .qr-code-box {
        background: white;
        border-radius: 14px;
        padding: 10px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        border: 1px solid #e2e8f0;
        display: inline-block;
        margin-bottom: 10px;
    }

    .btn-step-nav {
        padding: 13px 22px;
        border-radius: 12px;
        font-weight: 700;
        font-family: inherit;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        border: none;
    }

    @media print {
        header, footer, .no-print {
            display: none !important;
        }
        .success-wrapper {
            padding: 0;
            background: white;
        }
        .booking-grid {
            grid-template-columns: 1fr;
        }
        .payment-panel {
            display: none;
        }
        .voucher-card {
            box-shadow: none;
            border: none;
            max-width: 100%;
        }
    }
</style>

<div class="success-wrapper">
    <div class="success-container">

        @php
            $currentStatus = $booking['status'] ?? 'pending';
            $isPaid = $currentStatus === 'confirmed';
            $isCancelled = $currentStatus === 'cancelled';
            $snapToken = $booking['snap_token'] ?? null;
            $payMethod = strtolower($booking['payment_method'] ?? '');
            $isCash = str_contains($payMethod, 'cash') || str_contains($payMethod, 'tempat');
            $isMidtrans = str_contains($payMethod, 'midtrans');
            $isBca = str_contains($payMethod, 'bca') && !$isMidtrans;

            $totalPrice = (int) round($booking['total_price'] ?? 0);
            if ($isCash) {
                // Khusus Cash / COD ada skema DP 50%
                $payAmount = (int) round($totalPrice * 0.5);
                $remainingAmount = $totalPrice - $payAmount;
            } else {
                // Midtrans pembayaran lunas 100% penuh (tidak perlu DP)
                $payAmount = $totalPrice;
                $remainingAmount = 0;
            }
            $dpAmount = (int) round($totalPrice * 0.5);

            $bookingCode = $booking['booking_code'] ?? ('RMA-' . $booking['id']);
            $qrData = "RAMA-HOMESTAY|{$bookingCode}|{$booking['guest_name']}|{$booking['check_in']}|{$booking['check_out']}|{$booking['nights']}MLM|" . strtoupper($currentStatus);
            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&ecc=M&data=" . urlencode($qrData);
        @endphp

        {{-- Top Status Pill --}}
        <div class="no-print" style="display:flex; justify-content:center; margin-bottom:24px;">
            @if($isPaid)
                <div style="display:inline-flex; gap:8px; align-items:center; font-weight:700; color:#10b981; font-size:0.88rem; background:#dcfce7; padding:8px 22px; border-radius:30px; border:1px solid #bbf7d0;">
                    <i data-lucide="check-circle" style="width:16px; height:16px;"></i>
                    <span>PEMBAYARAN BERHASIL &amp; TERKONFIRMASI</span>
                </div>
            @elseif($isCancelled)
                <div style="display:inline-flex; gap:8px; align-items:center; font-weight:700; color:#ef4444; font-size:0.88rem; background:#fee2e2; padding:8px 22px; border-radius:30px; border:1px solid #fecaca;">
                    <i data-lucide="alert-octagon" style="width:16px; height:16px;"></i>
                    <span>RESERVASI DIBATALKAN / WAKTU HABIS</span>
                </div>
            @else
                <div style="display:inline-flex; gap:8px; align-items:center; font-weight:700; color:#d97706; font-size:0.88rem; background:#fef3c7; padding:8px 22px; border-radius:30px; border:1px solid #fde68a;">
                    <i data-lucide="clock" style="width:16px; height:16px;"></i>
                    <span>{{ $isCash ? 'MENUNGGU PEMBAYARAN DP (KAMAR DI-HOLD SEMENTARA)' : 'MENUNGGU PEMBAYARAN LUNAS (KAMAR DI-HOLD SEMENTARA)' }}</span>
                </div>
            @endif
        </div>

        <div class="booking-grid">

            {{-- ============================= --}}
            {{-- LEFT PANEL: PAYMENT INFO     --}}
            {{-- ============================= --}}
            <div class="payment-panel no-print">

                {{-- Countdown Timer Box for Pending --}}
                @if(!$isPaid && !$isCancelled)
                <div id="expiry-timer-box" style="background:#fff7ed; border:1.5px solid #fdba74; border-radius:20px; padding:20px 24px; box-shadow:0 8px 24px rgba(234,88,12,0.08);">
                    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:14px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:44px; height:44px; border-radius:12px; background:#ffedd5; display:flex; align-items:center; justify-content:center; color:#ea580c; flex-shrink:0;">
                                <i data-lucide="hourglass" style="width:22px; height:22px;"></i>
                            </div>
                            <div>
                                <div style="font-size:0.75rem; font-weight:800; text-transform:uppercase; letter-spacing:1px; color:#c2410c;">Batas Waktu Pembayaran</div>
                                <div id="countdown-timer" style="font-size:1.45rem; font-weight:900; color:#ea580c; font-family:monospace; line-height:1.2;">--:--</div>
                            </div>
                        </div>
                        <div style="font-size:0.78rem; color:#9a3412; max-width:230px; line-height:1.4;">
                            Kamar di-hold selama <strong>30 menit</strong>. Jika tidak dibayar, kamar otomatis dilepas untuk tamu lain.
                        </div>
                    </div>
                </div>
                @endif

                {{-- Cancelled State Box --}}
                @if($isCancelled)
                <div style="background:#fef2f2; border:1.5px solid #fecaca; border-radius:20px; padding:24px 26px; text-align:center; box-shadow:0 10px 25px rgba(239,68,68,0.06);">
                    <div style="width:52px; height:52px; background:#fee2e2; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px; color:#ef4444;">
                        <i data-lucide="x-circle" style="width:28px; height:28px;"></i>
                    </div>
                    <h3 style="font-weight:800; font-size:1.15rem; color:#991b1b; margin:0 0 6px;">Reservasi Kedaluwarsa / Dibatalkan</h3>
                    <p style="font-size:0.83rem; margin:0 0 16px; color:#b91c1c; line-height:1.5;">
                        Batas waktu pembayaran telah habis atau pesanan dibatalkan. Kamar telah dilepaskan dan tersedia untuk tamu lain.
                    </p>
                    <a href="{{ route('home') }}#rooms" class="btn btn-primary" style="padding:11px 22px; font-size:0.88rem; border-radius:12px; background:var(--primary); color:white; text-decoration:none; display:inline-flex; align-items:center; gap:8px; font-weight:700;">
                        <i data-lucide="calendar-plus" style="width:16px; height:16px;"></i>
                        <span>Cari &amp; Pesan Kamar Baru</span>
                    </a>
                </div>
                @endif

                {{-- Payment options if still pending --}}
                @if(!$isPaid && !$isCancelled)
                    @if($isMidtrans && !empty($snapToken))
                    <div style="background:linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color:white; border-radius:20px; padding:24px 26px; box-shadow:0 15px 35px rgba(15,23,42,0.14); border:1px solid #334155;">
                        <div style="display:inline-flex; align-items:center; gap:6px; background:rgba(245,166,35,0.2); color:#ffc15e; border:1px solid rgba(245,166,35,0.3); padding:3px 10px; border-radius:15px; font-size:0.72rem; font-weight:700; margin-bottom:10px;">
                            <i data-lucide="shield-check" style="width:12px; height:12px;"></i>
                            <span>Midtrans Payment Gateway</span>
                        </div>
                        <h3 style="font-size:1.1rem; font-weight:800; margin:0 0 5px; color:white;">Selesaikan Pembayaran</h3>
                        <p style="margin:0 0 16px; font-size:0.82rem; color:#94a3b8;">Bayar via QRIS, Virtual Account Bank, atau E-Wallet.</p>
                        <div style="background:rgba(245,166,35,0.1); border:1px solid rgba(245,166,35,0.25); border-radius:12px; padding:14px 16px; margin-bottom:16px;">
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <span style="font-size:0.78rem; color:#fbbf24; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;">Total Tagihan:</span>
                                <strong style="font-size:1.45rem; color:var(--primary); font-weight:900;">Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong>
                            </div>
                        </div>
                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                            <button type="button" id="btn-pay-midtrans" class="btn-step-nav" style="flex:1; justify-content:center; background:linear-gradient(135deg,#10b981 0%,#059669 100%); color:white; box-shadow:0 6px 20px rgba(16,185,129,0.3); font-size:0.88rem;">
                                <i data-lucide="credit-card" style="width:16px; height:16px;"></i>
                                <span>Bayar Sekarang (Rp {{ number_format($totalPrice, 0, ',', '.') }})</span>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if($isCash)
                    <div style="background:#fffbeb; border:1.5px solid #fde68a; border-radius:20px; padding:22px 24px; box-shadow:0 10px 25px rgba(217,119,6,0.06); color:#92400e;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                            <div style="width:40px; height:40px; border-radius:10px; background:#fef3c7; display:flex; align-items:center; justify-content:center; color:#d97706; flex-shrink:0;">
                                <i data-lucide="banknote" style="width:22px; height:22px;"></i>
                            </div>
                            <div>
                                <h4 style="font-size:0.95rem; font-weight:800; color:#b45309; margin:0 0 2px;">Pembayaran Cash — Wajib DP 50%</h4>
                                <span style="font-size:0.7rem; font-weight:800; background:#fef3c7; color:#b45309; padding:2px 8px; border-radius:8px; border:1px solid #fcd34d;">DP 50%</span>
                            </div>
                        </div>
                        <p style="font-size:0.83rem; margin:0 0 14px; line-height:1.6; color:#78350f;">
                            Bayar <strong>DP 50% sebesar Rp {{ number_format($dpAmount, 0, ',', '.') }}</strong> kepada pengelola homestay dalam 30 menit. Sisa Rp {{ number_format($remainingAmount, 0, ',', '.') }} dilunasi saat check-in.
                        </p>
                        @if(!empty($snapToken))
                        <button type="button" id="btn-pay-midtrans" class="btn-step-nav" style="width:100%; justify-content:center; background:linear-gradient(135deg,#10b981 0%,#059669 100%); color:white; box-shadow:0 6px 20px rgba(16,185,129,0.25); font-size:0.88rem; margin-bottom:12px;">
                            <i data-lucide="credit-card" style="width:16px; height:16px;"></i>
                            <span>Bayar Sekarang (DP 50% — Rp {{ number_format($dpAmount, 0, ',', '.') }})</span>
                        </button>
                        @endif
                        <div style="background:rgba(255,255,255,0.8); border:1px solid #fcd34d; border-radius:10px; padding:10px 12px; display:flex; align-items:center; gap:8px; font-weight:700; font-size:0.78rem; color:#15803d;">
                            <i data-lucide="shield-check" style="width:16px; height:16px; flex-shrink:0;"></i>
                            <span>Garansi Refund 100%: Jika batal, DP 50% dikembalikan penuh.</span>
                        </div>
                    </div>
                    @endif

                    {{-- Cancel Booking Button for Guest (hanya tampil dalam 24 jam pertama) --}}
                    @if(!empty($booking['id']) && $reservation && $reservation->canCancel())
                    <form action="{{ route('tamu.reservation.cancel', $booking['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?\n\nDana Anda sebesar Rp {{ number_format($totalPrice, 0, ',', '.') }} akan otomatis dikembalikan.');">
                        @csrf
                        <button type="submit" class="btn-step-nav" style="width:100%; justify-content:center; background:#ffffff; color:#dc2626; border:1.5px solid #fecaca; box-shadow:0 2px 8px rgba(0,0,0,0.03); font-size:0.82rem; padding:11px 18px;">
                            <i data-lucide="x-circle" style="width:16px; height:16px;"></i>
                            <span>Batalkan Pesanan Ini</span>
                        </button>
                    </form>
                    @elseif(!empty($booking['id']) && $reservation && !$reservation->canCancel() && $reservation->status !== 'cancelled')
                    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:12px 16px; font-size:0.8rem; color:#94a3b8; text-align:center;">
                        <i data-lucide="clock" style="width:14px; height:14px; display:inline; vertical-align:middle; margin-right:5px;"></i>
                        Batas waktu pembatalan (24 jam) telah lewat
                    </div>
                    @endif
                @endif

                {{-- Success State Box --}}
                @if($isPaid)
                <div style="background:linear-gradient(135deg,#f0fdf4,#dcfce7); border:1.5px solid #bbf7d0; border-radius:20px; padding:24px 26px; text-align:center;">
                    <div style="width:56px; height:56px; background:#10b981; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 12px; box-shadow:0 8px 20px rgba(16,185,129,0.3);">
                        <i data-lucide="check-circle-2" style="width:30px; height:30px; color:white;"></i>
                    </div>
                    <h3 style="font-weight:800; font-size:1.15rem; color:#166534; margin:0 0 5px;">Pembayaran Berhasil!</h3>
                    <p style="margin:0; font-size:0.85rem; color:#15803d;">Status reservasi: <strong>Terkonfirmasi</strong>. Kamar telah resmi diamankan untuk Anda.</p>
                </div>
                @endif

                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    @if(!empty($booking['id']))
                    <a href="{{ route('tamu.reservation.show', $booking['id']) }}" class="btn-step-nav" style="flex:1; justify-content:center; background:#1e293b; color:white; text-decoration:none; box-shadow:0 4px 15px rgba(15,23,42,0.15); min-width:130px;">
                        <i data-lucide="file-text" style="width:15px; height:15px;"></i>
                        <span>Lihat Detail</span>
                    </a>
                    @endif
                    <button onclick="window.print()" class="btn-step-nav" style="flex:1; justify-content:center; background:#475569; color:white; box-shadow:0 4px 15px rgba(15,23,42,0.15); min-width:130px;">
                        <i data-lucide="printer" style="width:15px; height:15px;"></i>
                        <span>Cetak Tiket</span>
                    </button>
                    <a href="{{ route('tamu.dashboard') }}" class="btn-step-nav" style="flex:1; justify-content:center; background:var(--primary); color:white; text-decoration:none; box-shadow:0 4px 15px rgba(245,166,35,0.2); min-width:130px;">
                        <i data-lucide="layout-dashboard" style="width:15px; height:15px;"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

            </div>{{-- end .payment-panel --}}

            {{-- ============================= --}}
            {{-- RIGHT PANEL: VOUCHER TICKET  --}}
            {{-- ============================= --}}
            <div class="voucher-card">

                <div class="voucher-header">
                    <div class="voucher-badge" style="{{ $isPaid ? 'background:rgba(16,185,129,0.25); color:#34d399; border:1px solid rgba(16,185,129,0.3);' : ($isCancelled ? 'background:rgba(239,68,68,0.25); color:#fca5a5; border:1px solid rgba(239,68,68,0.3);' : 'background:rgba(245,158,11,0.2); color:#fcd34d; border:1px solid rgba(245,158,11,0.3);') }}">
                        <i data-lucide="{{ $isPaid ? 'check-check' : ($isCancelled ? 'x-circle' : 'clock') }}" style="width:13px; height:13px;"></i>
                        <span>{{ $isPaid ? 'Terkonfirmasi' : ($isCancelled ? 'Kedaluwarsa / Dibatalkan' : ($isCash ? 'Menunggu DP 50%' : 'Menunggu Pembayaran')) }}</span>
                    </div>
                    <h2 style="font-family:'Times New Roman', Times, serif; font-size:2rem; color:white; font-weight:normal; margin:0 0 4px 0;">Rama Homestay</h2>
                    <p style="color:#94a3b8; font-size:0.8rem; margin:0; text-transform:uppercase; letter-spacing:2px;">Digital Booking Voucher</p>
                    <div style="position:absolute; right:22px; bottom:14px; color:rgba(255,255,255,0.05); font-size:3.2rem; font-weight:900; font-family:sans-serif; user-select:none;">RAMA</div>
                </div>

                <div class="voucher-body">
                    <div class="detail-row">
                        <span class="detail-label">ID Pesanan:</span>
                        <span class="detail-val" style="color:var(--primary);">#{{ $booking['id'] }} — {{ $bookingCode }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nama Kamar:</span>
                        <span class="detail-val">{{ $booking['room_name'] }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Metode Bayar:</span>
                        <span class="detail-val" style="color:#0284c7; font-size:0.8rem;">{{ $booking['payment_method'] }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="detail-val" style="color:{{ $isPaid ? '#10b981' : ($isCancelled ? '#ef4444' : '#e0921b') }}; font-weight:800;">
                            {{ $isPaid ? 'Terkonfirmasi' : ($isCancelled ? 'Kedaluwarsa / Dibatalkan' : ($isCash ? 'Menunggu DP 50%' : 'Menunggu Pembayaran (Hold 30 Menit)')) }}
                        </span>
                    </div>
                </div>

                <div class="ticket-divider"></div>

                <div class="voucher-body" style="padding-top:20px;">
                    <h4 style="font-size:0.75rem; font-weight:800; color:#475569; text-transform:uppercase; letter-spacing:1px; margin:0 0 12px; border-bottom:1px solid #f1f5f9; padding-bottom:6px;">Detail Tamu &amp; Menginap</h4>

                    <div class="detail-row">
                        <span class="detail-label">Nama Tamu:</span>
                        <span class="detail-val">{{ $booking['guest_name'] }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email:</span>
                        <span class="detail-val">{{ $booking['guest_email'] }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Telepon:</span>
                        <span class="detail-val">{{ $booking['guest_phone'] }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Check-in:</span>
                        <span class="detail-val">{{ \Carbon\Carbon::parse($booking['check_in'])->format('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Check-out:</span>
                        <span class="detail-val">{{ \Carbon\Carbon::parse($booking['check_out'])->format('d F Y') }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Durasi:</span>
                        <span class="detail-val">{{ $booking['nights'] }} Malam</span>
                    </div>

                    <div class="detail-row" style="margin-top:14px; padding-top:12px; border-top:1px solid #f1f5f9;">
                        <span class="detail-label" style="color:#0f172a; font-weight:800; font-size:0.86rem;">Total Biaya Kamar:</span>
                        <span class="detail-val" style="color:#0f172a; font-size:0.98rem; font-weight:900;">Rp {{ number_format($booking['total_price'], 0, ',', '.') }}</span>
                    </div>
                    @if($isCash)
                    <div class="detail-row" style="background:#fffbeb; padding:10px 12px; border-radius:10px; border:1px solid #fde68a; margin-top:4px;">
                        <span class="detail-label" style="color:#92400e; font-weight:800;">DP 50% (Dibayar Sekarang):</span>
                        <span class="detail-val" style="color:var(--primary); font-size:0.98rem; font-weight:900;">Rp {{ number_format($dpAmount, 0, ',', '.') }}</span>
                    </div>
                    <div class="detail-row" style="padding:2px 12px 0;">
                        <span class="detail-label" style="color:#64748b; font-size:0.8rem;">Sisa saat Check-in:</span>
                        <span class="detail-val" style="color:#10b981; font-weight:700; font-size:0.82rem;">Rp {{ number_format($remainingAmount, 0, ',', '.') }}</span>
                    </div>
                    @else
                    <div class="detail-row" style="background:#f0fdf4; padding:10px 12px; border-radius:10px; border:1px solid #bbf7d0; margin-top:4px;">
                        <span class="detail-label" style="color:#166534; font-weight:800;">Tagihan Pembayaran:</span>
                        <span class="detail-val" style="color:#16a34a; font-size:0.98rem; font-weight:900;">Rp {{ number_format($booking['total_price'], 0, ',', '.') }}</span>
                    </div>
                    @endif

                    {{-- QR Code --}}
                    <div class="qr-area">
                        <div class="qr-code-box">
                            <img src="{{ $qrUrl }}" alt="QR Code {{ $bookingCode }}" width="150" height="150" loading="lazy" style="display:block; border-radius:6px;">
                        </div>
                        <p style="font-size:0.7rem; color:#94a3b8; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; margin:0 0 3px; text-align:center;">Scan untuk Verifikasi</p>
                        <p style="font-size:0.85rem; color:#0f172a; font-weight:900; margin:0 0 8px; text-align:center; letter-spacing:0.5px;">{{ $bookingCode }}</p>

                        @if($isPaid)
                            <div style="background:#dcfce7; color:#166534; border:1px solid #bbf7d0; border-radius:8px; padding:5px 14px; font-size:0.73rem; font-weight:800; text-transform:uppercase; letter-spacing:1px; display:inline-flex; align-items:center; gap:5px;">
                                <i data-lucide="check-circle" style="width:12px; height:12px;"></i>
                                LUNAS &amp; VALID
                            </div>
                        @elseif($isCancelled)
                            <div style="background:#fee2e2; color:#991b1b; border:1px solid #fecaca; border-radius:8px; padding:5px 14px; font-size:0.73rem; font-weight:800; text-transform:uppercase; letter-spacing:1px; display:inline-flex; align-items:center; gap:5px;">
                                <i data-lucide="x-circle" style="width:12px; height:12px;"></i>
                                TIDAK BERLAKU (BATAL)
                            </div>
                        @else
                            <div style="background:#fef3c7; color:#92400e; border:1px solid #fde68a; border-radius:8px; padding:5px 14px; font-size:0.73rem; font-weight:800; text-transform:uppercase; letter-spacing:1px; display:inline-flex; align-items:center; gap:5px;">
                                <i data-lucide="clock" style="width:12px; height:12px;"></i>
                                {{ $isCash ? 'MENUNGGU PEMBAYARAN DP 50%' : 'MENUNGGU PEMBAYARAN' }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>{{-- end .voucher-card --}}

        </div>{{-- end .booking-grid --}}

    </div>
</div>

{{-- Midtrans Snap SDK and Countdown Script --}}
@if(($isMidtrans || $isCash) && !$isPaid && !$isCancelled && !empty($snapToken))
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const btnPay = document.getElementById('btn-pay-midtrans');
        const snapToken = @json($snapToken);
        const syncUrl = @json(route('tamu.pay.sync', $booking['id']));
        const csrfToken = @json(csrf_token());

        function triggerMidtransPay() {
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    fetch(syncUrl, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                        body: JSON.stringify({ transaction_status: result.transaction_status, transaction_id: result.transaction_id, payment_type: result.payment_type })
                    }).then(() => window.location.reload()).catch(() => window.location.reload());
                },
                onPending: function(result) {
                    alert('Pembayaran sedang diproses. Silakan selesaikan pembayaran sesuai panduan.');
                    window.location.reload();
                },
                onError: function(result) { alert('Pembayaran gagal atau dibatalkan.'); },
                onClose: function() { console.log('Customer closed popup.'); }
            });
        }

        if (btnPay) btnPay.addEventListener('click', triggerMidtransPay);

        window.addEventListener('load', function() {
            setTimeout(triggerMidtransPay, 800);
        });
    </script>
@endif

{{-- Expiration Countdown Timer Script --}}
@if(!$isPaid && !$isCancelled && !empty($booking['expires_at']))
<script>
    (function() {
        const expiresAtStr = @json($booking['expires_at']);
        const timerElem = document.getElementById('countdown-timer');
        if (!expiresAtStr || !timerElem) return;

        const targetTime = new Date(expiresAtStr).getTime();

        function updateTimer() {
            const now = new Date().getTime();
            const remaining = targetTime - now;

            if (remaining <= 0) {
                timerElem.textContent = "00:00 (Habis)";
                const timerBox = document.getElementById('expiry-timer-box');
                if (timerBox) {
                    timerBox.style.background = "#fef2f2";
                    timerBox.style.borderColor = "#fecaca";
                }
                const btnPay = document.getElementById('btn-pay-midtrans');
                if (btnPay) {
                    btnPay.disabled = true;
                    btnPay.style.opacity = '0.5';
                    btnPay.style.cursor = 'not-allowed';
                    btnPay.innerText = 'Waktu Pembayaran Telah Habis';
                }
                clearInterval(interval);
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
                return;
            }

            const minutes = Math.floor(remaining / 60000);
            const seconds = Math.floor((remaining % 60000) / 1000);
            timerElem.textContent = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        }

        updateTimer();
        const interval = setInterval(updateTimer, 1000);
    })();
</script>
@endif

@endsection

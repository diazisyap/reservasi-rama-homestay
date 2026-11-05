@extends('layouts.app')

@section('title', 'Pembayaran Reservasi #' . $reservation->booking_code)

@section('content')
<style>
    .pay-wrapper {
        padding: 50px 0 90px;
        background: #f8fafc;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .pay-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        max-width: 600px;
        width: 100%;
        overflow: hidden;
    }
    .pay-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: white;
        padding: 30px;
        text-align: center;
        position: relative;
    }
    .pay-badge-sandbox {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(245, 166, 35, 0.2);
        color: #ffc15e;
        border: 1px solid rgba(245, 166, 35, 0.4);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    .pay-body {
        padding: 35px 30px;
    }
    .pay-amount-box {
        background: #f8fafc;
        border-radius: 16px;
        padding: 24px;
        border: 1.5px dashed #cbd5e1;
        text-align: center;
        margin-bottom: 25px;
    }
    .btn-pay-now {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        font-weight: 800;
        font-size: 1.05rem;
        padding: 16px 28px;
        border-radius: 14px;
        border: none;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        transition: all 0.25s ease;
    }
    .btn-pay-now:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4);
    }
    .channel-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        justify-content: center;
        margin-top: 15px;
    }
    .channel-badge {
        background: #f1f5f9;
        color: #475569;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
    }
</style>

<div class="pay-wrapper">
    <div class="container" style="display: flex; justify-content: center;">
        <div class="pay-card">
            
            <div class="pay-header">
                <div class="pay-badge-sandbox">
                    <i data-lucide="shield-check" style="width: 14px; height: 14px;"></i>
                    <span>Midtrans Sandbox Payment</span>
                </div>
                <h2 style="margin: 0 0 6px; font-size: 1.8rem; font-weight: 800; color: white;">Pembayaran Reservasi</h2>
                <p style="margin: 0; color: #94a3b8; font-size: 0.9rem;">Kode Booking: <strong>{{ $reservation->booking_code }}</strong></p>
            </div>

            <div class="pay-body">
                
                @if($reservation->status === 'confirmed')
                    <div style="background: #dcfce7; color: #166534; padding: 20px; border-radius: 16px; text-align: center; margin-bottom: 25px;">
                        <i data-lucide="check-circle-2" style="width: 48px; height: 48px; margin-bottom: 10px; color: #16a34a;"></i>
                        <h3 style="font-weight: 800; font-size: 1.3rem; margin: 0 0 6px;">Pembayaran Telah Selesai!</h3>
                        <p style="margin: 0; font-size: 0.9rem;">Reservasi ini sudah berstatus <strong>Terkonfirmasi (Lunas)</strong>.</p>
                    </div>

                    <div style="display: flex; gap: 12px;">
                        <a href="{{ route('tamu.booking.success') }}" class="btn-pay-now" style="background: var(--primary); text-decoration: none;">
                            <i data-lucide="ticket"></i>
                            <span>Lihat E-Voucher</span>
                        </a>
                        <a href="{{ route('tamu.dashboard') }}" class="btn-pay-now" style="background: #0f172a; text-decoration: none;">
                            <i data-lucide="layout-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                @else
                    {{-- Countdown Box --}}
                    @if($reservation->expires_at)
                    <div id="pay-timer-box" style="background:#fff7ed; border:1.5px solid #fdba74; border-radius:16px; padding:16px 20px; margin-bottom:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:38px; height:38px; border-radius:10px; background:#ffedd5; display:flex; align-items:center; justify-content:center; color:#ea580c;">
                                <i data-lucide="timer" style="width:20px; height:20px;"></i>
                            </div>
                            <div>
                                <span style="font-size:0.72rem; font-weight:800; text-transform:uppercase; letter-spacing:0.8px; color:#c2410c; display:block;">Batas Waktu Pembayaran</span>
                                <span id="pay-countdown" style="font-size:1.3rem; font-weight:900; color:#ea580c; font-family:monospace;">--:--</span>
                            </div>
                        </div>
                        <span style="font-size:0.75rem; color:#9a3412;">Kamar di-hold selama <strong>30 menit</strong></span>
                    </div>
                    @endif

                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.95rem;">
                            <span style="color: #64748b;">Kamar Homestay:</span>
                            <span style="font-weight: 700; color: #0f172a;">{{ $reservation->room->name }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.95rem;">
                            <span style="color: #64748b;">Tanggal Menginap:</span>
                            <span style="font-weight: 600; color: #0f172a;">
                                {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }} - {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }} ({{ $reservation->nights }} malam)
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.95rem;">
                            <span style="color: #64748b;">Nama Tamu:</span>
                            <span style="font-weight: 600; color: #0f172a;">{{ $reservation->guest_name }}</span>
                        </div>
                    </div>

                    @php
                        $payMethod = strtolower($reservation->payment_method ?? '');
                        $isCash = str_contains($payMethod, 'cash') || str_contains($payMethod, 'tempat') || str_contains($payMethod, 'cod');
                        $totalPrice = (int) round($reservation->total_price);
                        if ($isCash) {
                            $payAmount = (int) round($totalPrice * 0.5);
                            $remainingAmount = $totalPrice - $payAmount;
                            $tagLabel = 'Tagihan DP 50% (Dibayar Sekarang)';
                            $btnLabel = 'Bayar Sekarang (DP 50% — Rp ' . number_format($payAmount, 0, ',', '.') . ')';
                        } else {
                            $payAmount = $totalPrice;
                            $remainingAmount = 0;
                            $tagLabel = 'Tagihan Pembayaran';
                            $btnLabel = 'Bayar Sekarang (Rp ' . number_format($payAmount, 0, ',', '.') . ')';
                        }
                    @endphp

                    <div class="pay-amount-box">
                        <div style="display:flex; justify-content:space-between; margin-bottom:10px; font-size:0.92rem; color:#64748b;">
                            <span>Total Biaya Kamar:</span>
                            <span style="font-weight:700; color:#0f172a;">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div style="background:rgba(245, 166, 35, 0.12); border-radius:12px; padding:15px; margin:8px 0; border:1px solid rgba(245, 166, 35, 0.3);">
                            <span style="font-size: 0.8rem; font-weight: 800; color: #b45309; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 4px;">{{ $tagLabel }}</span>
                            <div style="font-size: 2.2rem; font-weight: 900; color: var(--primary);">
                                Rp {{ number_format($payAmount, 0, ',', '.') }}
                            </div>
                        </div>
                        @if($isCash)
                            <div style="display:flex; justify-content:space-between; font-size:0.85rem; color:#64748b; margin-top:10px;">
                                <span>Sisa Pelunasan di Homestay:</span>
                                <span style="font-weight:700; color:#10b981;">Rp {{ number_format($remainingAmount, 0, ',', '.') }} (Saat Check-in)</span>
                            </div>
                        @endif
                    </div>

                    @if(!empty($snapToken))
                        <button type="button" id="pay-button" class="btn-pay-now">
                            <i data-lucide="credit-card" style="width: 20px; height: 20px;"></i>
                            <span>{{ $btnLabel }}</span>
                        </button>
                        
                        <div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#15803d; border-radius:10px; padding:10px 14px; font-size:0.8rem; font-weight:700; margin-top:14px; display:flex; align-items:center; gap:8px;">
                            <i data-lucide="shield-check" style="width:16px; height:16px; flex-shrink:0;"></i>
                            <span>Garansi Refund 100%: Jika Anda batal reservasi, DP 50% akan dikembalikan penuh.</span>
                        </div>
                    @else
                        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 12px; font-size: 0.9rem; text-align: center;">
                            Gagal memuat token pembayaran. Silakan hubungi admin atau muat ulang halaman.
                        </div>
                    @endif

                    <div class="channel-badges">
                        <span class="channel-badge">QRIS</span>
                        <span class="channel-badge">GoPay</span>
                        <span class="channel-badge">ShopeePay</span>
                        <span class="channel-badge">BCA VA</span>
                        <span class="channel-badge">BNI VA</span>
                        <span class="channel-badge">BRI VA</span>
                        <span class="channel-badge">Mandiri Bill</span>
                        <span class="channel-badge">Kartu Kredit</span>
                    </div>

                    <div style="margin-top: 25px; display: flex; flex-direction: column; gap: 12px; align-items: center;">
                        <form action="{{ route('tamu.reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Kamar akan langsung dilepaskan untuk tamu lain.');" style="width: 100%;">
                            @csrf
                            <button type="submit" style="width: 100%; padding: 11px 18px; border-radius: 12px; font-weight: 700; font-size: 0.85rem; background: #fff; color: #dc2626; border: 1.5px solid #fecaca; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <i data-lucide="x-circle" style="width: 16px; height: 16px;"></i>
                                <span>Batalkan Reservasi (Lepaskan Kamar)</span>
                            </button>
                        </form>

                        <a href="{{ route('tamu.dashboard') }}" style="color: #64748b; font-size: 0.88rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                            <i data-lucide="arrow-left" style="width: 14px; height: 14px;"></i>
                            <span>Kembali ke Reservasi Saya</span>
                        </a>
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>

@if(!empty($snapToken) && $reservation->status !== 'confirmed')
    <!-- Midtrans Snap JS (Sandbox) -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.getElementById('pay-button');
        const snapToken = @json($snapToken);
        const reservationId = @json($reservation->id);
        const syncUrl = @json(route('tamu.pay.sync', $reservation->id));
        const csrfToken = @json(csrf_token());

        function triggerPayment() {
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    // Sync status to backend
                    fetch(syncUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            transaction_status: result.transaction_status,
                            transaction_id: result.transaction_id,
                            payment_type: result.payment_type
                        })
                    }).then(() => {
                        window.location.reload();
                    }).catch(() => {
                        window.location.reload();
                    });
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    alert('Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran sesuai instruksi.');
                    window.location.href = @json(route('tamu.dashboard'));
                },
                onError: function(result) {
                    console.log('Payment error:', result);
                    alert('Pembayaran gagal atau dibatalkan.');
                },
                onClose: function() {
                    console.log('Customer closed payment popup without finishing');
                }
            });
        }

        if (payButton) {
            payButton.addEventListener('click', triggerPayment);
        }

        // Auto trigger popup on load
        window.addEventListener('load', function() {
            setTimeout(triggerPayment, 600);
        });
    </script>
@endif

@if(!empty($reservation->expires_at) && $reservation->status === 'pending')
<script>
    (function() {
        const expiresAtStr = @json($reservation->expires_at ? $reservation->expires_at->toIso8601String() : null);
        const timerElem = document.getElementById('pay-countdown');
        if (!expiresAtStr || !timerElem) return;

        const targetTime = new Date(expiresAtStr).getTime();

        function updatePayTimer() {
            const now = new Date().getTime();
            const remaining = targetTime - now;

            if (remaining <= 0) {
                timerElem.textContent = "00:00 (Habis)";
                const timerBox = document.getElementById('pay-timer-box');
                if (timerBox) {
                    timerBox.style.background = "#fef2f2";
                    timerBox.style.borderColor = "#fecaca";
                }
                const payBtn = document.getElementById('pay-button');
                if (payBtn) {
                    payBtn.disabled = true;
                    payBtn.style.opacity = '0.5';
                    payBtn.style.cursor = 'not-allowed';
                    payBtn.innerText = 'Waktu Pembayaran Telah Habis';
                }
                clearInterval(interval);
                setTimeout(function() {
                    window.location.reload();
                }, 1500);
                return;
            }

            const minutes = Math.floor(remaining / 60000);
            const seconds = Math.floor((remaining % 60000) / 1000);
            timerElem.textContent = (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        }

        updatePayTimer();
        const interval = setInterval(updatePayTimer, 1000);
    })();
</script>
@endif

@endsection

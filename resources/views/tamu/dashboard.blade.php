@extends('layouts.app')

@section('title', 'Reservasi Saya')

@section('content')
<div class="dashboard-wrapper" style="padding: 45px 0 80px; background: #f8fafc; min-height: 70vh;">
    <div class="container">
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Area Pelanggan</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Dashboard Pelanggan</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Kelola reservasi homestay, data pribadi, dan riwayat pesanan Anda.</p>
        </div>

        <div class="dashboard-grid" style="margin-top: 0;">
            
            <!-- Sidebar -->
            <aside class="dashboard-sidebar" style="background: #ffffff; border-radius: 20px; padding: 30px 24px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0;">
                <div class="user-info" style="text-align: center; margin-bottom: 30px; padding-bottom: 25px; border-bottom: 1px solid #f1f5f9;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, var(--primary) 0%, #ffc15e 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: white; font-weight: 700; font-size: 1.5rem; box-shadow: 0 10px 20px -5px rgba(245, 166, 35, 0.3);">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">{{ auth()->user()->name }}</h3>
                    <p style="font-size: 0.85rem; color: #64748b; margin: 0; word-break: break-all;">{{ auth()->user()->email }}</p>
                </div>
                
                <nav class="sidebar-menu" style="display: flex; flex-direction: column; gap: 8px;">
                    <a href="{{ route('tamu.dashboard') }}" class="sidebar-link active">
                        <i data-lucide="calendar"></i>
                        <span>Reservasi Saya</span>
                    </a>

                    <a href="{{ route('profile') }}" class="sidebar-link">
                        <i data-lucide="user-cog"></i>
                        <span>Profil Saya</span>
                    </a>

                    <a href="{{ route('rooms.index') }}" class="sidebar-link">
                        <i data-lucide="door-open"></i>
                        <span>Pesan Kamar Baru</span>
                    </a>

                    <hr style="margin: 15px 0; border: 0; border-top: 1px solid #f1f5f9;">
                    
                    <form method="POST" action="{{ route('logout') }}" style="width: 100%;">
                        @csrf
                        <button type="submit" class="sidebar-link-logout" style="width: 100%; display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-radius: 12px; font-weight: 600; font-size: 0.95rem; background: transparent; border: none; cursor: pointer; color: #ef4444; text-align: left; transition: all 0.2s;">
                            <i data-lucide="log-out"></i>
                            <span>Keluar Akun</span>
                        </button>
                    </form>
                </nav>
            </aside>
            
            <!-- Main Content Area -->
            <main class="dashboard-main-content" style="background: #ffffff; border-radius: 20px; padding: 35px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0;">
                
                {{-- Flash Message --}}
                @if(session('success'))
                    <div style="background: #ecfdf5; border: 1.5px solid #a7f3d0; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; color: #065f46; display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem;">
                        <i data-lucide="check-circle" style="width: 20px; height: 20px; color: #059669; flex-shrink: 0; margin-top: 1px;"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif
                @if(session('error'))
                    <div style="background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; color: #991b1b; display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem;">
                        <i data-lucide="alert-circle" style="width: 20px; height: 20px; color: #dc2626; flex-shrink: 0; margin-top: 1px;"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                <div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h2 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;">Daftar Reservasi Kamar</h2>
                        <p style="font-size: 0.9rem; color: #64748b; margin: 0;">Berikut adalah seluruh riwayat pemesanan kamar Anda di Rama Homestay.</p>
                    </div>
                </div>
                
                @if($reservations->count() > 0)
                    <div class="table-wrapper" style="border: none; padding: 0; box-shadow: none;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="font-weight: 700; color: #475569;">ID Pesanan</th>
                                    <th style="font-weight: 700; color: #475569;">Kamar</th>
                                    <th style="font-weight: 700; color: #475569;">Check In</th>
                                    <th style="font-weight: 700; color: #475569;">Check Out</th>
                                    <th style="font-weight: 700; color: #475569;">Total Biaya</th>
                                    <th style="font-weight: 700; color: #475569;">Status</th>
                                    <th style="font-weight: 700; color: #475569; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td style="font-weight: 600; color: var(--primary);">
                                            #{{ $reservation->id }}
                                        </td>
                                        <td style="font-weight: 500; color: #0f172a;">{{ $reservation->room->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                                        <td style="font-weight: 700; color: #0f172a;">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            @if($reservation->status === 'pending')
                                                <div style="display:flex; flex-direction:column; gap:4px; align-items:flex-start;">
                                                    <span class="badge badge-pending">Menunggu Bayar</span>
                                                    @if($reservation->expires_at)
                                                        @php
                                                            $minsLeft = max(0, (int) ceil(now()->diffInSeconds($reservation->expires_at, false) / 60));
                                                        @endphp
                                                        <span style="font-size:0.7rem; color:#ea580c; font-weight:700; display:inline-flex; align-items:center; gap:3px;">
                                                            <i data-lucide="clock" style="width:11px; height:11px;"></i> Sisa {{ $minsLeft }} mnt
                                                        </span>
                                                    @endif
                                                </div>
                                            @elseif($reservation->status === 'cancelled')
                                                <div style="display:flex; flex-direction:column; gap:3px; align-items:flex-start;">
                                                    <span class="badge badge-cancelled">
                                                        {{ $reservation->status_label }}
                                                    </span>
                                                    @if($reservation->refund_note)
                                                        <span style="font-size:0.7rem; color:#059669; font-weight:700; display:inline-flex; align-items:center; gap:2px;">
                                                            <i data-lucide="check-check" style="width:11px; height:11px;"></i> Dana Kembali
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="badge badge-{{ $reservation->status }}">
                                                    {{ ucfirst($reservation->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td style="text-align: center;">
                                            <div style="display: flex; gap: 6px; justify-content: center; align-items: center; flex-wrap: wrap;">
                                                @if($reservation->status === 'pending')
                                                    <a href="{{ route('tamu.pay', $reservation->id) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.8rem; border-radius: 8px; background: #10b981; color: white; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; font-weight: 700;">
                                                        <i data-lucide="credit-card" style="width: 14px; height: 14px;"></i> Bayar
                                                    </a>
                                                    <button onclick="syncPaymentStatus({{ $reservation->id }})" class="btn btn-outline" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 8px;" title="Cek Status Pembayaran">
                                                        <i data-lucide="refresh-cw" style="width: 13px; height: 13px;"></i>
                                                    </button>
                                                @endif

                                                @if($reservation->canCancel())
                                                    <form action="{{ route('tamu.reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?\n\nDana sebesar Rp {{ number_format($reservation->total_price, 0, ',', '.') }} akan otomatis dikembalikan ke rekening Anda.');" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 8px; color:#ef4444; border-color:#fecaca;" title="Batalkan Pesanan (Sisa waktu: {{ $reservation->cancel_time_remaining }})">
                                                            <i data-lucide="x" style="width: 13px; height: 13px;"></i> Batal
                                                        </button>
                                                    </form>
                                                @endif

                                                <a href="{{ route('tamu.reservation.show', $reservation->id) }}" class="btn btn-outline" style="padding: 6px 12px; font-size: 0.8rem; border-radius: 8px; text-decoration: none; color: #0f172a; display: inline-flex; align-items: center; gap: 4px; font-weight: 600;">
                                                    <i data-lucide="eye" style="width: 14px; height: 14px; vertical-align: middle;"></i> Rincian
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="padding: 60px 40px; text-align: center;">
                        <i data-lucide="calendar-x" style="width: 64px; height: 64px; color: #94a3b8; margin-bottom: 20px;"></i>
                        <h3 style="margin-bottom: 10px; font-weight: 700; color: #0f172a;">Belum Ada Pesanan</h3>
                        <p style="color: #64748b; margin-bottom: 25px;">Anda belum melakukan reservasi kamar homestay.</p>
                        <a href="{{ route('home') }}#rooms" class="btn btn-primary" style="padding: 12px 24px; border-radius: 10px; color: white; background: var(--primary);">Cari & Pesan Kamar Sekarang</a>
                    </div>
                @endif
            </main>
            
        </div>
    </div>
</div>

<script>
    function syncPaymentStatus(reservationId) {
        const btn = event.currentTarget;
        const originalHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<span style="font-size:0.75rem;">...</span>';

        fetch(`/tamu/pay/${reservationId}/sync`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert(data.message || 'Status reservasi berhasil diperbarui!');
                window.location.reload();
            } else {
                alert(data.message || 'Status belum berubah dari Midtrans.');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            }
        })
        .catch(err => {
            console.error(err);
            alert('Gagal memeriksa status pembayaran.');
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        });
    }
</script>
@endsection

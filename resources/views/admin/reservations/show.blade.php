@extends('layouts.admin')

@section('title', 'Detail Reservasi #' . $reservation->id . ' - Admin')
@section('page_title', 'Detail Reservasi')

@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.reservations.index') }}" class="btn-admin-outline">
        <i data-lucide="arrow-left" style="width:16px;height:16px;"></i> Kembali ke Daftar
    </a>
    <a href="{{ route('admin.reservations.show', $reservation) }}?print=1" onclick="window.print();return false;" class="btn-admin-outline no-print" style="margin-left:8px;">
        <i data-lucide="printer" style="width:16px;height:16px;"></i> Cetak
    </a>
</div>

{{-- Print Header (only visible on print) --}}
<div style="display:none;" class="print-header">
    <h2 style="font-size:1.8rem;font-family:'Times New Roman',serif;margin:0;">R</h2>
    <span style="font-size:0.8rem;letter-spacing:3px;text-transform:uppercase;color:#888;">Rama Homestay</span>
    <h1 style="font-size:1.2rem;font-weight:700;margin:8px 0 0;">Bukti Reservasi</h1>
    <hr>
</div>

<div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start;">

    {{-- LEFT --}}
    <div style="display:flex;flex-direction:column;gap:24px;">

        {{-- Header card --}}
        <div class="admin-card">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:16px;">
                <div>
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
                        <h2 style="font-size:1.5rem;font-weight:800;color:#0f172a;margin:0;">
                            Reservasi #{{ $reservation->id }}
                        </h2>
                        <span class="badge badge-{{ $reservation->status }}" style="font-size:0.78rem;">
                            {{ $reservation->status_label }}
                        </span>
                        @if($reservation->paid_at)
                            <span class="badge badge-paid">&#10003; Lunas</span>
                        @else
                            <span class="badge badge-unpaid">Belum Bayar</span>
                        @endif
                    </div>
                    <p style="color:#64748b;font-size:0.9rem;margin:0;">
                        Kode Booking: <strong style="color:#f5a623;font-family:monospace;">{{ $reservation->booking_code }}</strong>
                    </p>
                    <p style="color:#94a3b8;font-size:0.82rem;margin:4px 0 0;">
                        Dibuat: {{ $reservation->created_at->format('d F Y, H:i') }} WIB
                    </p>
                    @if($reservation->status === 'cancelled')
                        <div style="margin-top:10px; background:#fff1f2; border:1px solid #fecdd3; border-radius:10px; padding:10px 14px; font-size:0.85rem; color:#be123c;">
                            <div><strong>Dibatalkan:</strong> {{ $reservation->cancelled_at ? $reservation->cancelled_at->format('d F Y, H:i') . ' WIB' : 'Ya' }}</div>
                            @if($reservation->refund_note)
                                <div style="margin-top:4px; color:#059669;"><strong>Catatan Pengembalian Dana:</strong> {{ $reservation->refund_note }}</div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Update Status Form --}}
                <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST" class="no-print">
                    @csrf
                    <div style="display:flex;gap:8px;align-items:center;">
                        <select name="status" class="form-select-admin">
                            <option value="pending"   {{ $reservation->status=='pending'?'selected':'' }}>Pending</option>
                            <option value="confirmed" {{ $reservation->status=='confirmed'?'selected':'' }}>Terkonfirmasi</option>
                            <option value="completed" {{ $reservation->status=='completed'?'selected':'' }}>Selesai</option>
                            <option value="cancelled" {{ $reservation->status=='cancelled'?'selected':'' }}>Batalkan</option>
                        </select>
                        <button type="submit" class="btn-admin-primary">
                            <i data-lucide="save" style="width:15px;height:15px;"></i> Perbarui Status
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Guest Info --}}
        <div class="admin-card">
            <h3 style="font-size:1rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin:0 0 20px;">
                <i data-lucide="user" style="width:16px;height:16px;vertical-align:middle;margin-right:6px;"></i>
                Informasi Tamu
            </h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">Nama Lengkap</p>
                    <p style="font-size:1rem;font-weight:700;color:#0f172a;margin:0;">{{ $reservation->guest_name }}</p>
                </div>
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">Email</p>
                    <p style="font-size:0.95rem;font-weight:600;color:#0f172a;margin:0;">{{ $reservation->guest_email }}</p>
                </div>
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">No. Telepon</p>
                    <p style="font-size:0.95rem;font-weight:600;color:#0f172a;margin:0;">{{ $reservation->guest_phone ?? '-' }}</p>
                </div>
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">Akun Tamu</p>
                    <p style="font-size:0.88rem;font-weight:600;color:#475569;margin:0;">{{ $reservation->user->name }} ({{ $reservation->user->email }})</p>
                </div>
                @if($reservation->special_requests)
                <div style="grid-column:1/-1;">
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">Permintaan Khusus</p>
                    <p style="font-size:0.92rem;color:#475569;margin:0;background:#f8fafc;padding:12px;border-radius:8px;font-style:italic;">{{ $reservation->special_requests }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Reservation Details --}}
        <div class="admin-card">
            <h3 style="font-size:1rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin:0 0 20px;">
                <i data-lucide="calendar" style="width:16px;height:16px;vertical-align:middle;margin-right:6px;"></i>
                Detail Menginap
            </h3>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">Kamar</p>
                    <p style="font-size:1rem;font-weight:800;color:#0f172a;margin:0;">{{ $reservation->room->name }}</p>
                    <p style="font-size:0.8rem;color:#64748b;margin:2px 0 0;">Tipe: {{ ucfirst($reservation->room->type) }}</p>
                </div>
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">Check In</p>
                    <p style="font-size:1rem;font-weight:700;color:#0f172a;margin:0;">{{ \Carbon\Carbon::parse($reservation->check_in)->format('d F Y') }}</p>
                    <p style="font-size:0.8rem;color:#64748b;margin:2px 0 0;">{{ \Carbon\Carbon::parse($reservation->check_in)->translatedFormat('l') }}</p>
                </div>
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;margin:0 0 4px;">Check Out</p>
                    <p style="font-size:1rem;font-weight:700;color:#0f172a;margin:0;">{{ \Carbon\Carbon::parse($reservation->check_out)->format('d F Y') }}</p>
                    <p style="font-size:0.8rem;color:#64748b;margin:2px 0 0;">{{ $reservation->nights }} malam</p>
                </div>
            </div>
        </div>

        {{-- Payment Info --}}
        <div class="admin-card">
            <h3 style="font-size:1rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin:0 0 20px;">
                <i data-lucide="credit-card" style="width:16px;height:16px;vertical-align:middle;margin-right:6px;"></i>
                Informasi Pembayaran
            </h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;margin:0 0 4px;">Metode Pembayaran</p>
                    <p style="font-size:0.95rem;font-weight:700;color:#0f172a;margin:0;">{{ $reservation->payment_method ?? 'Midtrans' }}</p>
                </div>
                @if($reservation->midtrans_payment_type)
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;margin:0 0 4px;">Tipe Midtrans</p>
                    <p style="font-size:0.95rem;font-weight:700;color:#0f172a;margin:0;text-transform:uppercase;">{{ $reservation->midtrans_payment_type }}</p>
                </div>
                @endif
                @if($reservation->midtrans_transaction_id)
                <div style="grid-column:1/-1;">
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;margin:0 0 4px;">Transaction ID Midtrans</p>
                    <p style="font-size:0.88rem;font-weight:600;color:#475569;margin:0;font-family:monospace;">{{ $reservation->midtrans_transaction_id }}</p>
                </div>
                @endif
                <div>
                    <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;margin:0 0 4px;">Status Bayar</p>
                    @if($reservation->paid_at)
                        <span class="badge badge-paid" style="font-size:0.82rem;">&#10003; LUNAS</span>
                        <p style="font-size:0.8rem;color:#059669;margin:4px 0 0;">Dibayar: {{ \Carbon\Carbon::parse($reservation->paid_at)->format('d F Y, H:i') }} WIB</p>
                    @else
                        <span class="badge badge-unpaid" style="font-size:0.82rem;">BELUM BAYAR</span>
                    @endif
                </div>
            </div>

            {{-- Price Breakdown --}}
            <div style="background:#f8fafc;border-radius:12px;padding:20px;">
                <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                    <span style="color:#64748b;font-size:0.9rem;">Harga Kamar ({{ $reservation->nights }} malam × Rp {{ number_format($reservation->room->price, 0, ',', '.') }})</span>
                    <span style="font-weight:600;color:#0f172a;">Rp {{ number_format($reservation->base_price, 0, ',', '.') }}</span>
                </div>
                @if($reservation->tax_amount > 0)
                <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                    <span style="color:#64748b;font-size:0.9rem;">Pajak ({{ $reservation->room->tax_rate }}%)</span>
                    <span style="font-weight:600;color:#0f172a;">Rp {{ number_format($reservation->tax_amount, 0, ',', '.') }}</span>
                </div>
                @endif
                @if($reservation->service_amount > 0)
                <div style="display:flex;justify-content:space-between;margin-bottom:16px;">
                    <span style="color:#64748b;font-size:0.9rem;">Biaya Layanan ({{ $reservation->room->service_rate }}%)</span>
                    <span style="font-weight:600;color:#0f172a;">Rp {{ number_format($reservation->service_amount, 0, ',', '.') }}</span>
                </div>
                @endif
                <div style="border-top:2px solid #e2e8f0;padding-top:14px;display:flex;justify-content:space-between;">
                    <span style="font-size:1rem;font-weight:800;color:#0f172a;">TOTAL</span>
                    <span style="font-size:1.2rem;font-weight:800;color:#f5a623;">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT --}}
    <div style="display:flex;flex-direction:column;gap:20px;">
        {{-- Quick Status --}}
        <div class="admin-card" style="text-align:center;padding:24px;">
            <div style="width:64px;height:64px;border-radius:50%;background:{{ $reservation->status=='confirmed'||$reservation->status=='completed' ? 'rgba(16,185,129,0.1)' : ($reservation->status=='cancelled' ? 'rgba(239,68,68,0.1)' : 'rgba(245,158,11,0.1)') }};display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                @if($reservation->status=='confirmed'||$reservation->status=='completed')
                    <i data-lucide="check-circle" style="width:32px;height:32px;color:#059669;"></i>
                @elseif($reservation->status=='cancelled')
                    <i data-lucide="x-circle" style="width:32px;height:32px;color:#dc2626;"></i>
                @else
                    <i data-lucide="clock" style="width:32px;height:32px;color:#d97706;"></i>
                @endif
            </div>
            <p style="font-size:0.75rem;color:#94a3b8;font-weight:700;text-transform:uppercase;letter-spacing:1px;margin:0 0 6px;">Status Reservasi</p>
            <p style="font-size:1.1rem;font-weight:800;color:#0f172a;margin:0;">{{ $reservation->status_label }}</p>
        </div>

        {{-- Room Summary --}}
        <div class="admin-card">
            <h3 style="font-size:0.9rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin:0 0 16px;">Info Kamar</h3>
            @if($reservation->room->image)
                <img src="{{ asset('storage/' . $reservation->room->image) }}" alt="{{ $reservation->room->name }}" style="width:100%;border-radius:10px;margin-bottom:14px;object-fit:cover;height:150px;">
            @endif
            <p style="font-size:1.05rem;font-weight:800;color:#0f172a;margin:0 0 4px;">{{ $reservation->room->name }}</p>
            <p style="font-size:0.85rem;color:#64748b;margin:0 0 10px;">Tipe: {{ ucfirst($reservation->room->type) }}</p>
            <p style="font-size:1rem;font-weight:700;color:#f5a623;margin:0;">Rp {{ number_format($reservation->room->price, 0, ',', '.') }} / malam</p>
        </div>

        {{-- Auto-confirm info --}}
        @if($reservation->paid_at && $reservation->status === 'confirmed')
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:16px;">
            <div style="display:flex;gap:10px;align-items:flex-start;">
                <i data-lucide="shield-check" style="width:20px;height:20px;color:#059669;flex-shrink:0;margin-top:2px;"></i>
                <div>
                    <p style="font-weight:700;color:#15803d;margin:0 0 4px;font-size:0.9rem;">Otomatis Dikonfirmasi</p>
                    <p style="color:#166534;font-size:0.82rem;margin:0;">Reservasi ini dikonfirmasi otomatis setelah pembayaran berhasil diverifikasi oleh sistem.</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Quick Actions --}}
        <div class="admin-card no-print">
            <h3 style="font-size:0.9rem;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:1px;margin:0 0 14px;">Aksi Cepat</h3>
            <div style="display:flex;flex-direction:column;gap:8px;">
                @if($reservation->status === 'pending')
                <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="confirmed">
                    <button type="submit" class="btn-admin-primary" style="width:100%;justify-content:center;">
                        <i data-lucide="check" style="width:15px;height:15px;"></i> Konfirmasi Reservasi
                    </button>
                </form>
                @endif
                @if($reservation->status === 'confirmed')
                <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="btn-admin-outline" style="width:100%;justify-content:center;">
                        <i data-lucide="check-square" style="width:15px;height:15px;"></i> Tandai Selesai
                    </button>
                </form>
                @endif
                @if(in_array($reservation->status, ['pending']))
                <form action="{{ route('admin.reservations.status', $reservation) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="btn-admin-danger" style="width:100%;justify-content:center;" onclick="return confirm('Yakin batalkan reservasi ini?')">
                        <i data-lucide="x" style="width:15px;height:15px;"></i> Batalkan Reservasi
                    </button>
                </form>
                @endif
                <button onclick="window.print()" class="btn-admin-outline" style="width:100%;justify-content:center;">
                    <i data-lucide="printer" style="width:15px;height:15px;"></i> Cetak / PDF
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .print-header { display:block !important; }
    .no-print { display:none !important; }
}
</style>
@endsection

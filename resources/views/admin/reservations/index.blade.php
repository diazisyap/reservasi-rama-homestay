@extends('layouts.admin')

@section('title', 'Kelola Reservasi - Admin')
@section('page_title', 'Kelola Reservasi')

@section('content')
<div class="admin-card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;flex-wrap:wrap;gap:12px;">
        <div>
            <h2 style="font-size:1.4rem;font-weight:800;color:#0f172a;margin:0;">Daftar Reservasi Tamu</h2>
            <p style="color:#64748b;font-size:0.88rem;margin:4px 0 0;">Total {{ $reservations->count() }} reservasi</p>
        </div>
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
            {{-- Filter by status --}}
            <form method="GET" style="display:flex;gap:8px;align-items:center;">
                <select name="status" class="form-select-admin" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Menunggu</option>
                    <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Terkonfirmasi</option>
                    <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Selesai</option>
                    <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Dibatalkan</option>
                </select>
            </form>
        </div>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Nama Tamu</th>
                    <th>Kamar</th>
                    <th>Check In / Out</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $r)
                <tr>
                    <td>
                        <a href="{{ route('admin.reservations.show', $r) }}" style="color:#f5a623;font-weight:800;text-decoration:none;font-size:0.95rem;">#{{ $r->id }}</a>
                        <span style="display:block;font-size:0.72rem;color:#94a3b8;font-weight:600;">{{ $r->booking_code }}</span>
                        @if($r->midtrans_payment_type)
                            <span style="display:inline-block;margin-top:4px;font-size:0.68rem;background:#dcfce7;color:#15803d;padding:2px 6px;border-radius:4px;font-weight:700;text-transform:uppercase;">
                                {{ $r->midtrans_payment_type }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <strong style="color:#0f172a;display:block;font-size:0.93rem;">{{ $r->user->name }}</strong>
                        <span style="font-size:0.8rem;color:#64748b;">{{ $r->user->email }}</span>
                        <span style="font-size:0.78rem;color:#94a3b8;">{{ $r->guest_phone }}</span>
                    </td>
                    <td style="font-weight:700;color:#0f172a;">{{ $r->room->name }}</td>
                    <td style="color:#475569;font-size:0.88rem;">
                        {{ \Carbon\Carbon::parse($r->check_in)->format('d/m/Y') }}<br>
                        <span style="color:#94a3b8;font-size:0.8rem;">{{ \Carbon\Carbon::parse($r->check_out)->format('d/m/Y') }}</span>
                        <span style="display:block;font-size:0.78rem;color:#64748b;margin-top:2px;">{{ $r->nights }} malam</span>
                    </td>
                    <td style="font-weight:700;color:#0f172a;white-space:nowrap;">
                        Rp {{ number_format($r->total_price, 0, ',', '.') }}
                    </td>
                    <td>
                        @if($r->paid_at)
                            <span class="badge badge-paid">&#10003; Lunas</span>
                            <span style="display:block;font-size:0.72rem;color:#059669;margin-top:3px;">{{ \Carbon\Carbon::parse($r->paid_at)->format('d/m/Y H:i') }}</span>
                        @else
                            <span class="badge badge-unpaid">Belum Bayar</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $r->status }}">
                            @if($r->status=='pending')
                                Menunggu
                                @if($r->expires_at)
                                    <span style="display:block;font-size:0.7rem;font-weight:600;margin-top:2px;">
                                        (Hold {{ max(0, (int) ceil(now()->diffInSeconds($r->expires_at, false) / 60)) }} mnt)
                                    </span>
                                @endif
                            @elseif($r->status=='confirmed') Terkonfirmasi
                            @elseif($r->status=='completed') Selesai
                            @else
                                {{ $r->status_label }}
                            @endif
                        </span>
                        {{-- Jika sudah bayar tapi masih pending, admin bisa update manual --}}
                        @if($r->status === 'pending' && !$r->paid_at)
                        <form action="{{ route('admin.reservations.status', $r) }}" method="POST" style="margin-top:8px;">
                            @csrf
                            <div style="display:flex;gap:6px;align-items:center;">
                                <select name="status" class="form-select-admin" style="font-size:0.78rem;padding:5px 8px;">
                                    <option value="pending" selected>Pending</option>
                                    <option value="confirmed">Konfirmasi</option>
                                    <option value="completed">Selesai</option>
                                    <option value="cancelled">Batalkan</option>
                                </select>
                                <button type="submit" class="btn-admin-primary" style="padding:5px 10px;font-size:0.78rem;">OK</button>
                            </div>
                        </form>
                        @elseif($r->status === 'confirmed')
                        <form action="{{ route('admin.reservations.status', $r) }}" method="POST" style="margin-top:8px;">
                            @csrf
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn-admin-outline" style="padding:5px 10px;font-size:0.78rem;">
                                <i data-lucide="check-square" style="width:13px;height:13px;"></i> Selesai
                            </button>
                        </form>
                        @endif
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <a href="{{ route('admin.reservations.show', $r) }}" class="btn-admin-info" style="padding:7px 12px;font-size:0.82rem;">
                            <i data-lucide="eye" style="width:14px;height:14px;"></i> Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

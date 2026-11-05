@extends('layouts.admin')

@section('title', 'Dashboard Admin - Rama Homestay')
@section('page_title', 'Ringkasan Sistem')

@section('content')
<div class="stat-grid">
    <div class="stat-card">
        <div>
            <p class="stat-label">Total Kamar</p>
            <h3 class="stat-value">{{ $roomsCount }}</h3>
        </div>
        <div class="stat-icon-wrap" style="background:rgba(245,166,35,0.1);color:#f5a623;">
            <i data-lucide="door-closed" style="width:26px;height:26px;"></i>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <p class="stat-label">Total Reservasi</p>
            <h3 class="stat-value">{{ $reservationsCount }}</h3>
        </div>
        <div class="stat-icon-wrap" style="background:rgba(14,165,233,0.1);color:#0ea5e9;">
            <i data-lucide="calendar" style="width:26px;height:26px;"></i>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <p class="stat-label">Menunggu Konfirmasi</p>
            <h3 class="stat-value">{{ $pendingCount }}</h3>
        </div>
        <div class="stat-icon-wrap" style="background:rgba(245,158,11,0.1);color:#d97706;">
            <i data-lucide="clock" style="width:26px;height:26px;"></i>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <p class="stat-label">Total Pendapatan</p>
            <h3 class="stat-value" style="font-size:1.35rem;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>
        <div class="stat-icon-wrap" style="background:rgba(16,185,129,0.1);color:#059669;">
            <i data-lucide="trending-up" style="width:26px;height:26px;"></i>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <p class="stat-label">Tamu Terdaftar</p>
            <h3 class="stat-value">{{ $usersCount }}</h3>
        </div>
        <div class="stat-icon-wrap" style="background:rgba(139,92,246,0.1);color:#7c3aed;">
            <i data-lucide="users" style="width:26px;height:26px;"></i>
        </div>
    </div>
</div>

{{-- Latest Reservations --}}
<div class="admin-card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:22px;">
        <h3 style="font-size:1.2rem;font-weight:800;color:#0f172a;margin:0;">Pemesanan Terbaru</h3>
        <a href="{{ route('admin.reservations.index') }}" class="btn-admin-outline">
            <i data-lucide="list" style="width:16px;height:16px;"></i> Lihat Semua
        </a>
    </div>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Tamu</th>
                    <th>Kamar</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentReservations as $r)
                <tr>
                    <td>
                        <strong style="color:#0f172a;display:block;">{{ $r->user->name }}</strong>
                        <span style="font-size:0.8rem;color:#64748b;">{{ $r->user->email }}</span>
                    </td>
                    <td style="font-weight:600;color:#0f172a;">{{ $r->room->name }}</td>
                    <td style="color:#475569;font-size:0.88rem;">
                        {{ \Carbon\Carbon::parse($r->check_in)->format('d M Y') }}<br>
                        <span style="color:#94a3b8;font-size:0.8rem;">s/d {{ \Carbon\Carbon::parse($r->check_out)->format('d M Y') }}</span>
                    </td>
                    <td>
                        <span class="badge badge-{{ $r->status }}">
                            @if($r->status=='pending') Menunggu
                            @elseif($r->status=='confirmed') Terkonfirmasi
                            @elseif($r->status=='completed') Selesai
                            @else Dibatalkan @endif
                        </span>
                    </td>
                    <td>
                        @if($r->paid_at)
                            <span class="badge badge-paid">Lunas</span>
                        @else
                            <span class="badge badge-unpaid">Belum Bayar</span>
                        @endif
                    </td>
                    <td style="text-align:right;">
                        <a href="{{ route('admin.reservations.show', $r) }}" class="btn-admin-info" style="padding:6px 12px;font-size:0.8rem;">
                            <i data-lucide="eye" style="width:14px;height:14px;"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:40px;color:#94a3b8;">Belum ada reservasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

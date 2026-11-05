@extends('layouts.admin')

@section('title', 'Laporan - Admin Rama Homestay')
@section('page_title', 'Laporan & Statistik')

@push('styles')
<style>
.report-filter-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    padding: 20px 24px;
    margin-bottom: 24px;
    display: flex;
    gap: 12px;
    align-items: flex-end;
    flex-wrap: wrap;
}
.report-filter-card label { font-size:0.8rem; font-weight:700; color:#64748b; display:block; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px; }
.report-filter-card input[type=date], .report-filter-card select {
    padding: 9px 12px;
    border-radius: 9px;
    border: 1px solid #cbd5e1;
    font-size: 0.9rem;
    font-family: inherit;
    color: #334155;
    outline: none;
    background: #fff;
}
.summary-row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 16px;
    margin-bottom: 28px;
}
.summary-item {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    padding: 20px;
    transition: all 0.2s;
}
.summary-item:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.06); }
.summary-item .s-label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #64748b; margin: 0 0 6px; }
.summary-item .s-val { font-size: 1.6rem; font-weight: 800; color: #0f172a; margin: 0; }
.summary-item .s-sub { font-size: 0.78rem; color: #94a3b8; margin: 4px 0 0; }

@media print {
    .no-print { display: none !important; }
    .report-filter-card { display: none !important; }
    body { background: #fff; }
    .admin-card { box-shadow: none !important; border: 1px solid #ddd !important; }
}
</style>
@endpush

@section('content')

{{-- Filter --}}
<div class="report-filter-card no-print">
    <form method="GET" action="{{ route('admin.reports') }}" style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;width:100%;">
        <div>
            <label>Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date', $startDate) }}">
        </div>
        <div>
            <label>Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date', $endDate) }}">
        </div>
        <div>
            <label>Status</label>
            <select name="status">
                <option value="">Semua Status</option>
                <option value="pending"   {{ request('status')=='pending'?'selected':'' }}>Menunggu</option>
                <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Terkonfirmasi</option>
                <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Selesai</option>
                <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Dibatalkan</option>
            </select>
        </div>
        <div style="display:flex;gap:8px;align-items:flex-end;">
            <button type="submit" class="btn-admin-primary">
                <i data-lucide="filter" style="width:15px;height:15px;"></i> Filter
            </button>
            <a href="{{ route('admin.reports') }}" class="btn-admin-outline">Reset</a>
        </div>
        <div style="margin-left:auto;display:flex;gap:8px;align-items:flex-end;">
            <button type="button" onclick="window.print()" class="btn-admin-outline">
                <i data-lucide="printer" style="width:15px;height:15px;"></i> Cetak / PDF
            </button>
            <a href="{{ route('admin.reports.export') }}?start_date={{ request('start_date', $startDate) }}&end_date={{ request('end_date', $endDate) }}&status={{ request('status') }}" class="btn-admin-primary">
                <i data-lucide="download" style="width:15px;height:15px;"></i> Export PDF
            </a>
        </div>
    </form>
</div>

{{-- Print Header --}}
<div style="display:none" id="print-header">
    <div style="text-align:center;padding:20px 0;border-bottom:2px solid #eee;margin-bottom:20px;">
        <h2 style="font-size:2rem;font-family:'Times New Roman',serif;margin:0;">R</h2>
        <div style="font-size:0.75rem;letter-spacing:3px;text-transform:uppercase;color:#888;">Rama Homestay</div>
        <h1 style="font-size:1.3rem;font-weight:700;margin:8px 0 4px;">LAPORAN RESERVASI</h1>
        <p style="color:#666;font-size:0.88rem;">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} — {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</p>
        <p style="color:#999;font-size:0.8rem;">Dicetak: {{ now()->format('d F Y, H:i') }} WIB</p>
    </div>
</div>

{{-- Summary Cards --}}
<div class="summary-row">
    <div class="summary-item">
        <p class="s-label">Total Reservasi</p>
        <h3 class="s-val">{{ $summary['total'] }}</h3>
        <p class="s-sub">Periode terpilih</p>
    </div>
    <div class="summary-item">
        <p class="s-label">Terkonfirmasi</p>
        <h3 class="s-val" style="color:#2563eb;">{{ $summary['confirmed'] }}</h3>
        <p class="s-sub">Status confirmed</p>
    </div>
    <div class="summary-item">
        <p class="s-label">Selesai</p>
        <h3 class="s-val" style="color:#059669;">{{ $summary['completed'] }}</h3>
        <p class="s-sub">Check-out selesai</p>
    </div>
    <div class="summary-item">
        <p class="s-label">Menunggu</p>
        <h3 class="s-val" style="color:#d97706;">{{ $summary['pending'] }}</h3>
        <p class="s-sub">Belum diproses</p>
    </div>
    <div class="summary-item">
        <p class="s-label">Dibatalkan</p>
        <h3 class="s-val" style="color:#dc2626;">{{ $summary['cancelled'] }}</h3>
        <p class="s-sub">Reservasi batal</p>
    </div>
    <div class="summary-item">
        <p class="s-label">Sudah Dibayar</p>
        <h3 class="s-val" style="color:#059669;">{{ $summary['paid'] }}</h3>
        <p class="s-sub">Lunas/terkonfirmasi</p>
    </div>
    <div class="summary-item" style="border-color:#f5a623;background:rgba(245,166,35,0.04);">
        <p class="s-label">Total Pendapatan</p>
        <h3 class="s-val" style="font-size:1.1rem;color:#f5a623;">Rp {{ number_format($summary['revenue'], 0, ',', '.') }}</h3>
        <p class="s-sub">Confirmed + Selesai</p>
    </div>
</div>

{{-- Data Table --}}
<div class="admin-card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <div>
            <h3 style="font-size:1.1rem;font-weight:800;color:#0f172a;margin:0;">Rincian Reservasi</h3>
            <p style="color:#64748b;font-size:0.85rem;margin:4px 0 0;">{{ $reservations->count() }} data ditemukan</p>
        </div>
    </div>

    <div class="admin-table-wrap">
        <table class="admin-table" id="report-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Booking ID</th>
                    <th>Tamu</th>
                    <th>Kamar</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Malam</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $i => $r)
                <tr>
                    <td style="color:#94a3b8;font-size:0.82rem;">{{ $i + 1 }}</td>
                    <td>
                        <a href="{{ route('admin.reservations.show', $r) }}" style="color:#f5a623;font-weight:700;text-decoration:none;font-family:monospace;font-size:0.85rem;" class="no-print">
                            {{ $r->booking_code }}
                        </a>
                        <span class="print-only" style="font-family:monospace;font-size:0.82rem;">{{ $r->booking_code }}</span>
                    </td>
                    <td>
                        <strong style="color:#0f172a;display:block;font-size:0.88rem;">{{ $r->guest_name }}</strong>
                        <span style="font-size:0.78rem;color:#64748b;">{{ $r->guest_email }}</span>
                    </td>
                    <td style="font-weight:700;color:#0f172a;font-size:0.9rem;">{{ $r->room->name }}</td>
                    <td style="font-size:0.85rem;color:#475569;white-space:nowrap;">{{ \Carbon\Carbon::parse($r->check_in)->format('d/m/Y') }}</td>
                    <td style="font-size:0.85rem;color:#475569;white-space:nowrap;">{{ \Carbon\Carbon::parse($r->check_out)->format('d/m/Y') }}</td>
                    <td style="text-align:center;font-weight:600;color:#0f172a;">{{ $r->nights }}</td>
                    <td style="font-weight:700;color:#0f172a;white-space:nowrap;font-size:0.88rem;">Rp {{ number_format($r->total_price, 0, ',', '.') }}</td>
                    <td>
                        @if($r->paid_at)
                            <span class="badge badge-paid" style="font-size:0.68rem;">Lunas</span>
                        @else
                            <span class="badge badge-unpaid" style="font-size:0.68rem;">Belum</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $r->status }}" style="font-size:0.68rem;">
                            {{ $r->status_label }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" style="text-align:center;padding:40px;color:#94a3b8;">Tidak ada data untuk periode yang dipilih.</td>
                </tr>
                @endforelse
            </tbody>
            @if($reservations->count() > 0)
            <tfoot>
                <tr style="border-top:2px solid #e2e8f0;background:#f8fafc;">
                    <td colspan="7" style="padding:14px 12px;font-weight:800;color:#0f172a;font-size:0.9rem;">TOTAL</td>
                    <td style="padding:14px 12px;font-weight:800;color:#f5a623;font-size:0.95rem;white-space:nowrap;">Rp {{ number_format($summary['revenue'], 0, ',', '.') }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

<script>
window.addEventListener('beforeprint', function() {
    document.getElementById('print-header').style.display = 'block';
});
window.addEventListener('afterprint', function() {
    document.getElementById('print-header').style.display = 'none';
});
</script>
@endsection

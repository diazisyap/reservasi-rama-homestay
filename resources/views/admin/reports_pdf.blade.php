<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Reservasi - Rama Homestay</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #1e293b; margin: 20px; }
        .header { text-align: center; border-bottom: 2px solid #f5a623; padding-bottom: 16px; margin-bottom: 20px; }
        .header h1 { font-size: 22px; font-family: serif; margin: 0; }
        .header .sub { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: #888; }
        .header .title { font-size: 15px; font-weight: 700; margin: 8px 0 4px; }
        .header .period { color: #555; font-size: 11px; }

        .summary-grid { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .summary-item { border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; min-width: 120px; flex: 1; }
        .summary-item .sl { font-size: 9px; text-transform: uppercase; letter-spacing: 1px; color: #666; margin: 0 0 4px; font-weight: 700; }
        .summary-item .sv { font-size: 18px; font-weight: 800; color: #0f172a; margin: 0; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #0f172a; color: #fff; padding: 9px 10px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; }
        td { padding: 9px 10px; border-bottom: 1px solid #f1f5f9; font-size: 11px; vertical-align: middle; }
        tr:nth-child(even) td { background: #f8fafc; }
        tfoot td { background: #f1f5f9 !important; font-weight: 800; border-top: 2px solid #e2e8f0; }

        .badge-confirmed { background: rgba(59,130,246,0.1); color: #1d4ed8; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: 700; }
        .badge-completed { background: rgba(16,185,129,0.1); color: #065f46; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: 700; }
        .badge-pending   { background: rgba(245,158,11,0.1); color: #92400e; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: 700; }
        .badge-cancelled { background: rgba(239,68,68,0.1); color: #991b1b; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: 700; }
        .badge-paid   { background: rgba(16,185,129,0.1); color: #065f46; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: 700; }
        .badge-unpaid { background: rgba(245,158,11,0.1); color: #92400e; padding: 2px 7px; border-radius: 10px; font-size: 9px; font-weight: 700; }

        .footer { margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 12px; font-size: 10px; color: #888; display: flex; justify-content: space-between; }
    </style>
</head>
<body>
    <div class="header">
        <h1>R</h1>
        <div class="sub">Rama Homestay</div>
        <div class="title">LAPORAN RESERVASI</div>
        <div class="period">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} &mdash; {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</div>
        <div class="period" style="margin-top:4px;color:#999;">Dicetak: {{ now()->format('d F Y, H:i') }} WIB</div>
    </div>

    <div class="summary-grid">
        <div class="summary-item"><p class="sl">Total</p><p class="sv">{{ $summary['total'] }}</p></div>
        <div class="summary-item"><p class="sl">Terkonfirmasi</p><p class="sv" style="color:#1d4ed8;">{{ $summary['confirmed'] }}</p></div>
        <div class="summary-item"><p class="sl">Selesai</p><p class="sv" style="color:#065f46;">{{ $summary['completed'] }}</p></div>
        <div class="summary-item"><p class="sl">Menunggu</p><p class="sv" style="color:#92400e;">{{ $summary['pending'] }}</p></div>
        <div class="summary-item"><p class="sl">Dibatalkan</p><p class="sv" style="color:#991b1b;">{{ $summary['cancelled'] }}</p></div>
        <div class="summary-item"><p class="sl">Sudah Bayar</p><p class="sv" style="color:#065f46;">{{ $summary['paid'] }}</p></div>
        <div class="summary-item" style="border-color:#f5a623;">
            <p class="sl">Total Pendapatan</p>
            <p class="sv" style="color:#b45309;font-size:12px;">Rp {{ number_format($summary['revenue'], 0, ',', '.') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Booking ID</th>
                <th>Tamu</th>
                <th>Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Malam</th>
                <th>Total Harga</th>
                <th>Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td style="font-family:monospace;font-size:10px;">{{ $r->booking_code }}</td>
                <td>
                    <strong>{{ $r->guest_name }}</strong><br>
                    <span style="color:#64748b;font-size:10px;">{{ $r->guest_email }}</span>
                </td>
                <td><strong>{{ $r->room->name }}</strong></td>
                <td style="white-space:nowrap;">{{ \Carbon\Carbon::parse($r->check_in)->format('d/m/Y') }}</td>
                <td style="white-space:nowrap;">{{ \Carbon\Carbon::parse($r->check_out)->format('d/m/Y') }}</td>
                <td style="text-align:center;">{{ $r->nights }}</td>
                <td style="white-space:nowrap;font-weight:700;">Rp {{ number_format($r->total_price, 0, ',', '.') }}</td>
                <td>
                    @if($r->paid_at)
                        <span class="badge-paid">Lunas</span>
                    @else
                        <span class="badge-unpaid">Belum</span>
                    @endif
                </td>
                <td>
                    <span class="badge-{{ $r->status }}">{{ $r->status_label }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="text-align:center;color:#94a3b8;padding:20px;">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
        @if($reservations->count() > 0)
        <tfoot>
            <tr>
                <td colspan="7"><strong>TOTAL PENDAPATAN (Confirmed + Selesai)</strong></td>
                <td style="color:#b45309;"><strong>Rp {{ number_format($summary['revenue'], 0, ',', '.') }}</strong></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <span>Rama Homestay &mdash; Jl. Telaga Warna, Dieng Wetan, Kec. Kejajar, Wonosobo, Jawa Tengah 56354</span>
        <span>info@ramahomestay.com &mdash; +62 812-2571-1350</span>
    </div>

    <script>window.onload = function() { window.print(); }</script>
</body>
</html>

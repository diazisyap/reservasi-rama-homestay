@extends('layouts.app')

@section('title', 'Detail Reservasi #' . $reservation->booking_code)

@section('content')
<div style="padding: 40px 0 80px; background: #f8fafc; min-height: 80vh;">
    <div class="container" style="max-width: 1060px; margin: 0 auto; padding: 0 20px;">
        
        {{-- Navigation Header --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
            <a href="{{ route('tamu.dashboard') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #475569; text-decoration: none; font-weight: 600; font-size: 0.92rem; background: #ffffff; padding: 10px 18px; border-radius: 12px; border: 1px solid #e2e8f0; transition: all 0.2s ease;">
                <i data-lucide="arrow-left" style="width: 18px; height: 18px;"></i>
                <span>Kembali ke Reservasi Saya</span>
            </a>

            <div style="display: flex; gap: 10px;">
                <button onclick="window.print()" style="display: inline-flex; align-items: center; gap: 6px; background: #ffffff; color: #0f172a; padding: 10px 16px; border-radius: 12px; border: 1px solid #e2e8f0; font-weight: 600; font-size: 0.88rem; cursor: pointer;">
                    <i data-lucide="printer" style="width: 16px; height: 16px;"></i>
                    <span>Cetak Bukti</span>
                </button>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div style="background: #ecfdf5; border: 1.5px solid #a7f3d0; border-radius: 14px; padding: 16px 20px; margin-bottom: 24px; color: #065f46; display: flex; align-items: flex-start; gap: 12px;">
                <i data-lucide="check-circle" style="width: 22px; height: 22px; color: #059669; flex-shrink: 0; margin-top: 2px;"></i>
                <div style="font-size: 0.95rem; line-height: 1.5;">
                    <div style="font-weight: 800; margin-bottom: 2px;">Berhasil!</div>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div style="background: #fef2f2; border: 1.5px solid #fecaca; border-radius: 14px; padding: 16px 20px; margin-bottom: 24px; color: #991b1b; display: flex; align-items: flex-start; gap: 12px;">
                <i data-lucide="alert-circle" style="width: 22px; height: 22px; color: #dc2626; flex-shrink: 0; margin-top: 2px;"></i>
                <div style="font-size: 0.95rem; line-height: 1.5;">
                    <div style="font-weight: 800; margin-bottom: 2px;">Perhatian</div>
                    <div>{{ session('error') }}</div>
                </div>
            </div>
        @endif

        {{-- NOTIFIKASI JIKA STATUS DIBATALKAN & INFO DANA KEMBALI --}}
        @if($reservation->status === 'cancelled')
            <div style="background: #fff1f2; border: 1.5px solid #fecdd3; border-radius: 16px; padding: 22px 24px; margin-bottom: 25px;">
                <div style="display: flex; align-items: center; gap: 10px; color: #be123c; margin-bottom: 8px;">
                    <i data-lucide="x-circle" style="width: 24px; height: 24px; color: #e11d48;"></i>
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 800;">Reservasi Ini Telah Dibatalkan</h3>
                </div>
                <p style="color: #4c0519; font-size: 0.92rem; margin: 0 0 12px; line-height: 1.6;">
                    Waktu Pembatalan: <strong>{{ $reservation->cancelled_at ? $reservation->cancelled_at->translatedFormat('d F Y, H:i') . ' WIB' : 'Telah Dibatalkan' }}</strong>
                </p>
                <div style="background: #ffffff; border-radius: 12px; padding: 14px 18px; border: 1px solid #ffe4e6; display: flex; align-items: center; gap: 10px;">
                    <i data-lucide="wallet" style="width: 20px; height: 20px; color: #059669; flex-shrink: 0;"></i>
                    <div style="font-size: 0.9rem; color: #0f172a;">
                        <span style="font-weight: 700; color: #059669;">Catatan Pengembalian Dana:</span>
                        <span>{{ $reservation->refund_note ?? 'Dana Anda telah otomatis dikembalikan 100% ke rekening / metode pembayaran Anda.' }}</span>
                    </div>
                </div>
            </div>
        @endif

        {{-- GRID DETAIL --}}
        <div style="display: grid; grid-template-columns: 1fr 340px; gap: 24px; align-items: start;">
            
            {{-- LEFT COLUMN: Main Info --}}
            <div style="display: flex; flex-direction: column; gap: 24px;">

                {{-- Status & Kode Card --}}
                <div style="background: #ffffff; border-radius: 20px; padding: 26px 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px;">
                        <div>
                            <span style="font-size: 0.75rem; letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8; font-weight: 700;">Kode Booking Resmi</span>
                            <h2 style="font-size: 1.8rem; font-weight: 900; color: var(--primary); margin: 4px 0 8px; letter-spacing: 1px;">
                                {{ $reservation->booking_code }}
                            </h2>
                            <p style="color: #64748b; font-size: 0.85rem; margin: 0;">
                                Dipesan pada {{ $reservation->created_at->translatedFormat('d F Y, H:i') }} WIB
                            </p>
                        </div>

                        <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px;">
                            <span class="badge badge-{{ $reservation->status }}" style="font-size: 0.85rem; padding: 6px 14px; border-radius: 20px; font-weight: 700;">
                                {{ $reservation->status_label }}
                            </span>
                            @if($reservation->paid_at)
                                <span style="background: #dcfce7; color: #15803d; font-size: 0.78rem; font-weight: 800; padding: 4px 10px; border-radius: 8px; border: 1px solid #bbf7d0;">
                                    &#10003; LUNAS
                                </span>
                            @elseif($reservation->status === 'cancelled')
                                <span style="background: #fee2e2; color: #991b1b; font-size: 0.78rem; font-weight: 800; padding: 4px 10px; border-radius: 8px; border: 1px solid #fecaca;">
                                    Dibatalkan
                                </span>
                            @else
                                <span style="background: #fef3c7; color: #92400e; font-size: 0.78rem; font-weight: 800; padding: 4px 10px; border-radius: 8px; border: 1px solid #fde68a;">
                                    Menunggu Pembayaran
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Detail Kamar & Jadwal Menginap --}}
                <div style="background: #ffffff; border-radius: 20px; padding: 26px 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 18px 0; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="bed-double" style="width: 20px; height: 20px; color: var(--primary);"></i>
                        <span>Informasi Kamar &amp; Jadwal</span>
                    </h3>

                    <div style="display: flex; gap: 20px; align-items: center; margin-bottom: 22px; flex-wrap: wrap;">
                        <img src="{{ $reservation->room->image ? asset('storage/' . $reservation->room->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&q=80' }}" alt="{{ $reservation->room->name }}" style="width: 140px; height: 95px; border-radius: 12px; object-fit: cover; flex-shrink: 0; border: 1px solid #e2e8f0;">
                        <div>
                            <h4 style="font-size: 1.3rem; font-weight: 800; color: #0f172a; margin: 0 0 4px;">{{ $reservation->room->name }}</h4>
                            <p style="color: #64748b; font-size: 0.88rem; margin: 0 0 8px;">Tipe: {{ ucfirst($reservation->room->type) }} · Max {{ $reservation->room->capacity }} Tamu</p>
                            <span style="font-size: 0.8rem; background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 8px; font-weight: 600;">
                                Fasilitas: WiFi, Water Heater, Smart TV, Parkir
                            </span>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; background: #f8fafc; border-radius: 14px; padding: 18px 20px; border: 1px solid #e2e8f0;">
                        <div>
                            <div style="font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 4px;">Check-In</div>
                            <div style="font-size: 1rem; font-weight: 800; color: #0f172a;">
                                {{ $reservation->check_in->translatedFormat('d M Y') }}
                            </div>
                            <div style="font-size: 0.78rem; color: #94a3b8;">Mulai 14:00 WIB</div>
                        </div>
                        <div>
                            <div style="font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 4px;">Check-Out</div>
                            <div style="font-size: 1rem; font-weight: 800; color: #0f172a;">
                                {{ $reservation->check_out->translatedFormat('d M Y') }}
                            </div>
                            <div style="font-size: 0.78rem; color: #94a3b8;">Hingga 12:00 WIB</div>
                        </div>
                        <div>
                            <div style="font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 4px;">Durasi</div>
                            <div style="font-size: 1rem; font-weight: 800; color: var(--primary);">
                                {{ $reservation->nights }} Malam
                            </div>
                            <div style="font-size: 0.78rem; color: #94a3b8;">{{ $reservation->guest_count ?? 1 }} Tamu</div>
                        </div>
                    </div>
                </div>

                {{-- Data Pemesan --}}
                <div style="background: #ffffff; border-radius: 20px; padding: 26px 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="user-check" style="width: 20px; height: 20px; color: var(--primary);"></i>
                        <span>Data Pemesan</span>
                    </h3>

                    <table style="width: 100%; font-size: 0.92rem; line-height: 2;">
                        <tr>
                            <td style="color: #64748b; font-weight: 600; width: 180px;">Nama Lengkap:</td>
                            <td style="color: #0f172a; font-weight: 700;">{{ $reservation->guest_name }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b; font-weight: 600;">Email:</td>
                            <td style="color: #0f172a; font-weight: 700;">{{ $reservation->guest_email }}</td>
                        </tr>
                        <tr>
                            <td style="color: #64748b; font-weight: 600;">Nomor Telepon:</td>
                            <td style="color: #0f172a; font-weight: 700;">{{ $reservation->guest_phone ?? '-' }}</td>
                        </tr>
                        @if($reservation->special_requests)
                        <tr>
                            <td style="color: #64748b; font-weight: 600;">Catatan / Permintaan:</td>
                            <td style="color: #0f172a;">{{ $reservation->special_requests }}</td>
                        </tr>
                        @endif
                    </table>
                </div>

                {{-- BOX PEMBATALAN 24 JAM (JIKA MASIH BERLAKU) --}}
                @if($reservation->canCancel())
                    <div style="background: #fffbeb; border: 1.5px solid #fde68a; border-radius: 20px; padding: 24px 28px; box-shadow: 0 4px 15px rgba(217, 119, 6, 0.05);">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <i data-lucide="clock" style="width: 22px; height: 22px; color: #d97706;"></i>
                            <h4 style="font-size: 1.1rem; font-weight: 800; color: #92400e; margin: 0;">
                                Kebijakan Pembatalan Bebas (Maksimal 24 Jam)
                            </h4>
                        </div>
                        <p style="color: #78350f; font-size: 0.9rem; line-height: 1.6; margin: 0 0 14px;">
                            Anda masih berada dalam periode pembatalan gratis (maksimal 24 jam setelah reservasi dibuat).
                            <br>
                            Sisa waktu pembatalan: <strong style="color: #b45309;">{{ $reservation->cancel_time_remaining }}</strong> (hingga {{ $reservation->cancellation_deadline->translatedFormat('d M Y, H:i') }} WIB).
                        </p>

                        <div style="background: #ffffff; border-radius: 12px; padding: 14px 16px; border: 1px solid #fef3c7; margin-bottom: 18px; font-size: 0.88rem; color: #166534; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="check-circle-2" style="width: 18px; height: 18px; color: #15803d; flex-shrink: 0;"></i>
                            <span><strong>Jaminan Pengembalian Dana:</strong> Jika dibatalkan sekarang, dana Anda sebesar <strong>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</strong> akan otomatis dikembalikan 100% ke rekening Anda.</span>
                        </div>

                        <form action="{{ route('tamu.reservation.cancel', $reservation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan reservasi ini?\n\nDana sebesar Rp {{ number_format($reservation->total_price, 0, ',', '.') }} akan otomatis dikembalikan ke rekening/metode pembayaran Anda.');">
                            @csrf
                            <button type="submit" style="background: #ef4444; color: white; border: none; padding: 12px 22px; border-radius: 12px; font-weight: 700; font-size: 0.92rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; box-shadow: 0 4px 14px rgba(239, 68, 68, 0.25);">
                                <i data-lucide="x-circle" style="width: 18px; height: 18px;"></i>
                                <span>Batalkan Reservasi &amp; Kembalikan Dana</span>
                            </button>
                        </form>
                    </div>
                @elseif(!in_array($reservation->status, ['cancelled', 'completed']))
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 18px 22px; color: #64748b; font-size: 0.88rem; display: flex; align-items: center; gap: 12px;">
                        <i data-lucide="shield-alert" style="width: 22px; height: 22px; color: #94a3b8; flex-shrink: 0;"></i>
                        <div>
                            <strong>Batas Waktu Pembatalan Telah Berakhir:</strong> Batas waktu pembatalan mandiri 24 jam telah berakhir pada {{ $reservation->cancellation_deadline->translatedFormat('d M Y, H:i') }} WIB. Jika Anda memerlukan bantuan perubahan jadwal darurat, silakan hubungi kontak Rama Homestay.
                        </div>
                    </div>
                @endif

            </div>

            {{-- RIGHT COLUMN: Payment Summary & QR Ticket --}}
            <div style="display: flex; flex-direction: column; gap: 24px;">

                {{-- Price Breakdown Card --}}
                <div style="background: #ffffff; border-radius: 20px; padding: 26px 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 16px 0;">
                        Rincian Biaya
                    </h3>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 0.92rem;">
                        <span style="color: #64748b;">Biaya Kamar ({{ $reservation->nights }} malam):</span>
                        <span style="font-weight: 700; color: #0f172a;">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 0.92rem;">
                        <span style="color: #64748b;">Metode Pembayaran:</span>
                        <span style="font-weight: 700; color: #059669;">{{ ucfirst($reservation->payment_method ?? 'Online') }}</span>
                    </div>

                    <div style="border-top: 2px dashed #e2e8f0; padding-top: 14px; margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 800; color: #0f172a; font-size: 1rem;">Total Biaya:</span>
                            <span style="font-size: 1.4rem; font-weight: 900; color: var(--primary);">
                                Rp {{ number_format($reservation->total_price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Tombol bayar jika pending --}}
                    @if($reservation->status === 'pending')
                        <a href="{{ route('tamu.pay', $reservation->id) }}" style="display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 12px; background: #10b981; color: white; border-radius: 12px; font-weight: 700; text-decoration: none; font-size: 0.95rem; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.25); box-sizing: border-box;">
                            <i data-lucide="credit-card" style="width: 18px; height: 18px;"></i>
                            <span>Bayar Sekarang</span>
                        </a>
                    @endif
                </div>

                {{-- QR Code Card --}}
                <div style="background: #ffffff; border-radius: 20px; padding: 26px 24px; border: 1px solid #e2e8f0; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: inline-block; padding: 12px; background: #ffffff; border: 2px solid #e2e8f0; border-radius: 16px; margin-bottom: 14px;">
                        <img src="{{ $qrUrl }}" alt="QR Code {{ $reservation->booking_code }}" width="150" height="150" style="display: block;">
                    </div>
                    <div style="font-size: 0.72rem; letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8; font-weight: 700;">Tunjukkan Saat Check-In</div>
                    <div style="font-size: 1.1rem; font-weight: 900; color: #0f172a; letter-spacing: 1px; margin-top: 4px;">{{ $reservation->booking_code }}</div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection


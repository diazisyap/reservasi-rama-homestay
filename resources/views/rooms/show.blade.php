@extends('layouts.app')

@section('title', $room->name . ' - Rama Homestay')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_orange.css">

<style>
    .room-detail-page { padding: 45px 0 80px; background: #f8fafc; min-height: 100vh; }
    .detail-grid { display: grid; grid-template-columns: 1fr 380px; gap: 35px; align-items: start; }
    .gallery-main { border-radius: 20px; overflow: hidden; height: 420px; background: #e2e8f0; position: relative; cursor: pointer; }
    .gallery-main img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s ease; }
    .gallery-main:hover img { transform: scale(1.02); }
    .gallery-thumbs { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 10px; }
    .gallery-thumb { height: 90px; border-radius: 12px; overflow: hidden; cursor: pointer; border: 2px solid transparent; transition: all 0.2s ease; }
    .gallery-thumb:hover, .gallery-thumb.active { border-color: var(--primary); }
    .gallery-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .info-card { background: #fff; border-radius: 20px; padding: 35px; border: 1px solid #e2e8f0; margin-bottom: 25px; }
    .facility-badge { display: inline-flex; align-items: center; gap: 7px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 16px; font-size: 0.88rem; font-weight: 600; color: #475569; margin: 5px; }
    .booking-widget { background: #fff; border-radius: 20px; padding: 30px; border: 1px solid #e2e8f0; box-shadow: 0 8px 30px rgba(0,0,0,0.04); position: sticky; top: 110px; }
    .price-display { font-size: 2rem; font-weight: 800; color: var(--primary); }
    .widget-input { width: 100%; padding: 12px 14px; border: 1.5px solid #e2e8f0; border-radius: 12px; font-family: inherit; font-size: 0.92rem; box-sizing: border-box; transition: border-color 0.2s ease; }
    .widget-input:focus { border-color: var(--primary); outline: none; }
    .widget-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #475569; display: block; margin-bottom: 6px; }
    .price-breakdown { background: #f8fafc; border-radius: 12px; padding: 18px; margin: 15px 0; font-size: 0.88rem; }
    .price-row { display: flex; justify-content: space-between; margin-bottom: 8px; color: #64748b; }
    .price-row.total { font-weight: 800; color: #0f172a; font-size: 1rem; border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 5px; }
    .avail-indicator { padding: 12px; border-radius: 10px; font-size: 0.88rem; font-weight: 700; display: flex; align-items: center; gap: 8px; margin-top: 12px; }
    .avail-ok { background: rgba(16,185,129,0.08); color: #059669; }
    .avail-full { background: rgba(239,68,68,0.08); color: #dc2626; }
    .avail-loading { background: rgba(100,116,139,0.08); color: #64748b; }
    .btn-book-now { display: block; width: 100%; padding: 15px; background: var(--primary); color: #fff; border: none; border-radius: 14px; font-size: 1rem; font-weight: 700; font-family: inherit; cursor: pointer; text-align: center; text-decoration: none; transition: all 0.2s ease; margin-top: 12px; }
    .btn-book-now:hover { background: #b45309; transform: translateY(-1px); color: #fff; }
    .btn-book-now:disabled { background: #94a3b8; cursor: not-allowed; transform: none; }
    .star-rating { display: flex; gap: 3px; }
    .star-rating i { width: 18px; height: 18px; fill: var(--primary); stroke: none; color: var(--primary); }
    @media (max-width: 992px) {
        .detail-grid { grid-template-columns: 1fr; }
        .booking-widget { position: static; }
        .gallery-thumbs { grid-template-columns: repeat(3, 1fr); }
    }
</style>

<div class="room-detail-page">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav style="margin-bottom:25px; font-size:0.88rem; color:#64748b;">
            <a href="{{ route('home') }}" style="color:var(--primary); text-decoration:none; font-weight:600;">Beranda</a>
            <span style="margin:0 8px;">›</span>
            <a href="{{ route('rooms.index') }}" style="color:var(--primary); text-decoration:none; font-weight:600;">Katalog Kamar</a>
            <span style="margin:0 8px;">›</span>
            <span style="color:#94a3b8;">{{ $room->name }}</span>
        </nav>

        <div class="detail-grid">

            {{-- Left Column --}}
            <div>
                {{-- Gallery --}}
                <div class="gallery-main" id="mainGallery">
                    @if($room->image)
                        <img src="{{ asset('storage/'.$room->image) }}" alt="{{ $room->name }}" id="mainImg">
                    @else
                        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1000&q=80" alt="{{ $room->name }}" id="mainImg">
                    @endif
                </div>

                {{-- Thumbnail Gallery --}}
                @php
                    $galleryImages = collect();
                    if ($room->image) $galleryImages->push(asset('storage/'.$room->image));
                    foreach ((array)$room->gallery as $g) { $galleryImages->push(asset('storage/'.$g)); }
                    // Fill with placeholder images if needed
                    $stockImages = [
                        'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&q=80',
                        'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=400&q=80',
                        'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&q=80',
                        'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=400&q=80',
                    ];
                    while ($galleryImages->count() < 4) {
                        $galleryImages->push($stockImages[$galleryImages->count() % count($stockImages)]);
                    }
                @endphp
                <div class="gallery-thumbs">
                    @foreach($galleryImages->take(4) as $idx => $img)
                        <div class="gallery-thumb {{ $idx === 0 ? 'active' : '' }}" onclick="switchGallery(this, '{{ $img }}')">
                            <img src="{{ $img }}" alt="Gallery {{ $idx + 1 }}" loading="lazy">
                        </div>
                    @endforeach
                </div>

                {{-- Room Info --}}
                <div class="info-card" style="margin-top:25px;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:15px; margin-bottom:20px;">
                        <div>
                            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                                <span style="background:rgba(217,119,6,0.1); color:#92400e; font-size:0.72rem; font-weight:800; letter-spacing:1px; text-transform:uppercase; padding:4px 10px; border-radius:20px;">{{ $room->type_label }}</span>
                                <div class="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i data-lucide="star"></i>
                                    @endfor
                                </div>
                                <span style="font-size:0.85rem; color:#64748b; font-weight:600;">(5.0)</span>
                            </div>
                            <h1 style="font-size:2rem; font-weight:800; color:#0f172a; margin:0; font-family:'Playfair Display', Georgia, serif;">{{ $room->name }}</h1>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-size:0.8rem; color:#94a3b8; font-weight:600;">Mulai dari</div>
                            <div class="price-display">Rp {{ number_format($room->price, 0, ',', '.') }}</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">/ malam</div>
                        </div>
                    </div>

                    <div style="display:flex; gap:25px; flex-wrap:wrap; margin-bottom:20px; padding:20px; background:#f8fafc; border-radius:14px;">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <i data-lucide="users" style="width:18px;height:18px;color:var(--primary);"></i>
                            <span style="font-weight:700; color:#0f172a;">Max {{ $room->capacity }} Tamu</span>
                        </div>
                    </div>

                    <h3 style="font-size:1.1rem; font-weight:700; color:#0f172a; margin:0 0 12px;">Deskripsi Kamar</h3>
                    <p style="color:#475569; line-height:1.8; margin:0 0 25px;">{{ $room->description }}</p>

                    <h3 style="font-size:1.1rem; font-weight:700; color:#0f172a; margin:0 0 15px;">Fasilitas Kamar</h3>
                    <div>
                        @forelse($room->facilities_list as $key => $fac)
                            <span class="facility-badge">
                                <i data-lucide="{{ $fac['icon'] }}" style="width:16px;height:16px;color:var(--primary);"></i>
                                {{ $fac['label'] }}
                            </span>
                        @empty
                            <span style="color:#94a3b8;">Informasi fasilitas belum tersedia.</span>
                        @endforelse
                    </div>
                </div>

                {{-- Policies --}}
                <div class="info-card">
                    <h3 style="font-size:1.1rem; font-weight:700; color:#0f172a; margin:0 0 18px;">Kebijakan Menginap</h3>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                        <div style="display:flex; gap:12px;">
                            <i data-lucide="log-in" style="width:20px;height:20px;color:var(--primary);flex-shrink:0;margin-top:2px;"></i>
                            <div><div style="font-weight:700; color:#0f172a; font-size:0.9rem;">Check-in</div><div style="color:#64748b; font-size:0.85rem;">Mulai pukul 14:00 WIB</div></div>
                        </div>
                        <div style="display:flex; gap:12px;">
                            <i data-lucide="log-out" style="width:20px;height:20px;color:var(--primary);flex-shrink:0;margin-top:2px;"></i>
                            <div><div style="font-weight:700; color:#0f172a; font-size:0.9rem;">Check-out</div><div style="color:#64748b; font-size:0.85rem;">Hingga pukul 12:00 WIB</div></div>
                        </div>
                        <div style="display:flex; gap:12px;">
                            <i data-lucide="baby" style="width:20px;height:20px;color:var(--primary);flex-shrink:0;margin-top:2px;"></i>
                            <div><div style="font-weight:700; color:#0f172a; font-size:0.9rem;">Anak-anak</div><div style="color:#64748b; font-size:0.85rem;">Anak di bawah 5 tahun gratis</div></div>
                        </div>
                        <div style="display:flex; gap:12px;">
                            <i data-lucide="cigarette-off" style="width:20px;height:20px;color:var(--primary);flex-shrink:0;margin-top:2px;"></i>
                            <div><div style="font-weight:700; color:#0f172a; font-size:0.9rem;">Merokok</div><div style="color:#64748b; font-size:0.85rem;">Dilarang di dalam kamar</div></div>
                        </div>
                    </div>
                </div>

                {{-- Similar Rooms --}}
                @if($similarRooms->count() > 0)
                <div class="info-card">
                    <h3 style="font-size:1.1rem; font-weight:700; color:#0f172a; margin:0 0 18px;">Kamar Serupa</h3>
                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:15px;">
                        @foreach($similarRooms as $sr)
                        <a href="{{ route('rooms.show', $sr->id) }}" style="text-decoration:none;">
                            <div style="border:1px solid #e2e8f0; border-radius:14px; overflow:hidden; transition:all 0.2s ease;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.06)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                                <div style="height:120px; background:#e2e8f0; overflow:hidden;">
                                    <img src="{{ $sr->image ? asset('storage/'.$sr->image) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=400&q=80' }}" alt="{{ $sr->name }}" style="width:100%;height:100%;object-fit:cover;">
                                </div>
                                <div style="padding:12px;">
                                    <div style="font-weight:700; color:#0f172a; font-size:0.9rem; margin-bottom:3px;">{{ $sr->name }}</div>
                                    <div style="color:var(--primary); font-weight:700; font-size:0.85rem;">Rp {{ number_format($sr->price, 0, ',', '.') }}/mlm</div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Right Column: Booking Widget --}}
            <aside class="booking-widget">
                <div style="margin-bottom:20px;">
                    <div style="font-size:0.8rem; color:#94a3b8; font-weight:600;">Harga per malam</div>
                    <div class="price-display">Rp {{ number_format($room->price, 0, ',', '.') }}</div>
                </div>

                @auth
                    @if(auth()->user()->role === 'tamu')
                    
                    {{-- Note Info Booking Kalender --}}
                    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:10px 14px; margin-bottom:16px; display:flex; align-items:center; gap:8px; font-size:0.82rem; color:#64748b;">
                        <i data-lucide="info" style="width:16px;height:16px;color:var(--primary);flex-shrink:0;"></i>
                        <span><strong>Catatan:</strong> Tanggal yang tidak bisa dipilih berarti sudah ada yang booking.</span>
                    </div>

                    <form id="quickBookForm">
                        @csrf
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
                            <div>
                                <label class="widget-label">Check-in</label>
                                <input type="text" id="w_checkin" class="widget-input" placeholder="Pilih check-in" readonly style="background:#fff; cursor:pointer;" value="{{ request('check_in', '') }}" required>
                            </div>
                            <div>
                                <label class="widget-label">Check-out</label>
                                <input type="text" id="w_checkout" class="widget-input" placeholder="Pilih check-out" readonly style="background:#fff; cursor:pointer;" value="{{ request('check_out', '') }}" required>
                            </div>
                        </div>
                        <div style="margin-bottom:15px;">
                            <label class="widget-label">Jumlah Tamu</label>
                            <select id="w_guests" class="widget-input">
                                @for($i = 1; $i <= $room->capacity; $i++)
                                    <option value="{{ $i }}">{{ $i }} Tamu</option>
                                @endfor
                            </select>
                        </div>

                        {{-- Availability Indicator --}}
                        <div id="availIndicator" style="display:none;"></div>

                        {{-- Price Breakdown --}}
                        <div class="price-breakdown" id="priceBreakdown" style="display:none;">
                            <div class="price-row"><span>Biaya kamar (<span id="bd_nights">0</span> malam)</span><span id="bd_base">Rp 0</span></div>
                            <div class="price-row total"><span>Total Pembayaran</span><span id="bd_total">Rp 0</span></div>
                        </div>

                        <a href="#" id="btnPesan" class="btn-book-now" style="pointer-events:none; opacity:0.5;">
                            <i data-lucide="calendar-check" style="width:18px;height:18px;display:inline;vertical-align:middle;margin-right:6px;"></i>
                            Pilih Tanggal Dulu
                        </a>
                    </form>
                    @else
                        <div style="text-align:center; padding:20px; background:#f8fafc; border-radius:12px; color:#64748b;">
                            <i data-lucide="shield-alert" style="width:32px;height:32px;margin-bottom:10px;color:#94a3b8;"></i>
                            <p style="margin:0; font-size:0.9rem;">Akun admin tidak bisa memesan kamar.</p>
                        </div>
                    @endif
                @else
                    <div style="padding:20px; background:#f8fafc; border-radius:12px; text-align:center;">
                        <i data-lucide="user" style="width:32px;height:32px;margin-bottom:10px;color:#94a3b8;"></i>
                        <p style="color:#64748b; font-size:0.9rem; margin:0 0 15px;">Silakan login untuk memesan kamar ini</p>
                        <a href="{{ route('login') }}" class="btn-book-now">Login untuk Memesan</a>
                        <div style="margin-top:10px; font-size:0.85rem; color:#94a3b8;">
                            Belum punya akun? <a href="{{ route('register') }}" style="color:var(--primary); font-weight:700;">Daftar Gratis</a>
                        </div>
                    </div>
                @endauth

                {{-- Trust Badges --}}
                <div style="margin-top:20px; display:flex; flex-direction:column; gap:10px;">
                    <div style="display:flex; align-items:center; gap:10px; font-size:0.82rem; color:#64748b;">
                        <i data-lucide="shield-check" style="width:16px;height:16px;color:#059669;flex-shrink:0;"></i>
                        Pembayaran 100% aman & terpercaya
                    </div>
                    <div style="display:flex; align-items:center; gap:10px; font-size:0.82rem; color:#64748b;">
                        <i data-lucide="refresh-cw" style="width:16px;height:16px;color:#059669;flex-shrink:0;"></i>
                        Pembatalan gratis untuk status pending
                    </div>
                    <a href="https://wa.me/6281225711350" target="_blank" rel="noopener noreferrer" style="display:flex; align-items:center; gap:10px; font-size:0.82rem; color:#059669; text-decoration:none; font-weight:600;">
                        <i data-lucide="headphones" style="width:16px;height:16px;color:#059669;flex-shrink:0;"></i>
                        Dukungan 24/7 via WhatsApp (+62 812-2571-1350)
                    </a>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- Flatpickr JS & Indonesian Locale -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
const roomPrice   = @json($room->price);
const roomId      = @json($room->id);
const bookedDates = @json($bookedDatesList ?? []);

// Gallery switcher
function switchGallery(el, src) {
    document.getElementById('mainImg').src = src;
    document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}

function isRangeOverlappingBooked(ci, co) {
    if (!ci || !co) return false;
    const ciDate = new Date(ci + 'T00:00:00');
    const coDate = new Date(co + 'T00:00:00');
    if (coDate <= ciDate) return true;

    for (let dStr of bookedDates) {
        const d = new Date(dStr + 'T00:00:00');
        if (d >= ciDate && d < coDate) {
            return true;
        }
    }
    return false;
}

// Flatpickr widget datepicker logic
let fpWCheckin = null;
let fpWCheckout = null;

const wCheckinEl  = document.getElementById('w_checkin');
const wCheckoutEl = document.getElementById('w_checkout');

if (wCheckinEl && wCheckoutEl) {
    const initCi = wCheckinEl.value;
    const initCo = wCheckoutEl.value;

    fpWCheckin = flatpickr("#w_checkin", {
        locale: "id",
        minDate: "today",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d M Y",
        defaultDate: initCi || null,
        disable: bookedDates,
        onChange: function(selectedDates, dateStr) {
            if (!dateStr || !selectedDates.length) return;
            const nextDay = new Date(selectedDates[0]);
            nextDay.setDate(nextDay.getDate() + 1);

            if (fpWCheckout) {
                fpWCheckout.set('minDate', nextDay);
                fpWCheckout.set('maxDate', null); // Tanpa batas maksimal, bebas pilih durasi menginap

                // Jangan otomatis pilihkan tanggal checkout! Biarkan tamu memilih sendiri durasi menginapnya
                const curCoVal = wCheckoutEl.value;
                if (curCoVal && new Date(curCoVal + 'T00:00:00') <= selectedDates[0]) {
                    fpWCheckout.clear();
                }
            }
            checkAndUpdate();
        }
    });

    fpWCheckout = flatpickr("#w_checkout", {
        locale: "id",
        minDate: new Date().fp_incr(1),
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d M Y",
        defaultDate: initCo || null,
        disable: bookedDates, // Tanggal yang sudah dibooking tidak bisa dipilih
        onChange: function() {
            checkAndUpdate();
        }
    });

    if (initCi && fpWCheckout) {
        const ciDate = new Date(initCi + 'T00:00:00');
        const nextDay = new Date(ciDate);
        nextDay.setDate(nextDay.getDate() + 1);
        fpWCheckout.set('minDate', nextDay);
        fpWCheckout.set('maxDate', null);
    }
}

function fmtRp(n) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(n));
}

function checkAndUpdate() {
    const ci = wCheckinEl ? wCheckinEl.value : null;
    const co = wCheckoutEl ? wCheckoutEl.value : null;
    if (!ci || !co) return;

    const indicator = document.getElementById('availIndicator');
    const bd = document.getElementById('priceBreakdown');
    const btn = document.getElementById('btnPesan');

    // Immediate check if range overlaps booked dates
    if (isRangeOverlappingBooked(ci, co)) {
        indicator.style.display = 'flex';
        indicator.className = 'avail-indicator avail-full';
        indicator.innerHTML = '<i data-lucide="x-circle" style="width:16px;height:16px;"></i>&nbsp;Maaf, tanggal bertabrakan dengan jadwal terisi!';
        if (bd) bd.style.display = 'none';
        if (btn) {
            btn.href = '#';
            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.5';
            btn.innerHTML = '<i data-lucide="x" style="width:18px;height:18px;display:inline;vertical-align:middle;margin-right:6px;"></i> Tidak Tersedia';
        }
        lucide.createIcons();
        return;
    }

    indicator.style.display = 'flex';
    indicator.className = 'avail-indicator avail-loading';
    indicator.innerHTML = '<i data-lucide="loader" style="width:16px;height:16px;"></i>&nbsp;Memeriksa ketersediaan...';
    lucide.createIcons();

    fetch('{{ route("availability.check") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ room_id: roomId, check_in: ci, check_out: co })
    })
    .then(r => r.json())
    .then(data => {
        if (bd) {
            bd.style.display = 'block';
            document.getElementById('bd_nights').textContent  = data.nights;
            document.getElementById('bd_base').textContent    = fmtRp(data.base_price);
            document.getElementById('bd_total').textContent   = fmtRp(data.total_price);
        }

        if (data.available) {
            indicator.className = 'avail-indicator avail-ok';
            indicator.innerHTML = '<i data-lucide="check-circle" style="width:16px;height:16px;"></i>&nbsp;Tersedia!';
            btn.href = '/tamu/book/{{ $room->id }}?check_in=' + ci + '&check_out=' + co;
            btn.style.pointerEvents = '';
            btn.style.opacity = '1';
            btn.innerHTML = '<i data-lucide="calendar-check" style="width:18px;height:18px;display:inline;vertical-align:middle;margin-right:6px;"></i> Pesan Sekarang';
        } else {
            indicator.className = 'avail-indicator avail-full';
            indicator.innerHTML = '<i data-lucide="x-circle" style="width:16px;height:16px;"></i>&nbsp;Penuh pada tanggal ini';
            btn.href = '#';
            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.5';
            btn.innerHTML = '<i data-lucide="x" style="width:18px;height:18px;display:inline;vertical-align:middle;margin-right:6px;"></i> Tidak Tersedia';
        }
        lucide.createIcons();
    })
    .catch(() => {
        indicator.className = 'avail-indicator avail-loading';
        indicator.innerHTML = 'Gagal memeriksa ketersediaan.';
    });
}

// Auto-trigger if dates were pre-filled from URL params
if (wCheckinEl && wCheckoutEl && wCheckinEl.value && wCheckoutEl.value) {
    checkAndUpdate();
}
</script>
@endsection

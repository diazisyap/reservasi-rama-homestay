@extends('layouts.app')

@section('title', 'Katalog Kamar - Rama Homestay')

@section('content')
<style>
    .rooms-page { padding: 45px 0 80px; background: #f8fafc; min-height: 100vh; }
    .filter-panel { 
        background: #ffffff; 
        border-radius: 20px; 
        padding: 30px 35px; 
        border: 1px solid #e2e8f0; 
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04); 
        margin-bottom: 35px; 
    }
    .filter-grid { 
        display: grid; 
        grid-template-columns: 1fr 1fr 240px; 
        gap: 24px; 
        align-items: end; 
    }
    .filter-group label { 
        font-size: 0.78rem; 
        font-weight: 700; 
        text-transform: uppercase; 
        letter-spacing: 1.2px; 
        color: #475569; 
        display: block; 
        margin-bottom: 10px; 
    }
    .filter-group input[type="date"] {
        width: 100%; 
        padding: 13px 18px; 
        border: 1.5px solid #cbd5e1; 
        border-radius: 12px;
        font-family: inherit; 
        font-size: 0.95rem; 
        color: #0f172a; 
        background: #f8fafc;
        box-sizing: border-box;
        transition: all 0.25s ease;
    }
    .filter-group input[type="date"]:focus { 
        border-color: var(--primary); 
        outline: none; 
        background: #ffffff; 
        box-shadow: 0 0 0 4px rgba(245, 166, 35, 0.15);
    }
    .btn-filter-submit {
        flex: 1;
        padding: 13px 20px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(245, 166, 35, 0.25);
        transition: all 0.25s ease;
    }
    .btn-filter-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 166, 35, 0.35);
    }
    .btn-filter-reset {
        padding: 13px 16px;
        background: #f1f5f9;
        color: #475569;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .btn-filter-reset:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
    .room-card-list { background: #fff; border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; display: flex; transition: all 0.35s cubic-bezier(0.16,1,0.3,1); margin-bottom: 24px; }
    .room-card-list:hover { transform: translateY(-4px); box-shadow: 0 16px 40px -8px rgba(15,23,42,0.10); border-color: rgba(217,119,6,0.25); }
    .room-card-img { width: 280px; flex-shrink: 0; position: relative; background: #e2e8f0; }
    .room-card-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .room-type-badge { position: absolute; top: 14px; left: 14px; background: rgba(0,0,0,0.55); backdrop-filter: blur(6px); color: #fff; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; padding: 4px 10px; border-radius: 20px; }
    .room-card-body { flex: 1; padding: 30px 35px; display: flex; flex-direction: column; }
    .room-card-meta { display: flex; gap: 20px; margin-bottom: 15px; flex-wrap: wrap; }
    .room-meta-item { display: flex; align-items: center; gap: 6px; font-size: 0.85rem; color: #64748b; font-weight: 600; }
    .facility-pill { display: inline-flex; align-items: center; gap: 5px; background: rgba(217,119,6,0.08); color: #92400e; font-size: 0.78rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; margin: 3px; }
    .price-section { display: flex; align-items: center; justify-content: space-between; margin-top: auto; padding-top: 20px; border-top: 1px solid #f1f5f9; }
    .availability-badge { display: inline-flex; align-items: center; gap: 6px; font-size: 0.8rem; font-weight: 700; padding: 6px 12px; border-radius: 20px; }
    .avail-ok { background: rgba(16,185,129,0.1); color: #059669; }
    .avail-full { background: rgba(239,68,68,0.1); color: #dc2626; }
    .btn-book-room { background: var(--primary); color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s ease; }
    .btn-book-room:hover { background: #b45309; transform: translateY(-1px); color: white; }
    .results-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    @media (max-width: 992px) {
        .filter-grid { grid-template-columns: 1fr 1fr; }
        .filter-grid > div:last-child { grid-column: span 2; }
    }
    @media (max-width: 768px) {
        .room-card-list { flex-direction: column; }
        .room-card-img { width: 100%; height: 220px; }
        .room-card-body { padding: 20px; }
        .price-section { flex-direction: column; gap: 15px; align-items: flex-start; }
    }
    @media (max-width: 640px) {
        .filter-grid { grid-template-columns: 1fr; gap: 16px; }
        .filter-grid > div:last-child { grid-column: span 1; }
    }
</style>

<div class="rooms-page">
    <div class="container">

        {{-- Page Header --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Pilihan Akomodasi</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Katalog Kamar Homestay</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Temukan kamar yang nyaman untuk menginap di Rama Homestay. Gunakan filter di bawah untuk mempermudah pencarian Anda.</p>
        </div>

        {{-- Filter Panel --}}
        <div class="filter-panel">
            <form method="GET" action="{{ route('rooms.index') }}" id="filterForm">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label>Check-in</label>
                        <input type="date" name="check_in" value="{{ $checkIn ?? '' }}" min="{{ date('Y-m-d') }}" id="filterCheckIn">
                    </div>
                    <div class="filter-group">
                        <label>Check-out</label>
                        <input type="date" name="check_out" value="{{ $checkOut ?? '' }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" id="filterCheckOut">
                    </div>

                    <div class="filter-group">
                        <label>&nbsp;</label>
                        <div style="display:flex; gap:12px;">
                            <button type="submit" class="btn-filter-submit">
                                <i data-lucide="search" style="width:16px; height:16px;"></i>
                                <span>Cari Kamar</span>
                            </button>
                            <a href="{{ route('rooms.index') }}" class="btn-filter-reset" title="Reset Filter">
                                <i data-lucide="x" style="width:16px; height:16px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Results Header --}}
        <div class="results-header">
            <div>
                <h2 style="font-size:1.2rem; font-weight:700; color:#0f172a; margin:0;">{{ $rooms->count() }} Kamar Tersedia</h2>
                @if($checkIn && $checkOut)
                    <p style="font-size:0.85rem; color:#64748b; margin:4px 0 0;">
                        Untuk tanggal {{ \Carbon\Carbon::parse($checkIn)->translatedFormat('d F Y') }} — {{ \Carbon\Carbon::parse($checkOut)->translatedFormat('d F Y') }}
                    </p>
                @endif
            </div>
        </div>

        {{-- Room Cards --}}
        @forelse($rooms as $room)
            @php
                $isAvailable = ($checkIn && $checkOut) ? $room->isAvailable($checkIn, $checkOut) : true;
                $availableCount = ($checkIn && $checkOut) ? $room->getAvailableCount($checkIn, $checkOut) : $room->total_rooms;
            @endphp
            <div class="room-card-list">
                <div class="room-card-img">
                    @if($room->image)
                        <img src="{{ asset('storage/'.$room->image) }}" alt="{{ $room->name }}" loading="lazy">
                    @else
                        <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80" alt="{{ $room->name }}" loading="lazy">
                    @endif
                    <span class="room-type-badge">{{ $room->type_label }}</span>
                </div>

                <div class="room-card-body">
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px; flex-wrap:wrap; gap:10px;">
                            <h3 style="font-size:1.4rem; font-weight:800; color:#0f172a; margin:0; font-family:'Playfair Display', Georgia, serif;">{{ $room->name }}</h3>
                            @if($checkIn && $checkOut)
                                @if($isAvailable)
                                    <span class="availability-badge avail-ok">
                                        <i data-lucide="check-circle" style="width:14px; height:14px;"></i>
                                        Tersedia
                                    </span>
                                @else
                                    <span class="availability-badge avail-full">
                                        <i data-lucide="x-circle" style="width:14px; height:14px;"></i>
                                        Penuh — Tanggal ini
                                    </span>
                                @endif
                            @endif
                        </div>

                        {{-- Room meta --}}
                        <div class="room-card-meta">
                            <span class="room-meta-item">
                                <i data-lucide="users" style="width:15px;height:15px;color:var(--primary);"></i>
                                Max {{ $room->capacity }} Tamu
                            </span>
                            <span class="room-meta-item">
                                <i data-lucide="star" style="width:15px;height:15px;color:var(--primary);fill:var(--primary);stroke:none;"></i>
                                5.0
                            </span>
                        </div>

                        <p style="color:#64748b; font-size:0.92rem; line-height:1.7; margin-bottom:15px;">
                            {{ Str::limit($room->description, 130) }}
                        </p>

                        {{-- Facilities --}}
                        <div style="margin-bottom:5px;">
                            @foreach($room->facilities_list as $key => $fac)
                                <span class="facility-pill">
                                    <i data-lucide="{{ $fac['icon'] }}" style="width:12px;height:12px;"></i>
                                    {{ $fac['label'] }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Price & CTA --}}
                    <div class="price-section">
                        <div>
                            <div style="font-size:0.8rem; color:#94a3b8; font-weight:600; margin-bottom:2px;">Mulai dari</div>
                            <div style="font-size:1.6rem; font-weight:800; color:var(--primary);">
                                Rp {{ number_format($room->price, 0, ',', '.') }}
                            </div>
                            <div style="font-size:0.78rem; color:#94a3b8;">per malam</div>
                        </div>
                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                            @if($isAvailable)
                                <a href="{{ route('rooms.show', $room->id) }}@if($checkIn && $checkOut)?check_in={{ $checkIn }}&check_out={{ $checkOut }}@endif" class="btn-book-room">
                                    <i data-lucide="calendar-plus" style="width:15px;height:15px;"></i>
                                    Pesan Sekarang
                                </a>
                            @else
                                <span style="padding:12px 20px; background:#f1f5f9; color:#94a3b8; border-radius:12px; font-weight:700; font-size:0.9rem;">Tidak Tersedia</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align:center; padding:80px 20px; background:#fff; border-radius:20px; border:1px solid #e2e8f0;">
                <i data-lucide="search-x" style="width:56px;height:56px;color:#cbd5e1;margin-bottom:16px;"></i>
                <h3 style="color:#0f172a; margin:0 0 8px; font-size:1.3rem;">Tidak ada kamar yang cocok</h3>
                <p style="color:#64748b; margin:0 0 20px;">Coba ubah filter pencarian Anda</p>
                <a href="{{ route('rooms.index') }}" style="display:inline-flex; align-items:center; gap:8px; background:var(--primary); color:#fff; padding:12px 24px; border-radius:12px; text-decoration:none; font-weight:700;">
                    <i data-lucide="refresh-cw" style="width:15px;height:15px;"></i> Reset Filter
                </a>
            </div>
        @endforelse

    </div>
</div>

<script>
    // Auto-update checkout min date based on checkin selection
    document.getElementById('filterCheckIn').addEventListener('change', function() {
        const ci = new Date(this.value);
        ci.setDate(ci.getDate() + 1);
        const minCo = ci.toISOString().split('T')[0];
        document.getElementById('filterCheckOut').min = minCo;
        if (document.getElementById('filterCheckOut').value <= this.value) {
            document.getElementById('filterCheckOut').value = minCo;
        }
    });
</script>
@endsection

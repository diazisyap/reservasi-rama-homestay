@extends('layouts.app')

@section('title', 'Ulasan Tamu & Pelayanan - Rama Homestay')

@section('content')
<style>
    .reviews-page-wrapper {
        padding: 50px 0 90px;
        background: #f8fafc;
    }

    /* Rating Summary Card */
    .rating-summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        margin-bottom: 45px;
    }

    .rating-summary-grid {
        display: grid;
        grid-template-columns: 280px 1fr 280px;
        gap: 40px;
        align-items: center;
    }

    .overall-rating-box {
        text-align: center;
        padding-right: 35px;
        border-right: 1px solid #e2e8f0;
    }

    .big-score {
        font-size: 4rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        margin-bottom: 8px;
    }

    .big-stars {
        color: #f59e0b;
        font-size: 1.5rem;
        letter-spacing: 2px;
        margin-bottom: 8px;
    }

    .total-reviews-label {
        font-size: 0.92rem;
        color: #64748b;
        font-weight: 600;
    }

    /* Rating Bars */
    .rating-bars-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .rating-bar-row {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.88rem;
    }

    .bar-star-label {
        width: 65px;
        color: #334155;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .bar-track {
        flex-grow: 1;
        height: 10px;
        background: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #f5a623 0%, #d97706 100%);
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    .bar-count-label {
        width: 40px;
        text-align: right;
        color: #64748b;
        font-weight: 600;
    }

    /* Action CTA Box */
    .rating-action-box {
        text-align: center;
        padding-left: 35px;
        border-left: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .btn-submit-review {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: var(--primary);
        color: #111827 !important;
        font-weight: 800;
        font-size: 0.98rem;
        padding: 14px 28px;
        border-radius: 35px;
        text-decoration: none !important;
        box-shadow: 0 6px 20px rgba(245, 166, 35, 0.35);
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
        width: 100%;
        max-width: 240px;
    }

    .btn-submit-review:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(245, 166, 35, 0.45);
    }

    /* Filter Pills */
    .review-filter-bar {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 35px;
        flex-wrap: wrap;
    }

    .filter-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 30px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #475569;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .filter-pill:hover, .filter-pill.active {
        background: #0f172a;
        color: #ffffff;
        border-color: #0f172a;
    }

    .filter-pill.active {
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
    }

    /* Review Cards Grid */
    .reviews-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 26px;
        margin-bottom: 45px;
    }

    .review-card-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 30px 26px;
        box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s ease;
        position: relative;
    }

    .review-card-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 35px rgba(15, 23, 42, 0.07);
        border-color: rgba(245, 166, 35, 0.35);
    }

    .review-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .card-stars {
        color: #f59e0b;
        font-size: 1.15rem;
        display: flex;
        gap: 3px;
    }

    .card-date {
        font-size: 0.78rem;
        color: #94a3b8;
        font-weight: 500;
    }

    .card-review-text {
        color: #334155;
        font-size: 0.98rem;
        line-height: 1.7;
        margin: 0 0 24px;
        font-style: italic;
        flex-grow: 1;
    }

    .card-author-info {
        display: flex;
        align-items: center;
        gap: 14px;
        padding-top: 18px;
        border-top: 1px solid #f1f5f9;
    }

    .card-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f5a623 0%, #d97706 100%);
        color: #ffffff;
        font-weight: 700;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(245, 166, 35, 0.25);
    }

    .card-guest-name {
        font-weight: 700;
        font-size: 0.98rem;
        color: #0f172a;
        margin: 0 0 3px 0;
    }

    .card-guest-origin {
        font-size: 0.8rem;
        color: #64748b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .verified-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: #16a34a;
        background: #f0fdf4;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 20px;
        border: 1px solid #bbf7d0;
        margin-top: 4px;
    }

    .verified-pill i {
        width: 12px;
        height: 12px;
    }

    /* Modal Form */
    .custom-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .custom-modal-backdrop.show {
        display: flex;
    }
    .custom-modal-content {
        background: #ffffff;
        border-radius: 24px;
        max-width: 520px;
        width: 100%;
        padding: 34px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        position: relative;
        animation: modalFadeIn 0.3s ease;
    }
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .modal-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #f1f5f9;
        border: none;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.2s;
    }
    .modal-close-btn:hover {
        background: #e2e8f0;
        color: #0f172a;
    }
    .star-rating-select {
        display: flex;
        gap: 8px;
        font-size: 2rem;
        cursor: pointer;
        margin: 8px 0 16px;
    }
    .star-rating-select .star-item {
        color: #cbd5e1;
        transition: color 0.2s;
    }
    .star-rating-select .star-item.selected,
    .star-rating-select .star-item:hover,
    .star-rating-select .star-item.hover {
        color: #f59e0b;
    }

    /* Pagination Styling */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }
    .custom-pagination {
        display: flex;
        align-items: center;
        gap: 6px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .custom-pagination .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        padding: 0 10px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #475569;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .custom-pagination .page-item .page-link:hover {
        background: var(--primary);
        color: #111827;
        border-color: var(--primary);
    }
    .custom-pagination .page-item.active .page-link {
        background: var(--primary);
        color: #111827;
        border-color: var(--primary);
        pointer-events: none;
    }
    .custom-pagination .page-item.disabled .page-link {
        color: #cbd5e1;
        background: #f8fafc;
        border-color: #f1f5f9;
        pointer-events: none;
        cursor: default;
    }

    @media (max-width: 992px) {
        .rating-summary-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        .overall-rating-box {
            border-right: none;
            padding-right: 0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 25px;
        }
        .rating-action-box {
            border-left: none;
            padding-left: 0;
            border-top: 1px solid #e2e8f0;
            padding-top: 25px;
        }
        .reviews-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .reviews-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="reviews-page-wrapper">
    <div class="container">
        
        {{-- Page Header (Style Kamar) --}}
        <div style="margin-bottom: 35px;">
            <span style="font-size:0.8rem; letter-spacing:2px; text-transform:uppercase; color:var(--primary); font-weight:700;">Testimoni &amp; Penilaian</span>
            <h1 style="font-size:2.4rem; font-weight:800; color:#0f172a; margin:8px 0 12px; font-family:'Playfair Display', Georgia, serif;">Ulasan Tamu &amp; Pelayanan</h1>
            <p style="color:#64748b; font-size:1rem; max-width:600px;">Simak pengalaman nyata dan kepuasan tamu yang telah menikmati kehangatan dan kenyamanan menginap di Rama Homestay.</p>
        </div>
        
        <!-- Rating Summary Dashboard Card -->
        <div class="rating-summary-card">
            <div class="rating-summary-grid">
                <!-- Overall Score -->
                <div class="overall-rating-box">
                    <div class="big-score">{{ number_format($avgRating, 1) }}</div>
                    <div class="big-stars">&starf;&starf;&starf;&starf;&starf;</div>
                    <div class="total-reviews-label">Berdasarkan {{ $totalCount }} Ulasan Terverifikasi</div>
                    <div style="font-size:0.8rem;color:#16a34a;font-weight:700;margin-top:8px;">
                        <i data-lucide="check-circle-2" style="width:14px;height:14px;display:inline-block;vertical-align:middle;"></i> 99% Tamu Merekomendasikan
                    </div>
                </div>

                <!-- Rating Distribution Bars -->
                <div class="rating-bars-list">
                    @php
                        $calcPct = function($cnt, $total) {
                            return $total > 0 ? round(($cnt / $total) * 100) : 0;
                        };
                    @endphp
                    <!-- 5 Stars -->
                    <div class="rating-bar-row">
                        <span class="bar-star-label">5 &starf;</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $calcPct($rating5Count, $totalCount) }}%;"></div>
                        </div>
                        <span class="bar-count-label">{{ $rating5Count }}</span>
                    </div>

                    <!-- 4 Stars -->
                    <div class="rating-bar-row">
                        <span class="bar-star-label">4 &starf;</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $calcPct($rating4Count, $totalCount) }}%;"></div>
                        </div>
                        <span class="bar-count-label">{{ $rating4Count }}</span>
                    </div>

                    <!-- 3 Stars -->
                    <div class="rating-bar-row">
                        <span class="bar-star-label">3 &starf;</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $calcPct($rating3Count, $totalCount) }}%;"></div>
                        </div>
                        <span class="bar-count-label">{{ $rating3Count }}</span>
                    </div>

                    <!-- 2 Stars -->
                    <div class="rating-bar-row">
                        <span class="bar-star-label">2 &starf;</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $calcPct($rating2Count, $totalCount) }}%;"></div>
                        </div>
                        <span class="bar-count-label">{{ $rating2Count }}</span>
                    </div>

                    <!-- 1 Star -->
                    <div class="rating-bar-row">
                        <span class="bar-star-label">1 &starf;</span>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $calcPct($rating1Count, $totalCount) }}%;"></div>
                        </div>
                        <span class="bar-count-label">{{ $rating1Count }}</span>
                    </div>
                </div>

                <!-- Action CTA -->
                <div class="rating-action-box">
                    <h4 style="margin: 0 0 8px; font-size: 1.1rem; color: #0f172a; font-weight: 700;">Sudah Menginap?</h4>
                    <p style="color: #64748b; font-size: 0.88rem; line-height: 1.5; margin: 0 0 20px;">Bagikan kesan dan pengalaman pelayanan yang Anda rasakan di Rama Homestay.</p>
                    @auth
                        @if(auth()->user()->role === 'tamu')
                            <button type="button" class="btn-submit-review" onclick="openReviewModal()">
                                <i data-lucide="pen-tool" style="width:16px;height:16px;"></i> Beri Ulasan
                            </button>
                        @else
                            <a href="{{ route('admin.testimonials') }}" class="btn-submit-review">
                                <i data-lucide="shield" style="width:16px;height:16px;"></i> Moderasi Ulasan
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-submit-review">
                            <i data-lucide="log-in" style="width:16px;height:16px;"></i> Masuk untuk Ulas
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="review-filter-bar">
            <span style="font-size:0.85rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-right:8px;">Filter:</span>
            <a href="{{ route('reviews') }}" class="filter-pill {{ empty($ratingFilter) ? 'active' : '' }}">Semua Ulasan ({{ $totalCount }})</a>
            <a href="{{ route('reviews', ['rating' => 5]) }}" class="filter-pill {{ $ratingFilter == '5' ? 'active' : '' }}">5 Bintang ({{ $rating5Count }})</a>
            <a href="{{ route('reviews', ['rating' => 4]) }}" class="filter-pill {{ $ratingFilter == '4' ? 'active' : '' }}">4 Bintang ({{ $rating4Count }})</a>
            @if($rating3Count > 0)
                <a href="{{ route('reviews', ['rating' => 3]) }}" class="filter-pill {{ $ratingFilter == '3' ? 'active' : '' }}">3 Bintang ({{ $rating3Count }})</a>
            @endif
        </div>

        <!-- Grid of Reviews -->
        <div class="reviews-grid">
            @forelse($testimonials as $testi)
                <div class="review-card-item">
                    <div>
                        <div class="review-card-top">
                            <div class="card-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testi->rating)
                                        &starf;
                                    @else
                                        <span style="color:#cbd5e1;">&starf;</span>
                                    @endif
                                @endfor
                            </div>
                            <span class="card-date">{{ $testi->created_at->format('d M Y') }}</span>
                        </div>

                        <p class="card-review-text">
                            "{{ $testi->review }}"
                        </p>
                    </div>

                    <div class="card-author-info">
                        <div class="card-avatar">
                            {{ strtoupper(substr($testi->guest_name ?? 'T', 0, 1)) }}
                        </div>
                        <div style="flex-grow: 1;">
                            <h5 class="card-guest-name">{{ $testi->guest_name }}</h5>
                            <p class="card-guest-origin">
                                <i data-lucide="map-pin" style="width:12px;height:12px;color:var(--primary);"></i>
                                {{ $testi->guest_origin ?? 'Tamu Homestay' }}
                            </p>
                            <span class="verified-pill">
                                <i data-lucide="check-circle-2"></i> Tamu Terverifikasi
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: #ffffff; border-radius: 20px; border: 1px dashed #cbd5e1;">
                    <i data-lucide="message-square-off" style="width:48px;height:48px;color:#94a3b8;margin-bottom:14px;"></i>
                    <h4 style="color:#0f172a;margin-bottom:8px;">Belum Ada Ulasan Pada Kategori Ini</h4>
                    <p style="color:#64748b;margin-bottom:20px;">Silakan pilih filter lain untuk melihat testimoni tamu lainnya.</p>
                    <a href="{{ route('reviews') }}" class="btn-submit-review" style="display:inline-flex;">Lihat Semua Ulasan</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($testimonials->hasPages())
            <div class="pagination-wrapper">
                <ul class="custom-pagination">
                    {{-- Previous --}}
                    @if($testimonials->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">&laquo; Sebelumnya</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $testimonials->previousPageUrl() . (request('rating') ? '&rating='.request('rating') : '') }}">&laquo; Sebelumnya</a>
                        </li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($testimonials->getUrlRange(1, $testimonials->lastPage()) as $page => $url)
                        @if($page == $testimonials->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url . (request('rating') ? '&rating='.request('rating') : '') }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($testimonials->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $testimonials->nextPageUrl() . (request('rating') ? '&rating='.request('rating') : '') }}">Berikutnya &raquo;</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Berikutnya &raquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        @endif

    </div>
</div>

<!-- Modal Tulis Ulasan Pelayanan -->
@auth
    @if(auth()->user()->role === 'tamu')
    <div class="custom-modal-backdrop" id="reviewModal">
        <div class="custom-modal-content">
            <button type="button" class="modal-close-btn" onclick="closeReviewModal()">
                <i data-lucide="x" style="width:18px;height:18px;"></i>
            </button>
            <h3 style="margin: 0 0 8px 0; font-size: 1.4rem; color: #0f172a; font-weight: 700;">Beri Ulasan Pelayanan</h3>
            <p style="color: #64748b; font-size: 0.88rem; margin: 0 0 20px 0;">Bagikan pengalaman menginap dan kepuasan pelayanan Anda di Rama Homestay Dieng.</p>

            <form action="{{ route('tamu.review.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 16px;">
                    <label style="display:block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 4px;">Penilaian Rating</label>
                    <div class="star-rating-select" id="starSelector">
                        <span class="star-item selected" data-value="1">&starf;</span>
                        <span class="star-item selected" data-value="2">&starf;</span>
                        <span class="star-item selected" data-value="3">&starf;</span>
                        <span class="star-item selected" data-value="4">&starf;</span>
                        <span class="star-item selected" data-value="5">&starf;</span>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="5">
                </div>

                <div style="margin-bottom: 16px;">
                    <label for="guest_name" style="display:block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 6px;">Nama Anda</label>
                    <input type="text" name="guest_name" id="guest_name" class="form-control" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; box-sizing:border-box;" value="{{ auth()->user()->name }}" required>
                </div>

                <div style="margin-bottom: 16px;">
                    <label for="guest_origin" style="display:block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 6px;">Kota Asal / Domisili</label>
                    <input type="text" name="guest_origin" id="guest_origin" class="form-control" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; box-sizing:border-box;" placeholder="Contoh: Jakarta, Semarang, Yogyakarta">
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="review" style="display:block; font-size: 0.85rem; font-weight: 600; color: #334155; margin-bottom: 6px;">Ulasan Terhadap Pelayanan &amp; Fasilitas</label>
                    <textarea name="review" id="review" rows="4" class="form-control" style="width:100%; padding:12px 14px; border:1px solid #cbd5e1; border-radius:10px; font-size:0.95rem; resize:vertical; box-sizing:border-box;" placeholder="Tuliskan pengalaman Anda mengenai keramahan staf, kenyamanan kamar, kebersihan, atau fasilitas homestay..." required minlength="5" maxlength="500"></textarea>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:12px;">
                    <button type="button" onclick="closeReviewModal()" style="padding:10px 18px; border:1px solid #cbd5e1; background:#f8fafc; border-radius:10px; font-weight:600; cursor:pointer; color:#475569;">Batal</button>
                    <button type="submit" style="padding:10px 24px; border:none; background:var(--primary); color:#111827; border-radius:10px; font-weight:700; cursor:pointer; box-shadow:0 4px 12px rgba(245,166,35,0.3);">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endauth

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide) {
            window.lucide.createIcons();
        }

        // Star rating selector handler
        const starItems = document.querySelectorAll('#starSelector .star-item');
        const ratingInput = document.getElementById('ratingInput');
        if (starItems && ratingInput) {
            starItems.forEach(star => {
                star.addEventListener('click', function() {
                    const val = parseInt(this.getAttribute('data-value'));
                    ratingInput.value = val;
                    starItems.forEach(s => {
                        if (parseInt(s.getAttribute('data-value')) <= val) {
                            s.classList.add('selected');
                        } else {
                            s.classList.remove('selected');
                        }
                    });
                });
            });
        }
    });

    function openReviewModal() {
        const modal = document.getElementById('reviewModal');
        if (modal) {
            modal.classList.add('show');
            if (window.lucide) window.lucide.createIcons();
        }
    }

    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        if (modal) {
            modal.classList.remove('show');
        }
    }
</script>
@endsection

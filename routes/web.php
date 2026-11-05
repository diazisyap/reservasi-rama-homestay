<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MidtransController;

// =========================================
// MIDTRANS WEBHOOK & REDIRECT ROUTES
// =========================================
Route::post('/midtrans/notification', [MidtransController::class, 'notification'])->name('midtrans.notification');
Route::get('/midtrans/finish',        [MidtransController::class, 'finish'])->name('midtrans.finish');
Route::get('/midtrans/unfinish',      [MidtransController::class, 'unfinish'])->name('midtrans.unfinish');
Route::get('/midtrans/error',         [MidtransController::class, 'error'])->name('midtrans.error');

// =========================================
// PUBLIC ROUTES
// =========================================

Route::get('/', function () {
    $rooms        = \App\Models\Room::where('is_active', true)->take(6)->get();
    $testimonials = \App\Models\Testimonial::where('is_approved', true)->latest()->take(6)->get();
    return view('welcome', compact('rooms', 'testimonials'));
})->name('home');

Route::get('/reviews', function (\Illuminate\Http\Request $request) {
    $ratingFilter = $request->query('rating');
    $query = \App\Models\Testimonial::where('is_approved', true);

    if ($ratingFilter && in_array($ratingFilter, ['1', '2', '3', '4', '5'])) {
        $query->where('rating', $ratingFilter);
    }

    $testimonials = $query->latest()->paginate(9)->withQueryString();
    $totalCount   = \App\Models\Testimonial::where('is_approved', true)->count();
    $avgRating    = round(\App\Models\Testimonial::where('is_approved', true)->avg('rating') ?: 5.0, 1);
    $rating5Count = \App\Models\Testimonial::where('is_approved', true)->where('rating', 5)->count();
    $rating4Count = \App\Models\Testimonial::where('is_approved', true)->where('rating', 4)->count();
    $rating3Count = \App\Models\Testimonial::where('is_approved', true)->where('rating', 3)->count();
    $rating2Count = \App\Models\Testimonial::where('is_approved', true)->where('rating', 2)->count();
    $rating1Count = \App\Models\Testimonial::where('is_approved', true)->where('rating', 1)->count();

    return view('navs.reviews', compact(
        'testimonials', 'totalCount', 'avgRating',
        'rating5Count', 'rating4Count', 'rating3Count', 'rating2Count', 'rating1Count',
        'ratingFilter'
    ));
})->name('reviews');
Route::get('/ulasan', fn() => redirect()->route('reviews'));
Route::get('/testimonials', fn() => redirect()->route('reviews'));

// Public static pages
Route::get('/about',    fn() => redirect()->route('home'))->name('about');
Route::get('/contact',  fn() => view('navs.contact'))->name('contact');
Route::get('/facilities', fn() => view('navs.facilities'))->name('facilities');
Route::get('/activities', fn() => view('navs.activities'))->name('activities');
Route::get('/destinations', fn() => view('navs.destinations'))->name('destinations');
Route::get('/tours',    fn() => view('navs.tours'))->name('tours');
Route::get('/blog',     fn() => view('navs.blog'))->name('blog');
Route::get('/pages',    fn() => view('navs.pages'))->name('pages');

// Public: Room listing with filters
Route::get('/rooms', [RoomController::class, 'indexClient'])->name('rooms.index');
Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

// AJAX: Check room availability & booked dates
Route::post('/api/check-availability', [ReservationController::class, 'checkAvailability'])->name('availability.check');
Route::get('/api/rooms/{room}/booked-dates', [ReservationController::class, 'getBookedDates'])->name('rooms.booked-dates');

// =========================================
// AUTHENTICATION ROUTES
// =========================================

Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// =========================================
// GUEST (TAMU) ROUTES — auth required
// =========================================

Route::middleware('auth')->prefix('tamu')->name('tamu.')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        \App\Models\Reservation::releaseExpiredReservations();
        $user         = auth()->user();
        $reservations = $user->reservations()->with('room')->latest()->get();

        $pendingCount   = $reservations->where('status', 'pending')->count();
        $confirmedCount = $reservations->where('status', 'confirmed')->count();
        $completedCount = $reservations->where('status', 'completed')->count();
        $cancelledCount = $reservations->where('status', 'cancelled')->count();
        $totalSpent     = $reservations->whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        return view('tamu.dashboard', compact(
            'reservations', 'pendingCount', 'confirmedCount',
            'completedCount', 'cancelledCount', 'totalSpent'
        ));
    })->name('dashboard');

    // Booking flow
    Route::get('/book/{room}',     [ReservationController::class, 'showBookingForm'])->name('book.form');
    Route::post('/book/confirm',   [ReservationController::class, 'processBooking'])->name('book.confirm');
    Route::get('/book-success',    [ReservationController::class, 'bookingSuccess'])->name('booking.success');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'guestShow'])->name('reservation.show');
    Route::post('/cancel/{reservation}', [ReservationController::class, 'cancel'])->name('reservation.cancel');

    // Midtrans Payment & Status Sync
    Route::get('/pay/{reservation}',         [MidtransController::class, 'payPage'])->name('pay');
    Route::post('/pay/{reservation}/token',   [MidtransController::class, 'getToken'])->name('pay.token');
    Route::post('/pay/{reservation}/sync',    [MidtransController::class, 'syncStatus'])->name('pay.sync');

    // Legacy quick-book
    Route::post('/book', [ReservationController::class, 'store'])->name('book');

    // Review/Testimonial
    Route::post('/review', [TestimonialController::class, 'store'])->name('review.store');

    // Profile
    Route::get('/profile',  [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Alias for profile (backward compat)
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// =========================================
// ADMIN ROUTES — auth + admin middleware
// =========================================

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Calendar
    Route::get('/calendar', [AdminController::class, 'calendar'])->name('calendar');

    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/reports/export', [AdminController::class, 'exportReports'])->name('reports.export');

    // Users management
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    // Testimonials management
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials');
    Route::post('/testimonials/{testimonial}/toggle', [AdminController::class, 'toggleTestimonial'])->name('testimonials.toggle');

    // Rooms CRUD
    Route::resource('rooms', RoomController::class);

    // Reservations CRUD
    Route::resource('reservations', ReservationController::class);
    Route::post('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');
});

<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Admin: List all reservations.
     */
    public function index(Request $request)
    {
        Reservation::releaseExpiredReservations();

        $query = Reservation::with(['user', 'room'])->latest();
        if ($request->status) {
            $query->where('status', $request->status);
        }
        $reservations = $query->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Legacy simple booking (kept for backward compat).
     */
    public function store(Request $request)
    {
        Reservation::releaseExpiredReservations();

        $validated = $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($validated['room_id']);
        $checkIn  = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $nights   = $checkIn->diffInDays($checkOut);
        $basePrice = $nights * $room->price;

        // Anti-double booking check
        if (!$room->isAvailable($validated['check_in'], $validated['check_out'])) {
            return back()->withErrors(['check_in' => 'Maaf, kamar tidak tersedia pada tanggal yang dipilih.']);
        }

        Reservation::create([
            'user_id'    => Auth::id(),
            'room_id'    => $room->id,
            'guest_name' => Auth::user()->name,
            'guest_email' => Auth::user()->email,
            'check_in'   => $validated['check_in'],
            'check_out'  => $validated['check_out'],
            'nights'     => $nights,
            'base_price' => $basePrice,
            'total_price' => $basePrice,
            'status'     => 'pending',
            'expires_at' => now()->addMinutes(30),
        ]);

        return redirect()->route('tamu.dashboard')->with('success', 'Reservasi berhasil dibuat. Silakan selesaikan pembayaran dalam 30 menit.');
    }

    /**
     * Show multi-step booking form for a room.
     */
    public function showBookingForm(Request $request, Room $room)
    {
        if (!$room->is_active || in_array($room->name, ['Kamar 7', 'Kamar 8', 'Kamar 9', 'Kamar 10'])) {
            return redirect()->route('rooms.index')->with('error', 'Kamar ini sedang tidak tersedia.');
        }
        $user = Auth::user();

        $checkIn = old('check_in') ?: ($request->query('check_in') ?: session('search_check_in', date('Y-m-d')));
        $checkOut = old('check_out') ?: ($request->query('check_out') ?: session('search_check_out', date('Y-m-d', strtotime('+1 day'))));

        if (strtotime($checkOut) <= strtotime($checkIn)) {
            $checkOut = date('Y-m-d', strtotime($checkIn . ' +1 day'));
        }

        $nights = max(1, (int) \Carbon\Carbon::parse($checkIn)->diffInDays(\Carbon\Carbon::parse($checkOut)));

        $isCurrentAvailable = $room->isAvailable($checkIn, $checkOut);
        $bookedDatesList = $room->getBookedDatesList();
        $bookedRangesHuman = $room->getBookedDateRangesHuman();
        $flatpickrRanges = $room->getFlatpickrBookedRanges();

        return view('tamu.booking_form', compact(
            'room', 'user', 'checkIn', 'checkOut', 'nights',
            'isCurrentAvailable', 'bookedDatesList', 'bookedRangesHuman', 'flatpickrRanges'
        ));
    }

    /**
     * AJAX: Get booked dates and ranges for a room.
     */
    public function getBookedDates(Room $room)
    {
        return response()->json([
            'room_id'           => $room->id,
            'booked_ranges'     => $room->getBookedDateRangesHuman(),
            'disabled_dates'    => $room->getBookedDatesList(),
            'flatpickr_ranges'  => $room->getFlatpickrBookedRanges(),
        ]);
    }

    /**
     * AJAX: Check room availability for date range.
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'room_id'   => 'required|exists:rooms,id',
            'check_in'  => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($request->room_id);
        $available = $room->isAvailable($request->check_in, $request->check_out);
        $availableCount = $room->getAvailableCount($request->check_in, $request->check_out);

        $checkIn  = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $nights   = $checkIn->diffInDays($checkOut);
        $basePrice = $nights * $room->price;
        $taxAmount = 0;
        $serviceAmount = 0;
        $totalPrice = $basePrice;

        return response()->json([
            'available'       => $available,
            'available_count' => $availableCount,
            'nights'          => $nights,
            'base_price'      => $basePrice,
            'tax_amount'      => 0,
            'service_amount'  => 0,
            'total_price'     => $totalPrice,
            'tax_rate'        => 0,
            'service_rate'    => 0,
            'booked_dates'    => $room->getBookedDatesList(),
            'booked_ranges'   => $room->getBookedDateRangesHuman(),
        ]);
    }

    /**
     * Process multi-step booking confirmation with full validation.
     */
    public function processBooking(Request $request)
    {
        $validated = $request->validate([
            'room_id'          => 'required|exists:rooms,id',
            'check_in'         => 'required|date|after_or_equal:today',
            'check_out'        => 'required|date|after:check_in',
            'guest_name'       => 'required|string|max:255',
            'guest_email'      => 'required|email|max:255',
            'guest_phone'      => 'required|string|max:20',
            'payment_method'   => 'required|string',
            'special_requests' => 'nullable|string|max:500',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check availability upfront
        if (!$room->isAvailable($validated['check_in'], $validated['check_out'])) {
            $ciFmt = \Carbon\Carbon::parse($validated['check_in'])->translatedFormat('d M Y');
            $coFmt = \Carbon\Carbon::parse($validated['check_out'])->translatedFormat('d M Y');
            return back()->withErrors([
                'check_in' => "Maaf, kamar {$room->name} sudah terisi atau memiliki jadwal booking pada tanggal {$ciFmt} s/d {$coFmt}. Silakan pilih tanggal lain yang masih tersedia."
            ])->withInput();
        }

        // === ANTI-DOUBLE BOOKING: Use database transaction + lock ===
        return DB::transaction(function () use ($validated, $room) {
            // Auto-release expired bookings before checking conflict
            Reservation::releaseExpiredReservations();

            // Re-check availability inside transaction with a lock to prevent race conditions
            $conflictingCount = Reservation::where('room_id', $room->id)
                ->whereNotIn('status', ['cancelled', 'completed'])
                ->where(function ($q) {
                    $q->where('status', '!=', 'pending')
                      ->orWhereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
                })
                ->where(function ($q) use ($validated) {
                    $q->where('check_in', '<', $validated['check_out'])
                      ->where('check_out', '>', $validated['check_in']);
                })
                ->lockForUpdate()
                ->count();

            if ($conflictingCount >= $room->total_rooms) {
                $ciFmt = \Carbon\Carbon::parse($validated['check_in'])->translatedFormat('d M Y');
                $coFmt = \Carbon\Carbon::parse($validated['check_out'])->translatedFormat('d M Y');
                return back()->withErrors([
                    'check_in' => "Maaf, kamar {$room->name} sudah terisi atau memiliki jadwal booking pada tanggal {$ciFmt} s/d {$coFmt}. Silakan pilih tanggal lain yang masih tersedia."
                ])->withInput();
            }

            $checkIn  = \Carbon\Carbon::parse($validated['check_in']);
            $checkOut = \Carbon\Carbon::parse($validated['check_out']);
            $nights   = $checkIn->diffInDays($checkOut);
            $basePrice     = $nights * $room->price;
            $taxAmount     = 0;
            $serviceAmount = 0;
            $totalPrice    = $basePrice;

            $isCash = str_contains(strtolower($validated['payment_method']), 'cash') || str_contains(strtolower($validated['payment_method']), 'tempat');
            $expiresAt = $isCash ? null : now()->addMinutes(30);

            $reservation = Reservation::create([
                'user_id'          => Auth::id(),
                'room_id'          => $room->id,
                'guest_name'       => $validated['guest_name'],
                'guest_email'      => $validated['guest_email'],
                'guest_phone'      => $validated['guest_phone'],
                'check_in'         => $validated['check_in'],
                'check_out'        => $validated['check_out'],
                'nights'           => $nights,
                'base_price'       => $basePrice,
                'tax_amount'       => $taxAmount,
                'service_amount'   => $serviceAmount,
                'total_price'      => $totalPrice,
                'payment_method'   => $validated['payment_method'],
                'special_requests' => $validated['special_requests'] ?? null,
                'status'           => 'pending',
                'expires_at'       => $expiresAt,
            ]);

            $snapToken = null;
            try {
                $midtransService = app(\App\Services\MidtransService::class);
                $snapToken = $midtransService->createSnapToken($reservation);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Auto snap token creation failed: ' . $e->getMessage());
            }

            // Store summary in session for success/ticket page
            session([
                'last_booking' => [
                    'id'             => $reservation->id,
                    'booking_code'   => $reservation->booking_code,
                    'room_name'      => $room->name,
                    'room_type'      => $room->type_label,
                    'room_image'     => $room->image,
                    'check_in'       => $validated['check_in'],
                    'check_out'      => $validated['check_out'],
                    'nights'         => $nights,
                    'base_price'     => $basePrice,
                    'tax_amount'     => $taxAmount,
                    'service_amount' => $serviceAmount,
                    'total_price'    => $totalPrice,
                    'guest_name'     => $validated['guest_name'],
                    'guest_email'    => $validated['guest_email'],
                    'guest_phone'    => $validated['guest_phone'],
                    'payment_method' => $validated['payment_method'],
                    'snap_token'     => $snapToken,
                    'status'         => 'pending',
                    'expires_at'     => $reservation->expires_at ? $reservation->expires_at->toIso8601String() : null,
                    'special_requests' => $validated['special_requests'] ?? '',
                ]
            ]);

            return redirect()->route('tamu.booking.success');
        });
    }

    /**
     * Show booking success / e-ticket page.
     */
    public function bookingSuccess()
    {
        $booking = session('last_booking');
        if (!$booking) {
            return redirect()->route('home');
        }

        $reservation = null;
        if (!empty($booking['id'])) {
            $reservation = Reservation::find($booking['id']);
            if ($reservation) {
                if ($reservation->isExpired()) {
                    $reservation->update(['status' => 'cancelled']);
                }
                $booking['status'] = $reservation->status;
                $booking['paid_at'] = $reservation->paid_at;
                $booking['snap_token'] = $reservation->snap_token;
                $booking['expires_at'] = $reservation->expires_at ? $reservation->expires_at->toIso8601String() : null;
            }
        }

        return view('tamu.booking_success', compact('booking', 'reservation'));
    }

    /**
     * Admin: Update reservation status.
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $data = ['status' => $validated['status']];

        // Auto set paid_at when manually confirmed by admin
        if ($validated['status'] === 'confirmed' && !$reservation->paid_at) {
            $data['paid_at'] = now();
        }

        $reservation->update($data);

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    /**
     * Admin: Show single reservation detail.
     */
    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'room']);
        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Guest: View details of their own reservation.
     */
    public function guestShow(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->load(['room', 'user']);

        $qrData = "RAMA-HOMESTAY|{$reservation->booking_code}|{$reservation->guest_name}|{$reservation->check_in->toDateString()}|{$reservation->check_out->toDateString()}";
        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&ecc=M&data=" . urlencode($qrData);

        return view('tamu.reservations.show', compact('reservation', 'qrUrl'));
    }

    /**
     * Guest: Cancel their own reservation (allowed up to 24 hours after booking).
     */
    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        if (in_array($reservation->status, ['cancelled', 'completed'])) {
            return back()->with('error', 'Reservasi ini tidak dapat dibatalkan.');
        }

        $deadline = $reservation->created_at->copy()->addHours(24);
        if (now()->greaterThan($deadline)) {
            $createdFmt = $reservation->created_at->translatedFormat('d M Y H:i');
            return back()->with('error', "Batas waktu pembatalan reservasi (maksimal 24 jam setelah reservasi dibuat pada {$createdFmt} WIB) telah berakhir. Silakan hubungi admin untuk bantuan.");
        }

        if (\Carbon\Carbon::parse($reservation->check_in)->isPast() && !\Carbon\Carbon::parse($reservation->check_in)->isToday()) {
            return back()->with('error', 'Reservasi yang sudah melewati tanggal check-in tidak dapat dibatalkan.');
        }

        $wasPaid = in_array($reservation->status, ['confirmed']) || !empty($reservation->paid_at);
        $amountFmt = 'Rp ' . number_format($reservation->total_price, 0, ',', '.');
        $refundNote = $wasPaid
            ? "Dana Anda sebesar {$amountFmt} telah otomatis dikembalikan 100% ke rekening / metode pembayaran Anda."
            : "Pesanan dibatalkan sebelum pembayaran diselesaikan.";

        $reservation->update([
            'status'       => 'cancelled',
            'cancelled_at' => now(),
            'refund_note'  => $refundNote,
        ]);

        $successMsg = $wasPaid
            ? "Reservasi berhasil dibatalkan. Catatan Pengembalian Dana: {$refundNote}"
            : "Reservasi berhasil dibatalkan. Kamar telah dilepaskan kembali.";

        return back()->with('success', $successMsg);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Admin Dashboard: Revenue stats, recent bookings.
     */
    public function dashboard()
    {
        Reservation::releaseExpiredReservations();

        $roomsCount        = Room::count();
        $reservationsCount = Reservation::count();
        $usersCount        = User::where('role', 'tamu')->count();
        $pendingCount      = Reservation::where('status', 'pending')->count();

        $totalRevenue = Reservation::whereIn('status', ['confirmed', 'completed'])
            ->sum('total_price');

        $monthlyRevenue = Reservation::whereIn('status', ['confirmed', 'completed'])
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('SUM(total_price) as revenue'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $recentReservations = Reservation::with(['user', 'room'])
            ->latest()
            ->take(8)
            ->get();

        $statusBreakdown = Reservation::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        $topRooms = Room::withCount(['reservations as bookings_count' => function ($q) {
            $q->whereNotIn('status', ['cancelled']);
        }])
        ->orderByDesc('bookings_count')
        ->take(5)
        ->get();

        return view('admin.dashboard', compact(
            'roomsCount', 'reservationsCount', 'usersCount', 'pendingCount',
            'totalRevenue', 'monthlyRevenue', 'recentReservations', 'statusBreakdown', 'topRooms'
        ));
    }

    /**
     * Admin: Laporan reservasi dengan filter tanggal & status.
     */
    public function reports(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate   = $request->input('end_date', now()->endOfMonth()->toDateString());
        $status    = $request->input('status', '');

        $query = Reservation::with(['user', 'room'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        if ($status) {
            $query->where('status', $status);
        }

        $reservations = $query->latest()->get();

        // Summary
        $all = Reservation::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        $summary = [
            'total'     => (clone $all)->count(),
            'confirmed' => (clone $all)->where('status', 'confirmed')->count(),
            'completed' => (clone $all)->where('status', 'completed')->count(),
            'pending'   => (clone $all)->where('status', 'pending')->count(),
            'cancelled' => (clone $all)->where('status', 'cancelled')->count(),
            'paid'      => (clone $all)->whereNotNull('paid_at')->count(),
            'revenue'   => (clone $all)->whereIn('status', ['confirmed', 'completed'])->sum('total_price'),
        ];

        return view('admin.reports', compact('reservations', 'summary', 'startDate', 'endDate'));
    }

    /**
     * Admin: Export laporan sebagai PDF (browser print).
     */
    public function exportReports(Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate   = $request->input('end_date', now()->endOfMonth()->toDateString());
        $status    = $request->input('status', '');

        $query = Reservation::with(['user', 'room'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

        if ($status) {
            $query->where('status', $status);
        }

        $reservations = $query->latest()->get();

        $all = Reservation::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        $summary = [
            'total'     => (clone $all)->count(),
            'confirmed' => (clone $all)->where('status', 'confirmed')->count(),
            'completed' => (clone $all)->where('status', 'completed')->count(),
            'pending'   => (clone $all)->where('status', 'pending')->count(),
            'cancelled' => (clone $all)->where('status', 'cancelled')->count(),
            'paid'      => (clone $all)->whereNotNull('paid_at')->count(),
            'revenue'   => (clone $all)->whereIn('status', ['confirmed', 'completed'])->sum('total_price'),
        ];

        return view('admin.reports_pdf', compact('reservations', 'summary', 'startDate', 'endDate'));
    }

    /**
     * Admin: Users list.
     */
    public function users()
    {
        $users = User::where('role', 'tamu')
            ->withCount('reservations')
            ->latest()
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * Admin: Testimonials management.
     */
    public function testimonials()
    {
        $testimonials = Testimonial::with(['user', 'reservation.room'])->latest()->paginate(20);
        return view('admin.testimonials', compact('testimonials'));
    }

    /**
     * Admin: Approve/reject testimonial.
     */
    public function toggleTestimonial(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => !$testimonial->is_approved]);
        return back()->with('success', 'Status ulasan berhasil diperbarui.');
    }

    /**
     * Admin: Calendar view for room availability.
     */
    public function calendar()
    {
        Reservation::releaseExpiredReservations();

        $rooms = Room::where('is_active', true)->get();

        $reservations = Reservation::with(['room', 'user'])
            ->whereNotIn('status', ['cancelled'])
            ->where('check_out', '>=', now())
            ->where('check_in', '<=', now()->addDays(90))
            ->get()
            ->map(function ($r) {
                return [
                    'id'        => $r->id,
                    'title'     => "{$r->room->name} — {$r->guest_name}",
                    'start'     => $r->check_in->toDateString(),
                    'end'       => $r->check_out->toDateString(),
                    'color'     => match($r->status) {
                        'pending'   => '#D97706',
                        'confirmed' => '#2563EB',
                        'completed' => '#059669',
                        default     => '#6B7280',
                    },
                    'url'       => route('admin.reservations.show', $r->id),
                    'extendedProps' => [
                        'status' => $r->status,
                        'room'   => $r->room->name,
                    ],
                ];
            });

        return view('admin.calendar', compact('rooms', 'reservations'));
    }
}

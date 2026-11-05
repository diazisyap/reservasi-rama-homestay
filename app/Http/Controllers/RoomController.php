<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Admin: List all rooms with stats.
     */
    public function index()
    {
        $rooms = Room::withCount(['reservations as active_bookings' => function ($q) {
            $q->whereNotIn('status', ['cancelled', 'completed']);
        }])->latest()->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Admin: Show create form.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Admin: Store new room.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'type'         => 'required|in:standard,deluxe,suite,villa,family',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'tax_rate'     => 'required|numeric|min:0|max:100',
            'service_rate' => 'required|numeric|min:0|max:100',
            'total_rooms'  => 'required|integer|min:1',
            'capacity'     => 'required|integer|min:1',
            'facilities'   => 'nullable|array',
            'facilities.*' => 'string',
            'image'        => 'nullable|image|max:4096',
            'is_active'    => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['facilities'] = $request->input('facilities', []);

        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    /**
     * Admin: Show edit form.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Admin: Update room.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'type'         => 'required|in:standard,deluxe,suite,villa,family',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'tax_rate'     => 'required|numeric|min:0|max:100',
            'service_rate' => 'required|numeric|min:0|max:100',
            'total_rooms'  => 'required|integer|min:1',
            'capacity'     => 'required|integer|min:1',
            'facilities'   => 'nullable|array',
            'facilities.*' => 'string',
            'image'        => 'nullable|image|max:4096',
            'is_active'    => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['facilities'] = $request->input('facilities', []);

        $room->update($validated);

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    /**
     * Admin: Delete room.
     */
    public function destroy(Room $room)
    {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus.');
    }

    /**
     * Public: Show rooms listing with filters.
     */
    public function indexClient(Request $request)
    {
        $query = Room::where('is_active', true)
            ->whereNotIn('name', ['Kamar 7', 'Kamar 8', 'Kamar 9', 'Kamar 10']);

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by max price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by facility
        if ($request->filled('facility')) {
            $query->whereJsonContains('facilities', $request->facility);
        }

        // Filter by capacity (guests)
        if ($request->filled('guests')) {
            $query->where('capacity', '>=', $request->guests);
        }

        // Filter by availability dates
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn  = $request->check_in;
            $checkOut = $request->check_out;

            \App\Models\Reservation::releaseExpiredReservations();

            $query->where(function ($q) use ($checkIn, $checkOut) {
                $q->whereRaw('total_rooms > (
                    SELECT COUNT(*) FROM reservations
                    WHERE reservations.room_id = rooms.id
                    AND reservations.status NOT IN (\'cancelled\', \'completed\')
                    AND (reservations.status != \'pending\' OR reservations.expires_at IS NULL OR reservations.expires_at > NOW())
                    AND reservations.check_in < ?
                    AND reservations.check_out > ?
                )', [$checkOut, $checkIn]);
            });
        }

        $rooms = $query->orderBy('price')->get();

        $checkIn  = $request->check_in ?? null;
        $checkOut = $request->check_out ?? null;
        $guests   = $request->guests ?? 1;

        return view('rooms.index', compact('rooms', 'checkIn', 'checkOut', 'guests'));
    }

    /**
     * Public: Show single room detail.
     */
    public function show(Room $room)
    {
        if (!$room->is_active || in_array($room->name, ['Kamar 7', 'Kamar 8', 'Kamar 9', 'Kamar 10'])) {
            abort(404);
        }

        // Get similar rooms (same type, excluding current)
        $similarRooms = Room::where('is_active', true)
            ->where('id', '!=', $room->id)
            ->where('type', $room->type)
            ->take(3)
            ->get();

        $bookedDatesList = $room->getBookedDatesList();
        $bookedRangesHuman = $room->getBookedDateRangesHuman();

        return view('rooms.show', compact('room', 'similarRooms', 'bookedDatesList', 'bookedRangesHuman'));
    }
}

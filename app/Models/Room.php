<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Room extends Model
{
    protected $fillable = [
        'name', 'type', 'description', 'price', 'tax_rate', 'service_rate',
        'total_rooms', 'capacity', 'facilities', 'image', 'gallery', 'is_active'
    ];

    protected $casts = [
        'facilities' => 'array',
        'gallery' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'tax_rate' => 'decimal:2',
        'service_rate' => 'decimal:2',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get available room count for a given date range (anti-double booking).
     */
    public function getAvailableCount(string $checkIn, string $checkOut): int
    {
        // Auto-release any pending reservations that passed their payment deadline
        \App\Models\Reservation::releaseExpiredReservations();

        $bookedCount = $this->reservations()
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->where(function ($q) {
                // Ignore pending reservations that have already expired
                $q->where('status', '!=', 'pending')
                  ->orWhereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in', '<', $checkOut)
                      ->where('check_out', '>', $checkIn);
            })
            ->count();

        return max(0, $this->total_rooms - $bookedCount);
    }

    /**
     * Check if the room is available for the given date range.
     */
    public function isAvailable(string $checkIn, string $checkOut): bool
    {
        return $this->getAvailableCount($checkIn, $checkOut) > 0;
    }

    /**
     * Get active reservations that occupy room inventory.
     */
    public function getActiveReservations()
    {
        \App\Models\Reservation::releaseExpiredReservations();

        return $this->reservations()
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->where(function ($q) {
                $q->where('status', '!=', 'pending')
                  ->orWhereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })
            ->where('check_out', '>=', now()->toDateString())
            ->orderBy('check_in')
            ->get();
    }

    /**
     * Get all dates (YYYY-MM-DD) that are fully booked for this room.
     */
    public function getBookedDatesList(): array
    {
        $reservations = $this->getActiveReservations();
        $dateCounts = [];

        foreach ($reservations as $res) {
            $start = \Carbon\Carbon::parse($res->check_in);
            $end   = \Carbon\Carbon::parse($res->check_out);
            $curr  = $start->copy();
            while ($curr->lt($end)) {
                $d = $curr->toDateString();
                $dateCounts[$d] = ($dateCounts[$d] ?? 0) + 1;
                $curr->addDay();
            }
        }

        $booked = [];
        foreach ($dateCounts as $date => $count) {
            if ($count >= $this->total_rooms) {
                $booked[] = $date;
            }
        }

        sort($booked);
        return $booked;
    }

    /**
     * Get human-readable booked ranges for display notes.
     */
    public function getBookedDateRangesHuman(): array
    {
        $reservations = $this->getActiveReservations();
        $ranges = [];

        foreach ($reservations as $res) {
            $ci = \Carbon\Carbon::parse($res->check_in)->translatedFormat('d M Y');
            $co = \Carbon\Carbon::parse($res->check_out)->translatedFormat('d M Y');
            $statusLabel = match($res->status) {
                'confirmed' => 'Terkonfirmasi',
                'completed' => 'Selesai',
                'pending'   => 'Menunggu Pembayaran',
                default     => ucfirst($res->status),
            };

            $ranges[] = [
                'check_in'     => $res->check_in->toDateString(),
                'check_out'    => $res->check_out->toDateString(),
                'formatted'    => "{$ci} s/d {$co}",
                'status'       => $res->status,
                'status_label' => $statusLabel,
            ];
        }

        return $ranges;
    }

    /**
     * Get Flatpickr-compatible disable ranges.
     */
    public function getFlatpickrBookedRanges(): array
    {
        $bookedDates = $this->getBookedDatesList();
        if (empty($bookedDates)) {
            return [];
        }

        // Group contiguous dates into {from, to} objects
        $ranges = [];
        $rangeStart = null;
        $prevDate = null;

        foreach ($bookedDates as $dateStr) {
            $curr = \Carbon\Carbon::parse($dateStr);
            if ($rangeStart === null) {
                $rangeStart = $curr;
                $prevDate = $curr;
            } else {
                if ($curr->diffInDays($prevDate) == 1) {
                    $prevDate = $curr;
                } else {
                    $ranges[] = [
                        'from' => $rangeStart->toDateString(),
                        'to'   => $prevDate->toDateString(),
                    ];
                    $rangeStart = $curr;
                    $prevDate = $curr;
                }
            }
        }

        if ($rangeStart !== null && $prevDate !== null) {
            $ranges[] = [
                'from' => $rangeStart->toDateString(),
                'to'   => $prevDate->toDateString(),
            ];
        }

        return $ranges;
    }

    /**
     * Calculate tax amount.
     */
    public function calculateTax(float $basePrice): float
    {
        return 0.0;
    }

    /**
     * Calculate service charge.
     */
    public function calculateService(float $basePrice): float
    {
        return 0.0;
    }

    /**
     * Get all facilities as array with labels.
     */
    public function getFacilitiesListAttribute(): array
    {
        $map = [
            'wifi'      => ['icon' => 'wifi', 'label' => 'Wi-Fi Gratis'],
            'ac'        => ['icon' => 'wind', 'label' => 'AC'],
            'pool'      => ['icon' => 'waves', 'label' => 'Kolam Renang'],
            'tv'        => ['icon' => 'tv', 'label' => 'Smart TV'],
            'kitchen'   => ['icon' => 'utensils', 'label' => 'Dapur'],
            'parking'   => ['icon' => 'car', 'label' => 'Parkir Gratis'],
            'breakfast' => ['icon' => 'coffee', 'label' => 'Sarapan'],
            'bathtub'   => ['icon' => 'bath', 'label' => 'Bathtub'],
            'balcony'   => ['icon' => 'sunset', 'label' => 'Balkon'],
            'garden'    => ['icon' => 'trees', 'label' => 'Taman'],
        ];

        $list = [];
        foreach ((array) $this->facilities as $key) {
            if (isset($map[$key])) {
                $list[$key] = $map[$key];
            }
        }
        return $list;
    }

    /**
     * Get type label.
     */
    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'standard' => 'Standard',
            'deluxe'   => 'Deluxe',
            'suite'    => 'Suite',
            'villa'    => 'Villa',
            'family'   => 'Family Room',
            default    => ucfirst($this->type),
        };
    }
}

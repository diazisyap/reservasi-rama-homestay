<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Reservation extends Model
{
    protected $fillable = [
        'booking_code',
        'user_id',
        'room_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'check_in',
        'check_out',
        'nights',
        'guest_count',
        'base_price',
        'tax_amount',
        'service_amount',
        'total_price',
        'payment_method',
        'snap_token',
        'midtrans_transaction_id',
        'midtrans_payment_type',
        'status',
        'special_requests',
        'paid_at',
        'expires_at',
        'cancelled_at',
        'refund_note',
    ];

    protected $casts = [
        'check_in'      => 'date',
        'check_out'     => 'date',
        'paid_at'       => 'datetime',
        'expires_at'    => 'datetime',
        'cancelled_at'  => 'datetime',
        'base_price'    => 'decimal:2',
        'tax_amount'    => 'decimal:2',
        'service_amount' => 'decimal:2',
        'total_price'   => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (Reservation $reservation) {
            if (empty($reservation->booking_code)) {
                $reservation->booking_code = 'RMA-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Release/cancel all expired pending reservations and complete past confirmed reservations
     * so rooms become available again for other guests.
     */
    public static function releaseExpiredReservations(): int
    {
        // Auto-complete confirmed reservations whose check-out date has passed
        static::where('status', 'confirmed')
            ->whereDate('check_out', '<=', now()->toDateString())
            ->update(['status' => 'completed']);

        return static::where('status', 'pending')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now())
            ->update(['status' => 'cancelled']);
    }

    /**
     * Check if reservation payment has expired.
     */
    public function isExpired(): bool
    {
        return $this->status === 'pending' && $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Get remaining seconds until payment expires (0 if expired).
     */
    public function getRemainingSecondsAttribute(): int
    {
        if ($this->status !== 'pending' || !$this->expires_at) {
            return 0;
        }
        return max(0, now()->diffInSeconds($this->expires_at, false));
    }

    /**
     * Check if the reservation can be cancelled by the guest.
     * Rule: Maximum 24 hours after reservation creation, and not already completed or cancelled.
     */
    public function canCancel(): bool
    {
        if (in_array($this->status, ['cancelled', 'completed'])) {
            return false;
        }

        // Must be within 24 hours of reservation creation
        $createdAt = $this->created_at ? $this->created_at->copy() : now();
        $deadline = $createdAt->addHours(24);
        if (now()->greaterThan($deadline)) {
            return false;
        }

        // Also check-in must not have passed
        if (\Carbon\Carbon::parse($this->check_in)->isPast() && !\Carbon\Carbon::parse($this->check_in)->isToday()) {
            return false;
        }

        return true;
    }

    /**
     * Get the cancellation deadline (24 hours after creation).
     */
    public function getCancellationDeadlineAttribute(): \Carbon\Carbon
    {
        $createdAt = $this->created_at ? $this->created_at->copy() : now();
        return $createdAt->addHours(24);
    }

    /**
     * Human readable remaining time for cancellation.
     */
    public function getCancelTimeRemainingAttribute(): string
    {
        $deadline = $this->cancellation_deadline;
        if (now()->greaterThan($deadline)) {
            return 'Batas waktu 24 jam telah berakhir';
        }

        $diffMinutes = now()->diffInMinutes($deadline);
        $hours = floor($diffMinutes / 60);
        $mins = $diffMinutes % 60;

        if ($hours > 0) {
            return "{$hours} jam {$mins} menit";
        }
        return "{$mins} menit";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }

    /**
     * Get the status label in Indonesian.
     */
    public function getStatusLabelAttribute(): string
    {
        if ($this->status === 'cancelled' && $this->expires_at && $this->expires_at->isPast() && !$this->paid_at) {
            return 'Kedaluwarsa';
        }

        return match ($this->status) {
            'pending'   => 'Menunggu Pembayaran',
            'confirmed' => 'Terkonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default     => ucfirst($this->status),
        };
    }

    /**
     * Get status badge CSS class.
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'pending'   => 'badge-pending',
            'confirmed' => 'badge-confirmed',
            'completed' => 'badge-completed',
            'cancelled' => 'badge-cancelled',
            default     => 'badge-pending',
        };
    }

    /**
     * Scope to filter by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Get duration of stay in nights.
     */
    public function getDurationAttribute(): int
    {
        if ($this->check_in && $this->check_out) {
            return $this->check_in->diffInDays($this->check_out);
        }
        return $this->nights ?? 0;
    }
}

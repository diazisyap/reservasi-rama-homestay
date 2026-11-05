<?php

namespace App\Services;

use App\Models\Reservation;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        $this->configure();
    }

    /**
     * Configure Midtrans settings.
     */
    protected function configure(): void
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = (bool) config('midtrans.is_production', false);
        Config::$isSanitized = (bool) config('midtrans.is_sanitized', true);
        Config::$is3ds = (bool) config('midtrans.is_3ds', true);
    }

    /**
     * Create or retrieve Snap Token for a reservation.
     */
    public function createSnapToken(Reservation $reservation, bool $force = false): string
    {
        $this->configure();

        // If reservation already has a valid snap token and not forcing regeneration, return it
        if (!$force && !empty($reservation->snap_token)) {
            return $reservation->snap_token;
        }

        // Ensure booking code exists
        if (empty($reservation->booking_code)) {
            $reservation->booking_code = 'RMA-' . strtoupper(\Illuminate\Support\Str::random(8));
            $reservation->save();
        }

        $roomName = $reservation->room ? $reservation->room->name : 'Rama Homestay';
        $payMethod = strtolower($reservation->payment_method ?? '');
        $isCashCod = str_contains($payMethod, 'cash') || str_contains($payMethod, 'tempat') || str_contains($payMethod, 'cod');

        // Resolve guest details from relationship or reservation fields
        $user       = $reservation->user;
        $guestName  = $user?->name  ?? $reservation->guest_name  ?? 'Tamu';
        $guestEmail = $user?->email ?? $reservation->guest_email ?? 'tamu@ramahomestay.com';
        $guestPhone = $user?->phone ?? $reservation->guest_phone ?? '08000000000';

        if ($isCashCod) {
            // Khusus COD/Cash di tempat dikenakan DP 50%
            $grossAmount = (int) round($reservation->total_price * 0.5);
            $orderId = $reservation->booking_code . '-DP';
            $itemName = mb_substr('DP 50% Reservasi - ' . $roomName, 0, 50);
        } else {
            // Pembayaran Midtrans langsung lunas 100% penuh (tidak perlu DP)
            $grossAmount = (int) round($reservation->total_price);
            $orderId = $reservation->booking_code;
            $itemName = mb_substr('Pelunasan Reservasi - ' . $roomName, 0, 50);
        }

        if ($grossAmount <= 0) {
            $grossAmount = (int) round($reservation->room ? $reservation->room->price : 100000);
        }

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $guestName,
                'email'      => $guestEmail,
                'phone'      => $guestPhone,
            ],
            'item_details' => [
                [
                    'id'       => 'DP-' . $reservation->id,
                    'price'    => $grossAmount,
                    'quantity' => 1,
                    'name'     => $itemName,
                ]
            ],
            'expiry' => [
                'start_time' => now()->format('Y-m-d H:i:s O'),
                'unit'       => 'minute',
                'duration'   => max(1, (int) ceil(now()->diffInSeconds($reservation->expires_at ?: now()->addMinutes(30), false) / 60)),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $reservation->update(['snap_token' => $snapToken]);
            return $snapToken;
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Token Error: ' . $e->getMessage(), [
                'reservation_id' => $reservation->id,
                'booking_code'   => $reservation->booking_code,
            ]);
            throw $e;
        }
    }

    /**
     * Query latest status directly from Midtrans API by order_id / booking_code.
     */
    public function checkStatus(string $orderId)
    {
        $this->configure();

        // Cek order ID utama (misal RMA-XXXXXXXX-DP atau RMA-XXXXXXXX)
        try {
            return Transaction::status($orderId);
        } catch (\Exception $e) {
            // Jika belum ada akhiran -DP, coba dengan -DP
            if (!str_ends_with($orderId, '-DP')) {
                try {
                    return Transaction::status($orderId . '-DP');
                } catch (\Exception $e2) {
                    // Abaikan fallback kedua jika gagal
                }
            } else {
                // Sebaliknya jika berakhiran -DP, coba tanpa -DP
                $stripped = preg_replace('/-DP$/', '', $orderId);
                try {
                    return Transaction::status($stripped);
                } catch (\Exception $e3) {
                    // Abaikan fallback jika gagal
                }
            }

            Log::warning('Midtrans Check Status Warning: ' . $e->getMessage(), [
                'order_id' => $orderId,
            ]);
            return null;
        }
    }

    /**
     * Handle incoming webhook notification payload.
     * Returns true if verified and processed, false otherwise.
     */
    public function handleNotification(array $payload): bool
    {
        $this->configure();

        $orderId      = $payload['order_id'] ?? null;
        $statusCode   = $payload['status_code'] ?? null;
        $grossAmount  = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $serverKey    = config('midtrans.server_key');

        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            Log::warning('Midtrans Webhook: Incomplete payload', $payload);
            return false;
        }

        // Verify SHA512 signature
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        if ($signatureKey !== $expectedSignature) {
            Log::error('Midtrans Webhook: Signature mismatch', [
                'expected' => $expectedSignature,
                'received' => $signatureKey,
            ]);
            return false;
        }

        $cleanOrderId = preg_replace('/-DP$/', '', $orderId);
        $reservation = Reservation::where('booking_code', $cleanOrderId)
            ->orWhere('booking_code', $orderId)
            ->first();
        if (!$reservation) {
            Log::error('Midtrans Webhook: Reservation not found for booking_code ' . $orderId);
            return false;
        }

        $transactionStatus = $payload['transaction_status'] ?? '';
        $fraudStatus       = $payload['fraud_status'] ?? '';
        $paymentType       = $payload['payment_type'] ?? '';
        $transactionId     = $payload['transaction_id'] ?? null;

        $this->applyPaymentStatus($reservation, $transactionStatus, $fraudStatus, $paymentType, $transactionId);

        return true;
    }

    /**
     * Apply transaction status to reservation model.
     */
    public function applyPaymentStatus(
        Reservation $reservation,
        string $transactionStatus,
        string $fraudStatus = '',
        string $paymentType = '',
        ?string $transactionId = null
    ): void {
        $updateData = [
            'midtrans_transaction_id' => $transactionId ?: $reservation->midtrans_transaction_id,
            'midtrans_payment_type'   => $paymentType ?: $reservation->midtrans_payment_type,
        ];

        if ($transactionStatus === 'capture') {
            if ($fraudStatus === 'challenge') {
                $updateData['status'] = 'pending';
            } elseif ($fraudStatus === 'accept') {
                $updateData['status']  = 'confirmed';
                $updateData['paid_at'] = now();
            }
        } elseif ($transactionStatus === 'settlement') {
            $updateData['status']  = 'confirmed';
            $updateData['paid_at'] = now();
        } elseif ($transactionStatus === 'pending') {
            $updateData['status'] = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $updateData['status'] = 'cancelled';
        }

        $reservation->update($updateData);

        Log::info("Midtrans: Updated reservation #{$reservation->id} status to {$reservation->status}", [
            'booking_code'       => $reservation->booking_code,
            'transaction_status' => $transactionStatus,
            'payment_type'       => $paymentType,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    protected MidtransService $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Webhook notification handler from Midtrans server.
     */
    public function notification(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook Received: ', $payload);

        $processed = $this->midtransService->handleNotification($payload);

        if ($processed) {
            return response()->json(['status' => 'success', 'message' => 'Notification processed successfully'], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid notification or signature'], 400);
    }

    /**
     * Midtrans Finish Redirect URL (GET).
     */
    public function finish(Request $request)
    {
        $orderId = $request->query('order_id');
        $transactionStatus = $request->query('transaction_status');

        if ($orderId) {
            $cleanOrderId = preg_replace('/-DP$/', '', $orderId);
            $reservation = Reservation::where('booking_code', $cleanOrderId)
                ->orWhere('booking_code', $orderId)
                ->first();
            if ($reservation) {
                // If local development or instant redirect, check status from Midtrans
                $statusResponse = $this->midtransService->checkStatus($orderId);
                if ($statusResponse) {
                    $this->midtransService->applyPaymentStatus(
                        $reservation,
                        $statusResponse->transaction_status ?? $transactionStatus ?? 'settlement',
                        $statusResponse->fraud_status ?? '',
                        $statusResponse->payment_type ?? '',
                        $statusResponse->transaction_id ?? null
                    );
                } elseif ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $reservation->update([
                        'status'  => 'confirmed',
                        'paid_at' => now(),
                    ]);
                }

                // Prepare session for booking success view
                session([
                    'last_booking' => [
                        'id'             => $reservation->id,
                        'booking_code'   => $reservation->booking_code,
                        'room_name'      => $reservation->room->name,
                        'room_type'      => $reservation->room->type_label ?? 'Homestay Room',
                        'room_image'     => $reservation->room->image,
                        'check_in'       => $reservation->check_in,
                        'check_out'      => $reservation->check_out,
                        'nights'         => $reservation->nights,
                        'base_price'     => $reservation->base_price,
                        'tax_amount'     => $reservation->tax_amount,
                        'service_amount' => $reservation->service_amount,
                        'total_price'    => $reservation->total_price,
                        'guest_name'     => $reservation->guest_name,
                        'guest_email'    => $reservation->guest_email,
                        'guest_phone'    => $reservation->guest_phone,
                        'payment_method' => $reservation->payment_method ?? 'Midtrans Payment Gateway',
                        'snap_token'     => $reservation->snap_token,
                        'status'         => $reservation->status,
                        'special_requests' => $reservation->special_requests ?? '',
                    ]
                ]);

                return redirect()->route('tamu.booking.success')
                    ->with('success', 'Pembayaran berhasil dikonfirmasi! Terima kasih atas reservasi Anda.');
            }
        }

        return redirect()->route('tamu.dashboard')
            ->with('success', 'Pembayaran Anda berhasil diproses.');
    }

    /**
     * Midtrans Unfinish Redirect URL (GET).
     */
    public function unfinish(Request $request)
    {
        return redirect()->route('tamu.dashboard')
            ->with('info', 'Pembayaran belum diselesaikan. Anda dapat melanjutkan pembayaran melalui tombol Bayar di Dashboard Reservasi.');
    }

    /**
     * Midtrans Error Redirect URL (GET).
     */
    public function error(Request $request)
    {
        return redirect()->route('tamu.dashboard')
            ->with('error', 'Terjadi kesalahan saat memproses pembayaran. Silakan coba kembali.');
    }

    /**
     * AJAX: Get or refresh snap token for a reservation.
     */
    public function getToken(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $token = $this->midtransService->createSnapToken($reservation);
            return response()->json([
                'token'        => $token,
                'booking_code' => $reservation->booking_code,
                'total_price'  => $reservation->total_price,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat token pembayaran: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Dedicated Payment Page for guest reservation.
     */
    public function payPage(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403);
        }

        // Check if reservation is expired
        if ($reservation->isExpired()) {
            $reservation->update(['status' => 'cancelled']);
            return redirect()->route('tamu.dashboard')
                ->with('error', 'Batas waktu pembayaran (30 menit) telah habis. Reservasi dibatalkan dan kamar telah dilepaskan untuk tamu lain.');
        }

        if ($reservation->status === 'cancelled') {
            return redirect()->route('tamu.dashboard')
                ->with('error', 'Reservasi ini telah dibatalkan.');
        }

        if ($reservation->status === 'confirmed') {
            return redirect()->route('tamu.dashboard')
                ->with('success', 'Reservasi ini sudah terbayar dan terkonfirmasi.');
        }

        $snapToken = $reservation->snap_token;
        if (empty($snapToken) && $reservation->status === 'pending') {
            try {
                $snapToken = $this->midtransService->createSnapToken($reservation);
            } catch (\Exception $e) {
                // Keep token null, view handles error
            }
        }

        return view('tamu.pay', compact('reservation', 'snapToken'));
    }

    /**
     * AJAX/Web: Sync reservation payment status directly from Midtrans API or JS callback.
     */
    public function syncStatus(Request $request, Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id() && !Auth::user()->is_admin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // If client sends instant result from Snap JS callback
        $clientStatus = $request->input('transaction_status');
        $transactionId = $request->input('transaction_id');
        $paymentType = $request->input('payment_type');

        if ($clientStatus === 'settlement' || $clientStatus === 'capture') {
            $reservation->update([
                'status'                  => 'confirmed',
                'paid_at'                 => now(),
                'midtrans_transaction_id' => $transactionId ?: $reservation->midtrans_transaction_id,
                'midtrans_payment_type'   => $paymentType ?: $reservation->midtrans_payment_type,
            ]);

            return response()->json([
                'success'      => true,
                'status'       => $reservation->status,
                'status_label' => $reservation->status_label,
                'message'      => 'Pembayaran berhasil dikonfirmasi!',
            ]);
        }

        // Query Midtrans API directly
        $statusResponse = $this->midtransService->checkStatus($reservation->booking_code);

        if ($statusResponse) {
            $this->midtransService->applyPaymentStatus(
                $reservation,
                $statusResponse->transaction_status ?? 'pending',
                $statusResponse->fraud_status ?? '',
                $statusResponse->payment_type ?? '',
                $statusResponse->transaction_id ?? null
            );

            return response()->json([
                'success'      => true,
                'status'       => $reservation->status,
                'status_label' => $reservation->status_label,
                'message'      => 'Status pembayaran berhasil disinkronkan.',
            ]);
        }

        return response()->json([
            'success'      => false,
            'status'       => $reservation->status,
            'status_label' => $reservation->status_label,
            'message'      => 'Status masih belum berubah.',
        ]);
    }
}

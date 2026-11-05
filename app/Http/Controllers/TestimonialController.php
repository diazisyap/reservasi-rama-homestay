<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    /**
     * Guest: Submit a review after checkout.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'nullable|exists:reservations,id',
            'guest_name'     => 'nullable|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'review'         => 'required|string|min:5|max:500',
            'guest_origin'   => 'nullable|string|max:100',
        ]);

        Testimonial::create([
            'user_id'        => Auth::id(),
            'reservation_id' => $validated['reservation_id'] ?? null,
            'guest_name'     => !empty($validated['guest_name']) ? $validated['guest_name'] : Auth::user()->name,
            'guest_origin'   => $validated['guest_origin'] ?? null,
            'rating'         => $validated['rating'],
            'review'         => $validated['review'],
            'is_approved'    => true,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim dan telah ditampilkan.');
    }
}

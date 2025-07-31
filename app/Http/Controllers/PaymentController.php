<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
    /**
     * Tampilkan halaman pemilihan metode pembayaran.
     */
    public function chooseMethod(Booking $booking)
    {
        // Validasi user pemilik booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('bookings.payment-method', compact('booking'));
    }

    /**
     * Proses pembayaran booking.
     */
    public function pay(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $booking->status = 'paid';
        $booking->payment_method = $request->payment_method;
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Pembayaran berhasil!');
    }
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
   public function pay($bookingId)
{
    $booking = Booking::where('id', $bookingId)
                ->where('user_id', auth()->id())
                ->firstOrFail();

    $booking->update(['status' => 'paid']);

    return redirect()->route('bookings.show', $booking->id)->with('success', 'Pembayaran berhasil!');
}
}

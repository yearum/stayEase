<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room.hotel')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function create($hotelId)
    {
        $hotel = Hotel::with('rooms')->findOrFail($hotelId);
        return view('bookings.create', compact('hotel'));
    }

    /**
     * Menyimpan data booking baru dengan pilihan short time, transit, atau harian
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'duration_type' => 'required|in:short_3h,short_6h,short_12h,transit,daily',
            'payment_method' => 'nullable|string'
        ]);

        $checkIn = Carbon::now();

        switch ($request->duration_type) {
            case 'short_3h':
                $checkOut = $checkIn->copy()->addHours(3);
                break;
            case 'short_6h':
                $checkOut = $checkIn->copy()->addHours(6);
                break;
            case 'short_12h':
                $checkOut = $checkIn->copy()->addHours(12);
                break;
            case 'transit':
                $checkOut = $checkIn->copy()->addHours(8);
                break;
            case 'daily':
                $checkOut = $checkIn->copy()->addDay();
                break;
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'duration_type' => $request->duration_type,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_price' => $this->calculatePrice($request->room_id, $request->duration_type),
            'status' => 'pending',
            'payment_method' => $request->payment_method
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking berhasil dibuat!');
    }

    private function calculatePrice($roomId, $durationType)
    {
        $room = Room::findOrFail($roomId);

        switch ($durationType) {
            case 'short_3h':
                return $room->price_3h ?? ($room->price_daily / 8);
            case 'short_6h':
                return $room->price_6h ?? ($room->price_daily / 4);
            case 'short_12h':
                return $room->price_12h ?? ($room->price_daily / 2);
            case 'transit':
                return $room->price_transit ?? ($room->price_daily / 3);
            case 'daily':
                return $room->price_daily;
        }
    }

    public function show($id)
    {
        $booking = Booking::with('room.hotel')->findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'payment_method' => 'required|in:transfer,cod',
        ]);

        $days = now()->parse($request->checkin)->diffInDays(now()->parse($request->checkout));
        $total = $days * $booking->room->price;

        $booking->update([
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'total' => $total,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan!');
    }
}

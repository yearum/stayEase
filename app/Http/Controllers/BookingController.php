<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Menampilkan halaman daftar booking (jika diperlukan).
     */
    public function index()
    {
        $bookings = Booking::with('room.hotel')->where('user_id', auth()->id())->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan form pemesanan hotel.
     */
    public function create($hotelId)
    {
        $hotel = Hotel::with('rooms')->findOrFail($hotelId);
        return view('bookings.create', compact('hotel'));
    }

    /**
     * Menyimpan data booking baru.
     */
    public function store(Request $request, $hotelId)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ]);

        $room = Room::findOrFail($request->room_id);
        $days = now()->parse($request->checkin)->diffInDays(now()->parse($request->checkout));

        $total = $days * $room->price;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'total' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Menampilkan detail booking.
     */
    public function show($id)
    {
        $booking = Booking::with('room.hotel')->findOrFail($id);

        // Pastikan user hanya melihat booking miliknya
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }

    /**
     * Menampilkan form edit booking (opsional).
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('bookings.edit', compact('booking'));
    }

    /**
     * Mengupdate data booking (opsional).
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
        ]);

        $days = now()->parse($request->checkin)->diffInDays(now()->parse($request->checkout));
        $total = $days * $booking->room->price;

        $booking->update([
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'total' => $total,
        ]);

        return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Menghapus booking.
     */
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

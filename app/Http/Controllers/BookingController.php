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

    /**
     * Menampilkan form booking berdasarkan pilihan durasi dari dropdown
     */
    public function create(Room $room, $duration)
    {
        $validDurations = ['short_3h', 'short_6h', 'short_12h', 'transit', 'daily'];
        if (!in_array($duration, $validDurations)) {
            abort(404);
        }

        $price = $this->calculatePrice($room->id, $duration);

        return view('bookings.create', compact('room', 'duration', 'price'));
    }

    /**
     * Menyimpan data booking baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'duration' => 'required|in:short_3h,short_6h,short_12h,transit,daily',
            'price' => 'required|numeric|min:1',
            'payment_method' => 'required|in:transfer,cod',
        ]);

        $validDurations = ['short_3h', 'short_6h', 'short_12h', 'transit', 'daily'];
        if (!in_array($request->duration, $validDurations)) {
            abort(400, 'Durasi tidak valid');
        }

        if ($request->price <= 0) {
            return back()->withErrors(['price' => 'Harga tidak valid atau belum tersedia']);
        }

        $checkIn = Carbon::now();

        switch ($request->duration) {
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
            'duration_type' => $request->duration,
            'checkin' => $checkIn,
            'checkout' => $checkOut,
            'total' => $request->price,
            'status' => 'sucsess',
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Menampilkan detail booking
     */
    public function show($id)
    {
        $booking = Booking::with('room.hotel')->findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('bookings.show', compact('booking'));
    }

    /**
     * Menampilkan form edit booking
     */
    public function edit($id)
    {
        $booking = Booking::with('room.hotel')->findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking tidak bisa diubah karena sudah diproses.');
        }

        return view('bookings.edit', compact('booking'));
    }

    /**
     * Memperbarui data booking
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::with('room.hotel')->findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking tidak bisa diubah karena sudah diproses.');
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
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking berhasil diperbarui!');
    }

    /**
     * Menghapus booking
     */
    public function destroy($id)
    {
        $booking = Booking::with('room.hotel')->findOrFail($id);

        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking tidak bisa dibatalkan karena sudah diproses.');
        }

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibatalkan!');
    }

    /**
     * Menghitung harga berdasarkan durasi
     */
    private function calculatePrice($roomId, $durationType)
    {
        $room = Room::findOrFail($roomId);

        return match ($durationType) {
            'short_3h' => $room->price_3h ?? ($room->price_daily / 8),
            'short_6h' => $room->price_6h ?? ($room->price_daily / 4),
            'short_12h' => $room->price_12h ?? ($room->price_daily / 2),
            'transit' => $room->price_transit ?? ($room->price_daily / 3),
            'daily' => $room->price_daily,
            default => 0,
        };
    }
}

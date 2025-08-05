<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;

class HotelController extends Controller
{
    // ✅ Tampilkan semua hotel
    public function index()
    {
        $hotels = Hotel::with('rooms')->latest()->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    // ✅ Tampilkan form tambah hotel
    public function create()
    {
        return view('admin.hotels.create');
    }

    // ✅ Simpan hotel baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Hotel::create($request->only(['name', 'location', 'description']));

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil ditambahkan.');
    }

    // ✅ Tampilkan form edit hotel
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    // ✅ Simpan perubahan
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $hotel->update($request->only(['name', 'location', 'description']));

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil diperbarui.');
    }

    // ✅ Hapus hotel
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel berhasil dihapus.');
    }

    // ✅ Tampilkan daftar kamar untuk kelola ketersediaan
    public function manageRooms(Hotel $hotel)
{
    $rooms = $hotel->rooms; // Ambil relasi rooms
    return view('admin.hotels.rooms', compact('hotel', 'rooms'));
}

    // ✅ Ubah status ketersediaan kamar (toggle available / not available)
    public function toggleRoomAvailability(Room $room)
{
    $room->is_available = !$room->is_available;
    $room->save();

    return back()->with('success', 'Status kamar berhasil diperbarui.');
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    // Menampilkan semua hotel
    public function index()
    {
        $hotels = Hotel::with('photos')->get();
// ← ambil gambar via relasi
        return view('hotels.index', compact('hotels'));
    }

    // Menampilkan detail hotel
    public function show($id)
    {
        $hotel = Hotel::with(['rooms', 'photos'])->findOrFail($id); // ← ambil rooms & photos
        return view('hotels.show', compact('hotel'));
    }

    // Menampilkan form booking hotel
    public function book($id)
    {
        $hotel = Hotel::with('rooms')->findOrFail($id);
        return view('hotels.book', compact('hotel'));
    }

    // Halaman foto hotel
    public function photos($id)
    {
        return view('hotels.photos', compact('id'));
    }

    public function uploadPhoto(Request $request, $id)
    {
        // implementasi unggah foto nanti di sini
    }

    public function facilities($id)
    {
        return view('hotels.facilities', compact('id'));
    }

    public function updateFacilities(Request $request, $id)
    {
        // implementasi update fasilitas
    }

    public function description($id)
    {
        return view('hotels.description', compact('id'));
    }

    public function updateDescription(Request $request, $id)
    {
        // implementasi update deskripsi
    }

    public function search(Request $request)
    {
        $request->validate([
            'destination' => 'required|string',
            'checkin'     => 'required|date',
            'checkout'    => 'required|date|after_or_equal:checkin',
            'guests'      => 'required|integer|min:1',
        ]);

        $hotels = Hotel::with('photos')
            ->where('location', 'like', '%' . $request->destination . '%')
            ->get();

        return view('hotels.index', compact('hotels'));
    }
}


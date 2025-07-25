<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;

class HotelController extends Controller
{
    // Menampilkan semua hotel
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    // Menampilkan detail hotel
    public function show($id)
    {
        $hotel = Hotel::with('rooms')->findOrFail($id);
    return view('hotels.show', compact('hotel'));
    }

    // ✅ Menampilkan form booking hotel
    public function book($id)
    {
        // Ambil hotel beserta semua kamarnya
        $hotel = Hotel::with('rooms')->findOrFail($id);
        return view('hotels.book', compact('hotel'));
    }

    // Menampilkan halaman foto hotel
    public function photos($id)
    {
        return view('hotels.photos', compact('id'));
    }

    // Proses unggah foto hotel
    public function uploadPhoto(Request $request, $id)
    {
        // implementasi unggah foto nanti di sini
    }

    // Menampilkan halaman fasilitas hotel
    public function facilities($id)
    {
        return view('hotels.facilities', compact('id'));
    }

    // Proses update fasilitas hotel
    public function updateFacilities(Request $request, $id)
    {
        // implementasi update fasilitas
    }

    // Menampilkan halaman deskripsi hotel
    public function description($id)
    {
        return view('hotels.description', compact('id'));
    }

    // Proses update deskripsi hotel
    public function updateDescription(Request $request, $id)
    {
        // implementasi update deskripsi
    }

    // Proses pencarian hotel berdasarkan tujuan dan tanggal
    public function search(Request $request)
    {
        $request->validate([
            'destination' => 'required|string',
            'checkin'     => 'required|date',
            'checkout'    => 'required|date|after_or_equal:checkin',
            'guests'      => 'required|integer|min:1',
        ]);

        $hotels = Hotel::where('location', 'like', '%' . $request->destination . '%')->get();
        return view('hotels.index', compact('hotels'));
    }
}

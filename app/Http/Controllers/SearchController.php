<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian jika ada
        $destination = $request->input('destination');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $guests = $request->input('guests');

        // Query sederhana
        $hotels = Hotel::query()
            ->where('location', 'LIKE', '%' . $destination . '%')
            ->get();

        return view('search.index', compact('hotels', 'destination', 'checkin', 'checkout', 'guests'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create($hotel = null)
    {
        $hotel = Hotel::with('rooms')->findOrFail($hotel);
    return view('bookings.create', compact('hotel'));
    }
public function store(Request $request, $hotel = null)


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('bookings.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('bookings.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

@extends('layouts.app')

@section('content')
<h2>Form Pemesanan</h2>

<form action="{{ route('hotels.book.store', $hotel->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="room_id" class="form-label">Pilih Kamar</label>
        <select name="room_id" id="room_id" class="form-select" required>
            @foreach ($hotel->rooms as $room)
                @if($room->available)
                    <option value="{{ $room->id }}">
                        {{ $room->name }} - Kapasitas {{ $room->capacity }} - Rp{{ number_format($room->price) }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="checkin" class="form-label">Tanggal Check-in</label>
        <input type="date" name="checkin" id="checkin" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="checkout" class="form-label">Tanggal Check-out</label>
        <input type="date" name="checkout" id="checkout" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
</form>
@endsection

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'room_type', 'type', 'capacity', 'price', 'name'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // Contoh struktur data room
    // Jika kamu ingin menambahkan default atau dummy dalam kode untuk testing:
    public static function exampleRoom()
    {
        $room = new Room();
        $room->type = 'reguler'; // atau bisa juga 'vip'
        $room->room_type = 'Standard';
        $room->price = 500000;
        $room->capacity = 2;
        $room->description = 'Kamar nyaman dengan fasilitas lengkap';
        return $room;
    }
    protected $casts = [
    'is_available' => 'boolean',
];

}

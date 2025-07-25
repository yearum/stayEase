<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'room_type',
        'price',
        'description',
        'capacity',
        'image'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'room_id',
    'checkin',
    'checkout',
    'total',
    'status',
    'duration_type',
    'payment_method',
];
    /**
     * Relasi dengan model User.
     */
public function user()
{
    return $this->belongsTo(User::class);
}
/**
 * Relasi dengan model Room.
 */
public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relasi dengan model Hotel melalui Room.
     */
    public function hotel()
    {
        return $this->hasOneThrough(Hotel::class, Room::class, 'id', 'id', 'room_id', 'hotel_id');
    }
    /**
     * Scope untuk mendapatkan booking berdasarkan status.
     */
public function scopeStatus($query, $status)
{
    return $query->where('status', $status);
}
/**
 * Scope untuk mendapatkan booking berdasarkan user.
 */
public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk mendapatkan booking berdasarkan tanggal check-in.
     */
    public function scopeCheckin($query, $date)
    {
        return $query->whereDate('checkin', $date);
    }

    /**
     * Scope untuk mendapatkan booking berdasarkan tanggal check-out.
     */
    public function scopeCheckout($query, $date)
    {
        return $query->whereDate('checkout', $date);
    }

    /**
     * Scope untuk mendapatkan booking berdasarkan tanggal check-in dan check-out.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('checkin', [$startDate, $endDate])
                     ->orWhereBetween('checkout', [$startDate, $endDate]);
    }

    /**
     * Scope untuk mendapatkan booking berdasarkan total harga.
     */
    public function scopeTotal($query, $min, $max)
    {
        return $query->whereBetween('total', [$min, $max]);
    }
}


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

    protected $casts = [
        'checkin' => 'datetime',
        'checkout' => 'datetime',
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
     * Accessor untuk format durasi booking.
     */
    public function getFormattedDurationAttribute()
    {
        return match ($this->duration_type) {
            'short_3h' => '3 Jam',
            'short_6h' => '6 Jam',
            'short_12h' => '12 Jam',
            'transit' => 'Transit (8 Jam)',
            'daily' => 'Harian (1 Malam)',
            default => ucfirst($this->duration_type),
        };
    }

    /**
     * Accessor untuk format total harga.
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp' . number_format($this->total, 0, ',', '.');
    }

    /**
     * Scope untuk status booking.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk user tertentu.
     */
    public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk tanggal check-in.
     */
    public function scopeCheckin($query, $date)
    {
        return $query->whereDate('checkin', $date);
    }

    /**
     * Scope untuk tanggal check-out.
     */
    public function scopeCheckout($query, $date)
    {
        return $query->whereDate('checkout', $date);
    }

    /**
     * Scope untuk rentang tanggal.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('checkin', [$startDate, $endDate])
                     ->orWhereBetween('checkout', [$startDate, $endDate]);
    }

    /**
     * Scope untuk rentang harga.
     */
    public function scopeTotal($query, $min, $max)
    {
        return $query->whereBetween('total', [$min, $max]);
    }

    /**
     * Scope untuk booking aktif (belum checkout dan belum dibatalkan).
     */
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'cancelled')
                     ->where('checkout', '>', now());
    }
}

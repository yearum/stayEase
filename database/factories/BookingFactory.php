<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'room_id' => Room::inRandomOrder()->first()?->id,
            'check_in' => now()->addDays(rand(1, 5)),
            'check_out' => now()->addDays(rand(6, 10)),
            'status' => 'confirmed',
        ];
    }
}

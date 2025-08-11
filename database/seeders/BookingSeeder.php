<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $durations = [
            'short_3h' => 100000,
            'short_6h' => 150000,
            'short_12h' => 200000,
            'transit' => 250000,
            'daily' => 300000,
        ];

        for ($i = 0; $i < 10; $i++) {
            $duration = array_rand($durations);
            $price = $durations[$duration];

            $checkin = Carbon::now()->addDays(rand(1, 5))->setTime(rand(8, 12), 0);
            $checkout = match ($duration) {
                'short_3h' => $checkin->copy()->addHours(3),
                'short_6h' => $checkin->copy()->addHours(6),
                'short_12h' => $checkin->copy()->addHours(12),
                'transit' => $checkin->copy()->addHours(18),
                'daily' => $checkin->copy()->addDay(),
            };

            DB::table('bookings')->insert([
                'user_id' => rand(1, 5),
                'room_id' => rand(1, 10),
                'duration_type' => $duration,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'total' => $price,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

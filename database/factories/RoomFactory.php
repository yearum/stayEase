<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'hotel_id' => \App\Models\Hotel::factory(),
            'name' => ucfirst($this->faker->word()) . ' Room',
            'price' => $this->faker->numberBetween(200000, 1000000),
            'capacity' => $this->faker->numberBetween(1, 4),
            'available' => true,
        ];
    }
}

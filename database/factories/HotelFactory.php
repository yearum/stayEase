<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Hotel',
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'rating' => $this->faker->randomFloat(1, 3, 5),
            'image' => 'https://source.unsplash.com/400x300/?hotel',
        ];
    }
}

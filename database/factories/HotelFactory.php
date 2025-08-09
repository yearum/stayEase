<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Hotel',
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph,
        
            'image' => 'https://source.unsplash.com/400x300/?hotel',
        ];
    }
}

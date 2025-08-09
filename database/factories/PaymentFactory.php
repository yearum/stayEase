<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'booking_id'       => Booking::inRandomOrder()->first()->id ?? Booking::factory(),
            'method'           => $this->faker->randomElement(['Transfer', 'COD', 'QRIS']),
            'amount'           => $this->faker->numberBetween(500000, 2000000),
            'payment_status'   => $this->faker->randomElement(['Pending', 'Paid']),
            'transaction_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}

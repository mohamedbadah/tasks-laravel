<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'total'=>$this->faker->numberBetween(300,9000),
            'payment_txp'=>$this->faker->randomElement(['foo', 'bar']),
            'status'=>$this->faker->randomElement(['active', 'disable']),
            'user_id'=>$this->faker->numberBetween(1,12),
        ];
    }
}

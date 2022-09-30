<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_Product>
 */
class Order_ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(3, 5),
            'order_id' => $this->faker->numberBetween(3, 20),
            'count' => $this->faker->randomNumber(),
            'item_price' => $this->faker->numberBetween(233, 1000),
            'total' => $this->faker->numberBetween(233, 1000)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product_Information>
 */
class product_InformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bar_cod' => $this->faker->word(),
            'pusching_price' => $this->faker->numberBetween(1000,20000),
            'purchased_count' => $this->faker->numberBetween(12, 124),
            'product_id' => $this->faker->unique()->numberBetween(4, 30)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->word(),
            'price'=>$this->faker->randomFloat(4,20,2000),
            'code'=>$this->faker->unique()->numberBetween('001','222'),
            'count'=>$this->faker->numberBetween(3,200),
            'exist'=>$this->faker->boolean(50),
            'sub_category_id'=>$this->faker->numberBetween(1,6),

        ];
    }
}

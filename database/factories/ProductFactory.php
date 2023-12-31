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
    public function definition(): array
    {
        return [
            //
            'name'=>fake()->word(),
            'price'=>fake()->randomFloat(2,10,500),
            'exist'=>fake()->boolean(50),
            'count'=>fake()->numberBetween(1,400),
            'category_id'=>fake()->numberBetween(1,50),
        ];
    }
}

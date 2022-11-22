<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => function () {
                return Product::all()->random();
            },
            'comment' => $this->faker->paragraph(),
            'star' => $this->faker->numberBetween(0, 5),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Manufacture;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'manufacture_id' => function () {
                return Manufacture::all()->random();
            },
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(2),
            'stock' => $this->faker->numberBetween(0, 1000),
            'price' => $this->faker->numberBetween(0, 20000000),
            'slug' => $this->faker->slug(5),
        ];
    }
}

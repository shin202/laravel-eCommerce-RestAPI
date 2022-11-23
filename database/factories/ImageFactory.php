<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->imageUrl(),
            'expires_at' => $this->faker->dateTime('2023-01-01 00:00:00', 'Asia/Ho_Chi_Minh'),
        ];
    }
}

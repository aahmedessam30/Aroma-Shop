<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->sentence(2),
            'slug'    => $this->faker->slug(2),
            'details' => $this->faker->paragraph(2),
            'status'  => $this->faker->numberBetween(0, 1),
            'image'   => $this->faker->imageUrl(200, 100),
        ];
    }
}

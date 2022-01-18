<?php

namespace Database\Factories;

use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_category_id' => PostCategory::all()->random(),
            'user_id' => User::all()->random(),
            'title'   => $this->faker->sentence(),
            'content' => $this->faker->paragraph(8),
            'image'   => $this->faker->imageUrl(750, 300),
            'views'   => $this->faker->numberBetween(0, 500),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Prodcut;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prodcut_id' => Prodcut::all()->random(),
            'post_id'    => Post::all()->random(),
            'user_id'    => User::all()->random(),
            'comment'    => $this->faker->paragraph(),
            'image'      => $this->faker->imageUrl(200, 100),
        ];
    }
}

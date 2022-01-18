<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id' =>Comment::all()->random(),
            'user_id'    =>User::all()->random(),
            'reply'      =>$this->faker->paragraph(),
            'image'      => $this->faker->imageUrl(200, 100),
        ];
    }
}

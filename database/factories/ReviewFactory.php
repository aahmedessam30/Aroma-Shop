<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Prodcut;
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
            'user_id'    => User::all()->random(),
            'prodcut_id' => Prodcut::all()->random(),
            'review'     => $this->faker->paragraph(),
            'rate'       => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}

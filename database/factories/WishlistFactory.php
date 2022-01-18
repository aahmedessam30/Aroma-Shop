<?php

namespace Database\Factories;

use App\Models\Prodcut;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishlistFactory extends Factory
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
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Prodcut;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecificationFactory extends Factory
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
            'width'      => $this->faker->numberBetween(100.0, 400.0),
            'height'     => $this->faker->numberBetween(100.0, 400.0),
            'depth'      => $this->faker->numberBetween(100.0, 400.0),
            'weight'     => $this->faker->numberBetween(100.0, 400.0),
            'quality_checking'   => $this->faker->numberBetween(0, 1),
        ];
    }
}

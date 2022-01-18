<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Specification;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdcutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'  => Category::all()->random(),
            'brand_id'     => Brand::all()->random(),
            'name'         => $this->faker->name(),
            'slug'         => $this->faker->slug(2),
            'price'        => $this->faker->numberBetween(10, 100),
            'image'        => $this->faker->imageUrl(640, 480, 'technics'),
            'description'  => $this->faker->paragraph(),
            'availibility' => $this->faker->randomElement(['In Stock', 'Not Available']),
        ];
    }
}

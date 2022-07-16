<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->word(),
            "slug" => $this->faker->slug(nbWords: 1),
            "ingredients" => $this->faker->words(nb: 5, asText: true),
            "price" => floatval($this->faker->numerify("#.##")),
            "categoryId" => Category::factory()
        ];
    }
}

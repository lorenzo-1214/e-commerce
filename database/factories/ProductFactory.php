<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(1, 100),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1, // Assegna una categoria
            'image' => 'images/default-product.jpg', // Usa un'immagine di default
        ];
    }
}

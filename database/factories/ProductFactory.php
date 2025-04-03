<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description'=> $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(100, 9999),
            'manufacturer'=> $this->faker->randomElement(['Prada', 'D&G', 'Nike', 'New Balance', 'Adidas', 'Puma', 'Reebok']),
            'colour' => $this->faker->randomElement(['Red', 'Blue', 'Green', 'Yellow']),
            'size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
        ];
    }

    public function price1000(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'price' => '1000',
            ];
        });
    }
}

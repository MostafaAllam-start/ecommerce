<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(50),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(10, 1000),
            'manage_stock' => $this->faker->boolean(),
            'slug' => $this->faker->slug(),
            'in_stock' => $this->faker->boolean(),
            'sku' => $this->faker->unique()->word(),
            'is_active' => $this->faker->boolean(),

        ];
    }
}

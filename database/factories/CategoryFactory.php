<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'slug' => $this->faker->slug(),
            'is_active' => $this->faker->boolean(),
            'parent_id' => null
        ];
    }
    public function withParent(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Category::inRandomOrder()->value('id')
            ];
        });
    }
}

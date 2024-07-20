<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FerriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'description' => fake()->unique()->paragraph($nbSentences = 3, $variableNbSentences = true),
            'capacity' => fake()->numberBetween($min = 800, $max = 1500),
            'route' => fake()->sentence($nbWords = 6, $variableNbWords = true),
            'image' => fake()->imageUrl($width = 640, $height = 480, 'cats'),
        ];
    }
}

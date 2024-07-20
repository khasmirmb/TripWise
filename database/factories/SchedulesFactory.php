<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedules>
 */
class SchedulesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'ferry_id' => fake()->numberBetween($min = 1, $max = 3),
            'departure_port' => fake()->unique()->country(),
            'arrival_port' => fake()->unique()->country(),
            'departure_time' => fake()->dateTime($max = 'now', $timezone = null),
            'arrival_time' => fake()->dateTime($max = 'now', $timezone = null),
        ];
    }
}

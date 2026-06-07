<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task' => fake()->sentence(10), // Menghasilkan kalimat acak berisi 10 kata
            'is_completed' => fake()->boolean(30), // 30% peluang bernilai true (completed)
        ];
    }
}

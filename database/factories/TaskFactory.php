<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'text' => fake()->word(),
            'finished' => fake()->boolean(),
            'repair_object_id' => fake()->numberBetween(1, 5),
            'done_by_user_id' => fake()->numberBetween(1, 5),
            'created_at' => now(),
        ];
    }
}

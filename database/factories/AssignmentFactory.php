<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'name' => fake()->company(),
            'priority' => fake()->numberBetween(1, 3),
            'state' => fake()->numberBetween(1, 5),
            'workshop_id' => fake()->numberBetween(1, 5),
            'created_by_user_id' => fake()->numberBetween(1, 5),
            'done_by_user_id' => NULL,
            'repair_object_id' => fake()->numberBetween(1, 5),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pc>
 */
class PcFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'brand' => fake()->word(),
            'cpu' => fake()->word(),
            'ram' => fake()->numberBetween(1, 64),
            'storage' => fake()->numberBetween(1, 500),
            'architecture' => fake()->randomElement(array('x64', 'x32')),
            'bios_key' => fake()->numberBetween(1, 9),
            'pc_type' => fake()->numberBetween(1, 2),
            'system_language' => fake()->numberBetween(1, 3),
            'repair_object_id' => 1
        ];
    }
}

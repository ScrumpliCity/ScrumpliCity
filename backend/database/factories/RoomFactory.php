<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . " Room",
            'number_of_sprints' => $this->faker->numberBetween(1, 10),
            'sprint_duration' => $this->faker->numberBetween(1, 10),
            'build_phase_duration' => $this->faker->numberBetween(1, 10),
            'planning_duration' => $this->faker->numberBetween(1, 10),
            'review_duration' => $this->faker->numberBetween(1, 10),
        ];
    }
}

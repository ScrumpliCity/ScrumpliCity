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
            'name' => $this->faker->name(),
            'number_of_sprints' => $this->faker->numberBetween(1, 10),
            'sprint_duration' => $this->faker->numberBetween(1, 10),
            'current_sprint' => 0,
            'completed_at' => null,
            'is_playing' => false,
            'last_play_start' => null,
            'last_play_end' => null
        ];
    }

    public function currentlyPlaying(): Factory {
        return $this->state(function (array $attributes) {
            return [
                'is_playing' => true,
                'current_sprint' => $this->faker->numberBetween(1, $attributes['number_of_sprints']),
                'last_play_start' => now(),
            ];
        });
    }

    public function played(): Factory {
        return $this->state(function (array $attributes) {
            return [
                'is_playing' => false,
                'current_sprint' => $this->faker->numberBetween(1, $attributes['number_of_sprints']),
                'last_play_start' => now()->subHour(1),
                'last_play_end' => now(),
            ];
        });
    }

    public function completed(): Factory {
        return $this->state(function (array $attributes) {
            return [
                'completed_at' => now(),
                'current_sprint' => $attributes['number_of_sprints'],
                'is_playing' => false,
                'last_play_start' => now()->subHour(1),
                'last_play_end' => now(),
            ];
        });
    }

}

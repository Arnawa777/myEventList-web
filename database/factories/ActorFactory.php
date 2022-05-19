<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'event_id' => $this->faker->numberBetween(1,3),
            'person_id' => $this->faker->numberBetween(1,3),
            'character_id' => $this->faker->numberBetween(1,3),
            'description' => 'Main'
        ];
    }
}

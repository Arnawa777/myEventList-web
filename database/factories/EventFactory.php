<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'person_id' => $this->faker->numberBetween(1,3),
            'character_id' => $this->faker->numberBetween(1,3),
            'category_id' => $this->faker->numberBetween(1,3),
            'location_id' => $this->faker->numberBetween(1,3),
            // 'review_id' => $this->faker->numberBetween(1,2),
            'name' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'synopsis' => collect($this->faker->paragraphs(mt_rand(5,10)))
                      ->map(fn($p) => "<p> $p </p>")
                      ->implode(''),
            'date' => $this->faker->dateTimeBetween('now', '+1 years'),
            'video' => $this->faker->numberBetween(1,2)
        ];
    }
}
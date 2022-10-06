<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(3, 20),
            'event_id' => $this->faker->unique()->numberBetween(8, 20),
            'rating' => $this->faker->numberBetween(1, 10),
            'body' => collect($this->faker->paragraphs(mt_rand(5, 7)))
                ->map(fn ($p) => "<p> $p </p>")
                ->implode('')
        ];
    }
}

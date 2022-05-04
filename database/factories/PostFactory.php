<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'user_id' => $this->faker->numberBetween(1,4),
            'topic_id' => $this->faker->numberBetween(1,3),
            'title' => $this->faker->sentence(2,3),
            'slug' => $this->faker->unique()->slug(),
            // 'body' => $this->faker->paragraph(10,15),
            'body' => collect($this->faker->paragraphs(mt_rand(5,10)))
                      ->map(fn($p) => "<p> $p </p>")
                      ->implode('')
        ];
    }
}

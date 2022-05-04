<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique()->slug(),
            'role_id' => $this->faker->numberBetween(1,2),
            // 'body' => $this->faker->paragraph(10,15),
            'biography' => collect($this->faker->paragraphs(mt_rand(5,10)))
                      ->map(fn($p) => "<p> $p </p>")
                      ->implode(''),
        ];
    }
}
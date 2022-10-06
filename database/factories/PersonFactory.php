<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Person;

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
        $name = $this->faker->name();
        $slug = SlugService::createSlug(Person::class, 'slug', $name);

        return [
            'name' => $name,
            'slug' => $slug,
            'birthday' => $this->faker->dateTimeBetween('-50 years', '-18 years'),
            // 'body' => $this->faker->paragraph(10,15),
            'biography' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($p) => "<p> $p </p>")
                ->implode(''),
            // 'picture' => '',
        ];
    }
}

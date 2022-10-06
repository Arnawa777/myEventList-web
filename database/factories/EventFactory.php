<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Event;

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
        $name = $this->faker->sentence(2, 3);
        $slug = SlugService::createSlug(Event::class, 'slug', $name);

        return [
            'name' => $name,
            'slug' => $slug,
            'location_id' => $this->faker->numberBetween(1, 8),
            'category_id' => $this->faker->numberBetween(1, 4),

            'description' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($p) => "<p> $p </p>")
                ->implode(''),
            // 'phone' => '',
            // 'date' => '',
            // 'picture' => "",
            // 'video' => "",
        ];
    }
}

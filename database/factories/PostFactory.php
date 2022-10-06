<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Post;

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

        $title = $this->faker->sentence(2, 3);
        $slug = SlugService::createSlug(Post::class, 'slug', $title);

        return [
            'user_id' => $this->faker->numberBetween(2, 10),
            'topic_id' => $this->faker->numberBetween(3, 8),
            'title' => $title,
            'slug' => $slug,
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
                ->map(fn ($p) => "<p> $p </p>")
                ->implode('')
        ];
    }
}

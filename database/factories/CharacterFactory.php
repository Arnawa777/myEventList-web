<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Character;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name();
        $slug = SlugService::createSlug(Character::class, 'slug', $name);

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph(1, 3),
            // 'picture' => '',
        ];
    }
}

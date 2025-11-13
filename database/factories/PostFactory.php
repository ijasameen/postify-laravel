<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
final class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realTextBetween(10, 30);
        $slug = SlugService::createSlug(Post::class, 'slug', $title);

        return [
            'title' => $title,
            'slug' => $slug,
            'summary' => fake()->realTextBetween(50, 200),
        ];
    }
}

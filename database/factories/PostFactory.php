<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\User;
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
    public function definition(): array
    {
        $title = fake()->sentence();
        $category = Category::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => fake()->imageUrl(),
            'content' => fake()->paragraphs(3, true),
            'category_id' => $category->id ?? null,
            'user_id' => $user->id ?? null,
            'published_at' => fake()->optional()->dateTime(),
        ];
    }
}

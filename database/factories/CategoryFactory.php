<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => array_values($this->faker->unique()->randomElements([
                'Technology',
                'Health',
                'Lifestyle',
                'Education',
                'Travel',
                'Food',
                'Finance',
                'Entertainment',
            ], 8))[0],
        ];
    }
}

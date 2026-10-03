<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'user_id' => User::factory(),
            'category_id' => Category::query()->inRandomOrder()->value('id') ?? Category::factory(),
            'title' => fake()->sentence(5),
            'description' => fake()->paragraphs(3, true),
            'budget' => fake()->randomFloat(2, 50, 2000),
            'type' => fake()->randomElement(['fixed', 'hourly']),
            'status' => 'open',
            'skills' => fake()->randomElements(
                ['Laravel', 'React', 'TypeScript', 'PHP', 'Tailwind CSS'],
                3
            ),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'slug' => 'service-name'.fake()->randomNumber(),
            'short_description' => fake()->sentence(35),
            'description' => fake()->sentence(200),
            'price' => 5000,
            'discounted_price' => 4000,
        ];
    }
}

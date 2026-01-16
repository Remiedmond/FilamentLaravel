<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
   public function definition(): array
{
    return [
        'user_id' => 1,
        'title' => $this->faker->sentence(3),
        'slug' => $this->faker->unique()->slug,
        'description' => $this->faker->paragraph,
        'date-start' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
        'date-end' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
        'location' => $this->faker->address,
        'cover_image' => null,
        'max_participants' => $this->faker->numberBetween(10, 100),
        'max_guests_per_registration' => $this->faker->numberBetween(1, 5),
        'is_public' => $this->faker->boolean,
    ];
    }
}

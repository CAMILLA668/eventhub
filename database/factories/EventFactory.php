<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
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

       $start = now()
            ->addDays(fake()->numberBetween(2, 30))
            ->setTime(fake()->numberBetween(8, 19), 0);
        return [
            'category_id' => Category::Factory(),
            'title' => fake()->paragraph(),
            'location' => fake()->address(),
            'start_at' => $start,
            'end_at' => $start->copy()->addHours(3),
            'capacity' => fake()->numberBetween(10, 100),
            'status' => 'scheduled',
        ];
    }
}

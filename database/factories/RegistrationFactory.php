<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event; 
use App\Models\User; 

/**
 * @extends Factory<Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => User::Factory(),
            'event_id'      => Event::factory(),
            'status'        => 'confirmed',
            'registered_at' => now(),
            'canceled_at'   => null,
        ];
    }
}

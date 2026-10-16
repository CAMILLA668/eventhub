<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Event; 
use App\Models\Registration; 
use App\Models\User;
use App\Services\RegistrationService;

class RegistrationServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     * 
     */

    use RefreshDatabase; 

    public function test_user_can_register_for_event(): void
    {
        $user = User::factory()->create();

        $event = Event::factory()->create([
            'capacity' => 10,
        ]);

        $service = app(RegistrationService::class);

        $registration = $service->register($user, $event);

        $this->assertDatabaseHas(
            'registrations',
            [
                'id' => $registration->id,
                'user_id' => $user->id,
                'event_id' => $event->id,
                'status' => 'confirmed',
            ]);

    public function test_user_cannot_register_twice(): void
    {
        $user = User::factory()->create();

        $event = Event::factory()->create();

        Registration::factory()->create([
            'user_id' 
        ])
    }        
    }
}

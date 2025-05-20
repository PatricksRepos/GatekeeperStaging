<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketingConfig;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_blocks_when_ticketing_inactive()
    {
        // Create an inactive ticketing config
        TicketingConfig::factory()->inactive()->create();

        // Create a user
        $user = User::factory()->create();

        // Act as the user and try to create a ticket
        $response = $this->actingAs($user)
            ->postJson(route('tickets.store'), [
                'event_id' => 1,  // Example event id
            ]);

        $response->assertStatus(400); // Expecting failure because ticketing is inactive
        $response->assertJson(['error' => 'Ticketing is inactive.']);
    }

    public function test_store_creates_and_returns_signature()
    {
        // Create an active ticketing config
        TicketingConfig::factory()->active()->create();

        // Create a user
        $user = User::factory()->create();

        // Act as the user and create a ticket
        $response = $this->actingAs($user)
            ->postJson(route('tickets.store'), [
                'event_id' => 1,  // Example event id
            ]);

        $response->assertStatus(201);  // Expecting success
        $response->assertJsonStructure([
            'id', 'user_id', 'event_id', 'created_at', 'updated_at'
        ]);  // Check if the response contains ticket details
    }
}

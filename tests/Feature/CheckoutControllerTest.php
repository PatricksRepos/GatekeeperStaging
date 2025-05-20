<?php

namespace Tests\Feature;

use App\Models\Checkout;
use App\Models\Checkin;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ramsey\Uuid\Guid\Guid;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_401_if_ticket_has_not_been_checked_in()
    {
        // Create a user
        $user = User::factory()->create();

        // Create an event
        $event = Event::factory()->create();
        $event_uuid = $event->uuid;

        // Create a ticket for that event
        $ticket = Ticket::factory()->create([
            'event_id' => $event->id,
            'ticket_nonce' => Guid::uuid4()->getBytes(),
            'asset_id' => 1,
        ]);

        // Send a POST request to checkout
        $response = $this->actingAs($user)->post(route('event.check-out.store', ['event_uuid' => $event_uuid]), [
            'ticket_code' => (string) $ticket->ticket_nonce, // Ensure this matches the ticket code in your logic
            'asset_id' => $ticket->asset_id,
        ]);

        // Assert the response status is 401 because the ticket has not been checked in
        $response->assertStatus(401);
        $response->assertJson(['message' => 'Ticket has not been checked in!']);
    }

    /** @test */
    public function it_creates_checkout_and_returns_id()
    {
        // Create a user
        $user = User::factory()->create();

        // Create an event
        $event = Event::factory()->create();
        $event_uuid = $event->uuid;

        // Create a ticket for that event
        $ticket = Ticket::factory()->create([
            'event_id' => $event->id,
            'ticket_nonce' => Guid::uuid4()->getBytes(),
            'asset_id' => 1,
        ]);

        // Create a checkin for that ticket (marking the ticket as checked in)
        $checkin = Checkin::factory()->create([
            'user_id' => $user->id,
            'ticket_id' => $ticket->id,
        ]);

        // Send a POST request to checkout
        $response = $this->actingAs($user)->post(route('event.check-out.store', ['event_uuid' => $event_uuid]), [
            'ticket_code' => (string) $ticket->ticket_nonce, // Ensure this matches the ticket code in your logic
            'asset_id' => $ticket->asset_id,
        ]);

        // Assert the response is 200 because the checkout is created
        $response->assertStatus(200);

        // Assert that a checkout has been created and the response contains an 'id'
        $response->assertJsonStructure([
            'id'
        ]);
    }
}

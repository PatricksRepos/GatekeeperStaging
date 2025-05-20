<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventAdminControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_manage_event_page()
    {
        // Create a user and authenticate them
        $user = User::factory()->create();
        $this->actingAs($user);

        // Make sure the correct route is used and the response status is 200
        $response = $this->get(route('manage-event.index'));

        // Assert correct status and view
        $response->assertStatus(200);
        $response->assertViewIs('ManageEvent/Index');  // Adjust to match your actual view
    }

    /** @test */
    public function it_creates_event_and_redirects()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Send a POST request to create a new event
        $response = $this->post(route('manage-event.store'), [
            'name' => 'Test Event',
            'event_date' => now()->toDateString(),  // Ensure this matches the format expected by your controller
            'location' => 'Test Location',
        ]);

        // Assert that the response status is 302 (redirect) and it's redirecting to the event show page
        $response->assertStatus(302);
        $response->assertRedirect(route('manage-event.show', ['eventUUID' => $response->getData()->uuid]));
    }

    /** @test */
    public function it_updates_event_and_redirects()
    {
        // Create a user and an event
        $user = User::factory()->create();
        $event = Event::factory()->create();
        $this->actingAs($user);

        // Send a PUT request to update the event
        $response = $this->put(route('manage-event.update', $event->uuid), [
            'name' => 'Updated Event',
            'event_date' => now()->toDateString(),  // Format must match the one expected by your controller
            'location' => 'Updated Location',
        ]);

        // Assert status and redirect to the event index page
        $response->assertStatus(302);
        $response->assertRedirect(route('manage-event.index'));
    }
}

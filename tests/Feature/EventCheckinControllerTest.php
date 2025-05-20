<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;

class EventCheckinControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function test_index_displays_list_of_events()
  {
    $events = Event::factory()->count(3)->create();

    $response = $this->get(route('events.checkin.index'));

    $response->assertStatus(200);
    foreach ($events as $event) {
      $response->assertSee($event->name);
    }
  }

  /** @test */
  public function test_show_displays_single_event()
  {
    $event = Event::factory()->create();

    $response = $this->get(route('events.checkin.show', $event));

    $response->assertStatus(200)
      ->assertSee($event->description);
  }
}

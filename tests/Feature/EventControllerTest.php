<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;

class EventControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function test_show_renders_public_event()
  {
    $event = Event::factory()->create();

    $response = $this->get(route('event.show', $event));

    $response->assertStatus(200)
      ->assertSee($event->name)
      ->assertSee($event->description);
  }
}

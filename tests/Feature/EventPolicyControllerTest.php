<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;
use App\Models\Policy;
use App\Models\User;

class EventPolicyControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function test_store_attaches_policy_and_redirects()
  {
    $user = User::factory()->admin()->create();
    $event = Event::factory()->create();
    $policy = Policy::factory()->create();

    $response = $this->actingAs($user)
      ->post(route('admin.events.policies.store', [$event, $policy]));

    $response->assertRedirect();
    $this->assertTrue($event->policies()->whereId($policy->id)->exists());
  }

  /** @test */
  public function test_test_destroy_detaches_policy_and_redirects()
  {
    $user = User::factory()->admin()->create();
    $event = Event::factory()->hasAttached(Policy::factory())->create();
    $policy = $event->policies()->first();

    $response = $this->actingAs($user)
      ->delete(route('admin.events.policies.destroy', [$event, $policy]));

    $response->assertRedirect();
    $this->assertFalse($event->policies()->whereId($policy->id)->exists());
  }
}

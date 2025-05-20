<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Team;
use App\Models\User;

class TeamControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function test_show_flashes_banner_and_renders()
  {
    $team = Team::factory()->create();
    $user = User::factory()->create();

    $response = $this->actingAs($user)
      ->get(route('teams.show', $team));

    $response->assertStatus(200)
      ->assertSessionHas('banner', 'Viewing Team')
      ->assertSee($team->name);
  }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Team;
use App\Models\Policy;
use App\Models\User;

class TeamPolicyControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function test_store_creates_team_policy()
  {
    $user = User::factory()->admin()->create();
    $team = Team::factory()->create();
    $policy = Policy::factory()->create();

    $response = $this->actingAs($user)
      ->post(route('teams.policies.store', [$team, $policy]));

    $response->assertRedirect();
    $this->assertTrue($team->policies()->whereId($policy->id)->exists());
  }

  /** @test */
  public function test_destroy_deletes_team_policy()
  {
    $user = User::factory()->admin()->create();
    $team = Team::factory()->hasAttached(Policy::factory())->create();
    $policy = $team->policies()->first();

    $response = $this->actingAs($user)
      ->delete(route('teams.policies.destroy', [$team, $policy]));

    $response->assertRedirect();
    $this->assertFalse($team->policies()->whereId($policy->id)->exists());
  }
}

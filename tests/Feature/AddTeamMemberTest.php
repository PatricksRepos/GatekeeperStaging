<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddTeamMemberTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_add_team_member()
  {
    $user = User::factory()->create();
    $team = Team::factory()->create(['user_id' => $user->id]);

    $newUser = User::factory()->create();

    $response = $this->actingAs($user)->post("/teams/{$team->id}/members", [
      'email' => $newUser->email,
    ]);

    $response->assertRedirect('/');
    $this->assertTrue($team->users->contains($newUser));
  }
}

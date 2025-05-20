<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTeamTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_create_team()
  {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/teams', [
      'name' => 'Team A',
    ]);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('teams', ['name' => 'Team A']);
  }
}

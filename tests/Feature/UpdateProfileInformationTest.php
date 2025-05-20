<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileInformationTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_update_profile_information()
  {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->put('/user/profile', [
      'name' => 'Updated Name',
      'email' => 'updated@example.com',
    ]);

    $response->assertRedirect('/user/profile');
    $user->refresh();
    $this->assertEquals('Updated Name', $user->name);
    $this->assertEquals('updated@example.com', $user->email);
  }
}

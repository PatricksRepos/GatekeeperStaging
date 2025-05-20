<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Policy;

class PolicyControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function test_store_requires_auth_and_creates()
  {
    $policyData = Policy::factory()->make()->toArray();

    $this->post(route('policies.store'), $policyData)
      ->assertRedirect('/login');

    $user = User::factory()->create();
    $this->actingAs($user)
      ->post(route('policies.store'), $policyData)
      ->assertRedirect(route('policies.index'));

    $this->assertDatabaseHas('policies', ['name' => $policyData['name']]);
  }

  /** @test */
  public function destroy_deletes_policy()
  {
    $user = User::factory()->create();
    $policy = Policy::factory()->create();

    $this->actingAs($user)
      ->delete(route('policies.destroy', $policy))
      ->assertRedirect(route('policies.index'));

    $this->assertDatabaseMissing('policies', ['id' => $policy->id]);
  }
}

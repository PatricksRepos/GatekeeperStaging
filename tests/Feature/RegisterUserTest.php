<?php


namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_register()
  {
    $response = $this->post('/register', [
      'name' => 'John Doe',
      'email' => 'john@example.com',
      'password' => 'password123',
      'password_confirmation' => 'password123',
      'terms' => true
    ]);

    $response->assertRedirect('/');
    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
  }
}

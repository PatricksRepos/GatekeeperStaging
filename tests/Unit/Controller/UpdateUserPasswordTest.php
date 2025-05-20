<?php

namespace Tests\Unit\Controller;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateUserPasswordTest extends TestCase
{
  use RefreshDatabase;

  public function test_update_password()
  {
    $user = User::factory()->create(['password' => Hash::make('currentpassword')]);

    $input = ['current_password' => 'currentpassword', 'password' => 'newpassword123', 'password_confirmation' => 'newpassword123'];
    $action = new UpdateUserPassword();
    $action->update($user, $input);

    $this->assertTrue(Hash::check('newpassword123', $user->password));
  }
}

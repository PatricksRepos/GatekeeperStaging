<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
  public function setUp(): void
  {
    parent::setUp();

    // Fresh-migrate the database for each Dusk test
    Artisan::call('migrate:fresh');

    // Seed a test user
    User::factory()->create([
      'email' => 'user@example.com',
      'password' => Hash::make('password123'),
    ]);
  }

  public function testUserCanLogin()
  {
    $this->browse(function (Browser $browser) {
      $browser->visit('/login')
        ->type('#input-0', 'user@example.com')   // Vuetify email field
        ->type('#input-2', 'password123')         // Vuetify password field
        ->click('button[type="submit"]')        // click submit
        ->waitForLocation('/dashboard')           // wait for redirect
        ->assertPathIs('/dashboard');             // assert location
    });
  }
}

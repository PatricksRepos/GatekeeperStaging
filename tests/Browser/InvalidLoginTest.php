<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InvalidLoginTest extends DuskTestCase
{
  public function setUp(): void
  {
    parent::setUp();

    // Reset the database and run migrations
    Artisan::call('migrate:fresh');

    // Seed a valid user
    User::factory()->create([
      'email'    => 'user@example.com',
      'password' => Hash::make('password123'),
    ]);
  }

  public function testShowsErrorOnBadCredentials()
  {
    $this->browse(function (Browser $browser) {
      $browser->visit('/login')
        // Use stable selectors for Vuetify inputs
        ->type('input[type="email"]', 'user@example.com')
        ->type('input[type="password"]', 'wrongpassword')
        ->click('button[type="submit"]')
        // Wait for the error alert to appear
        ->waitForText('ERROR', 5)
        // Assert the generic error title and specific message
        ->assertSee('ERROR')
        ->assertSee('These credentials do not match our records');
    });
  }
}

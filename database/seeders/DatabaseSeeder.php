<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Team;
use App\Models\Policy;
use App\Models\Event;
use App\Models\TicketingConfig;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    //
    // 1) Create an admin user + their personal team:
    //
    $admin = User::factory()
      ->create([
        'name'     => 'Admin User',
        'email'    => 'admin@example.com',
        'is_admin' => true,
      ]);

    // give them an owned team
    $team = Team::factory()
      ->for($admin, 'owner')
      ->create();

    //
    // 2) Seed three “real” policies by their 56-hex-char hash:
    //
    $policyHashes = [
      'f96584c4fcd13cd1702c9be683400072dd1aac853431c99037a3ab1e',
      'd91b5642303693f5e7a188748bfd1a26c925a1c5e382e19a13dd263c',
      '52f53a3eb07121fcbec36dae79f76abedc6f3a877f8c8857e6c204d1',
    ];

    foreach ($policyHashes as $hash) {
      Policy::factory()
        ->for($team, 'team')
        ->for($admin, 'user')
        ->create([ 'hash' => $hash ]);
    }

    //
    // 3) A default ticketing config (so your TicketControllerTest can toggle it off/on):
    //
    TicketingConfig::factory()
      ->active()              // <-- uses your factory’s active() state
      ->create([
        'max_tickets' => 500,
      ]);

    //
    // 4) Some sample events with random policy attachments:
    //
    Event::factory()
      ->count(5)
      ->for($team,  'team')
      ->for($admin, 'user')
      ->create()
      ->each(function (Event $event) {
        // pick two of your seeded policies at random using their IDs:
        $two = Policy::inRandomOrder()
          ->pluck('id')
          ->take(2);

        $event->policies()->attach($two);
      });
  }
}

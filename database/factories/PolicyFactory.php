<?php
// database/factories/PolicyFactory.php

namespace Database\Factories;

use App\Models\Policy;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PolicyFactory extends Factory
{
  protected $model = Policy::class;

  public function definition(): array
  {
    static $i = 0;

    $hashes = [
      'f96584c4fcd13cd1702c9be683400072dd1aac853431c99037a3ab1e',
      'd91b5642303693f5e7a188748bfd1a26c925a1c5e382e19a13dd263c',
      '52f53a3eb07121fcbec36dae79f76abedc6f3a877f8c8857e6c204d1',
    ];

    return [
      'hash'        => $hashes[$i++ % count($hashes)],
      'name'        => $this->faker->word(),
      'description' => $this->faker->sentence(),
      'team_id'     => Team::factory(),
      'user_id'     => User::factory(),
    ];
  }
}

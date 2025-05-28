<?php

// database/factories/UserFactory.php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Team;


class UserFactory extends Factory
{
  protected $model = User::class;

  public function definition(): array
  {
    return [
      'name'              => $this->faker->name(),
      'email'             => $this->faker->unique()->safeEmail(),
      'email_verified_at' => now(),
      'password'          => bcrypt('password'),
      'remember_token'    => Str::random(10),
      'current_team_id'   => null,
      'is_admin'          => false,
    ];
  }


  public function withPersonalTeam()
  {
    return $this->afterCreating(function (User $user) {
      $team = Team::factory()->create([
        'user_id' => $user->id,
        'name'    => $user->name . "'s Team",
      ]);

      // link them up as owner
      $user->ownedTeams()->save($team);
      $user->teams()->attach($team->id, ['role' => 'owner']);

      // mark it as their current team
      $user->current_team_id = $team->id;
      $user->save();
    });
  }


  /**
   * Mark the user as an administrator.
   */
  public function admin(): self
  {
    return $this->state(fn(array $attrs) => [
      'is_admin' => true,
    ]);
  }
}

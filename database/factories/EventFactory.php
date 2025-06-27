<?php

// database/factories/EventFactory.php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
  protected $model = Event::class;

  public function definition(): array
  {
    return [
      'uuid'                    => (string) Str::uuid(),
      'team_id'                 => Team::factory(),
      'user_id'                 => User::factory(),
      'name'                    => $this->faker->sentence(3),
      'nonce_valid_for_minutes' => 15,
      'hodl_asset'              => false,
      'start_date_time'         => now()->subHour(),
      'end_date_time'           => now()->addHour(),
      'location'                => $this->faker->city(),
      'event_start'             => $this->faker->time(),
      'event_end'               => $this->faker->time(),
      'event_date'              => now()->toDateString(),
      'description'             => $this->faker->paragraph(),
      'bg_image_path'           => null,
      'profile_photo_path'      => null,
    ];
  }
}

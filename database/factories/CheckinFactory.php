<?php

namespace Database\Factories;

use App\Models\Checkin;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckinFactory extends Factory
{
  protected $model = Checkin::class;

  public function definition()
  {
    return [
      'ticket_id' => \App\Models\Ticket::factory(),
      'user_id' => \App\Models\User::factory(),
    ];
  }
}

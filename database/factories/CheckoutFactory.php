<?php

namespace Database\Factories;

use App\Models\Checkout;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckoutFactory extends Factory
{
  protected $model = Checkout::class;

  public function definition()
  {
    return [
      'ticket_id' => \App\Models\Ticket::factory(),
      'user_id' => \App\Models\User::factory(),
    ];
  }
}

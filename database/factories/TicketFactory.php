<?php
// database/factories/TicketFactory.php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Event;
use App\Models\Policy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
  protected $model = Ticket::class;

  public function definition()
  {
    return [
      'event_id'        => Event::factory(),
      'policy_id'       => Policy::factory(),
      'asset_id'        => Str::random(32),
      'stake_key'       => Str::random(32),
      'signature_nonce' => Str::random(16),
      'ticket_nonce'    => Str::random(16),
      'signature'       => base64_encode(Str::random(64)),
    ];
  }
}

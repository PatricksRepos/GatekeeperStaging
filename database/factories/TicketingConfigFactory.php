<?php
// database/factories/TicketingConfigFactory.php

namespace Database\Factories;

use App\Models\TicketingConfig;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketingConfigFactory extends Factory
{
    protected $model = TicketingConfig::class;

    public function definition(): array
    {
        return [
            // pick one of the two valid statuses
            'status'      => $this->faker->randomElement(['active', 'inactive']),
            'max_tickets' => $this->faker->numberBetween(1, 1000),
        ];
    }

    /**
     * State for an active config
     */
    public function active(): static
    {
        return $this->state([
            'status' => 'active',
        ]);
    }

    /**
     * State for an inactive config
     */
    public function inactive(): static
    {
        return $this->state([
            'status' => 'inactive',
        ]);
    }
}

<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\TicketController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TicketControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(TicketController::class));
  }

  /** @test */
  public function store_method_exists()
  {
    $this->assertTrue(method_exists(TicketController::class, 'store'));
  }
}

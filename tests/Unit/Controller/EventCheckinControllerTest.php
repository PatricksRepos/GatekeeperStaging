<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\EventCheckinController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class EventCheckinControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(EventCheckinController::class));
  }

  /** @test */
  public function show_method_exists()
  {
    $this->assertTrue(method_exists(EventCheckinController::class, 'show'));
  }
}

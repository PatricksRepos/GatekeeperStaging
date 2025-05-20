<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\TeamController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TeamControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(TeamController::class));
  }

  /** @test */
  public function show_method_exists()
  {
    $this->assertTrue(method_exists(TeamController::class, 'show'));
  }
}

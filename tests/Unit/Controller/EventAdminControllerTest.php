<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\EventAdminController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class EventAdminControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(EventAdminController::class));
  }

  /** @test */
  public function index_method_exists()
  {
    $this->assertTrue(method_exists(EventAdminController::class, 'index'));
  }
}

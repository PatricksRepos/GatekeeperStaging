<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\EventPolicyController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class EventPolicyControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(EventPolicyController::class));
  }

  /** @test */
  public function store_method_exists()
  {
    $this->assertTrue(method_exists(EventPolicyController::class, 'store'));
  }
}

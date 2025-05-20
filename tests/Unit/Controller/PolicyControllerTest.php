<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\PolicyController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class PolicyControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(PolicyController::class));
  }

  /** @test */
  public function store_method_exists()
  {
    $this->assertTrue(method_exists(PolicyController::class, 'store'));
  }
}

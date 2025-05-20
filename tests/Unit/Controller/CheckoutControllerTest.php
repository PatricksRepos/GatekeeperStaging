<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\CheckoutController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class CheckoutControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(CheckoutController::class));
  }

  /** @test */
  public function store_method_exists()
  {
    $this->assertTrue(method_exists(CheckoutController::class, 'store'));
  }
}

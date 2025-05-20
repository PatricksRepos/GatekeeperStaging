<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\CheckinController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class CheckinControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(CheckinController::class));
  }

  /** @test */
  public function store_method_exists()
  {
    $this->assertTrue(
      method_exists(CheckinController::class, 'store'),
      'CheckinController does not have method store'
    );
  }
}

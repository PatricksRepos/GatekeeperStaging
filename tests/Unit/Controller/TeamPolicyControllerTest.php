<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\TeamPolicyController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TeamPolicyControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(TeamPolicyController::class));
  }

  /** @test */
  public function store_method_exists()
  {
    $this->assertTrue(method_exists(TeamPolicyController::class, 'store'));
  }
}

<?php

namespace Tests\Unit\Controller;

use App\Http\Controllers\ImageController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class ImageControllerTest extends TestCase
{
  use RefreshDatabase;
  /** @test */
  public function controller_class_exists()
  {
    $this->assertTrue(class_exists(ImageController::class));
  }

  /** @test */
  public function show_method_exists()
  {
    $this->assertTrue(method_exists(ImageController::class, 'show'));
  }
}

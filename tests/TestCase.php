<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
  use CreatesApplication;

  /**
   * Bootstrap the application for each test.
   *
   * This will load the .env.dusk file for all PHPUnit tests.
   */
  public function createApplication()
  {
    $app = require __DIR__ . '/../bootstrap/app.php';

    // Load environment from .env.dusk
    $app->loadEnvironmentFrom('.env.dusk');

    $app->make(Kernel::class)->bootstrap();

    return $app;
  }
}

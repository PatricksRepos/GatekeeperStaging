<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
  use CreatesApplication;

  protected function setUp(): void
  {
    parent::setUp();

    // Loads .env.testing automatically when running tests
    $this->loadEnvironmentFrom('.env.testing');
  }
}

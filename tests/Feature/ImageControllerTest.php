<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Image;
use Storage;

class ImageControllerTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function test_show_redirects_to_signed_url_and_caches_it()
  {
    Storage::fake('s3');
    $image = Image::factory()->create(['path' => 'foo.jpg']);

    $response = $this->get(route('image.show', $image));

    $response->assertRedirect();
    // you can assert that a cache entry now exists:
    $this->assertTrue(cache()->has("image-url-{$image->id}"));
  }
}

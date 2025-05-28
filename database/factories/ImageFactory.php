<?php
// database/factories/ImageFactory.php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
  protected $model = Image::class;

  public function definition()
  {
    return [
      'asset_key' => Str::uuid()->toString(),
      'path'      => 'images/' . $this->faker->image('public/storage/images', 640, 480, null, false),
    ];
  }
}

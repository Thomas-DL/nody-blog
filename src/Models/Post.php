<?php

namespace Nody\NodyBlog\Models;

use Nody\NodyBlog\Models\Tag;
use Nody\NodyBlog\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Enums\CropPosition;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{

  use InteractsWithMedia;

  /**
   * Register the conversions that should be performed.
   *
   * @return array
   */
  public function registerMediaConversions(Media $media = null): void
  {
    $this
      ->addMediaConversion('thumb')
      ->crop(1000, 630, CropPosition::Center)
      ->width(1000)
      ->height(630)
      ->sharpen(10)
      ->nonQueued();
  }

  protected $fillable = [
    'user_id',
    'category_id',
    'title',
    'slug',
    'content',
    'excerpt',
    'is_published',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }
}

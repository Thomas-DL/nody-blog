<?php

namespace Nody\NodyBlog\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    private $userModel;

    /**
     * Register the conversions that should be performed.
     *
     * @return array
     */
    public function registerMediaConversions(?Media $media = null): void
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

    public function user()
    {
        $this->userModel = config('nody-blog.user_model');

        return $this->belongsTo($this->userModel);
    }

    public function likes()
    {
        $this->userModel = config('nody-blog.user_model');

        return $this->belongsToMany($this->userModel, 'post_like')->withTimestamps();
    }

    public function countLikes()
    {
        return $this->likes()->count();
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    public function countComments()
    {
        return $this->comments()->count();
    }

    public function stats()
    {
        $likes = $this->countLikes();
        $comments = $this->countComments();

        return "${likes} Likes - ${comments} Comments";
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeBestRating($query)
    {
        return $query->withCount('likes')->orderBy('likes_count', 'desc');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category_id', $category);
    }

    public function scopeByTags($query, $tags)
    {
        return $query->whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('tags.id', $tags);
        });
    }

    public function formatDate()
    {
        return $this->created_at->format('d M Y');
    }

    public function getThumbnail()
    {
        return $this->getFirstMediaUrl('Blog', 'thumb');
    }

    public function getReadingTime()
    {
        $mins = round(str_word_count($this->content) / 250);

        return ($mins < 1) ? 1 : $mins;
    }
}

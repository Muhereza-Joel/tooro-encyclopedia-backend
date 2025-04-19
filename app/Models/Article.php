<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'category_id',
        'author_id',
        'published_at',
        'is_featured',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')  // Which field to generate from
            ->saveSlugsTo('slug')       // Where to save the slug
            ->doNotGenerateSlugsOnUpdate(); // Optional: Don't change slug on update
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('article_images')->singleFile();
    }

    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('article_images');
    }

    public function getImageUrlsAttribute()
    {
        return $this->getMedia('article_images')->map(function ($media) {
            return $media->getUrl();
        });
    }
}

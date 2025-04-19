<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')  // Which field to generate from
            ->saveSlugsTo('slug')       // Where to save the slug
            ->doNotGenerateSlugsOnUpdate(); // Optional: Don't change slug on update
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}

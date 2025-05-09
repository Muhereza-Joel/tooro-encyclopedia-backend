<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Artifact extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'material',
        'origin',
        'use_case',
        'image_path',
        'category',
        'preservation_status',
        'location',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('artifact_images')->singleFile();
    }

    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('artifact_images');
    }

    public function getImageUrlsAttribute()
    {
        return $this->getMedia('artifact_images')->map(function ($media) {
            return $media->getUrl();
        });
    }
}

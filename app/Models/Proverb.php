<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proverb extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meaning',
        'origin',
        'category',
        'usageExamples',
    ];

    protected $casts = [
        'usageExamples' => 'array',
    ];
}

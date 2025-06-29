<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class Question extends Model
{


    use HasFilamentComments;

    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    //use booted to automatically set the user_id when creating a question
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (Auth::check() && !$model->user_id) {
                $model->user_id = Auth::id();
            }
        });
    }

    /**
     * Get the user that owns the question.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

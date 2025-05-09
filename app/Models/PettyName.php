<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PettyName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'meaning',
        'origin',
        'description',
        'common_in_clans',
    ];
}

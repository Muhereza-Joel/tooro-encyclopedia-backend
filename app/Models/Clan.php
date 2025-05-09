<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'totem',
        'description',
        'origin',
        'leader_title',
        'notable_members',
    ];

    public function taboos()
    {
        return $this->hasMany(Taboo::class);
    }
}

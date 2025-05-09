<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taboo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'reason',
        'consequence',
        'applies_to',
        'clan_id',
        'category',
    ];

    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }
}

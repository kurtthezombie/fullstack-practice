<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieCast extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'movie_id',
        'name',
        'original_name',
        'popularity',
        'profile_path',
        'character',
    ];

    protected $casts = [
        'created_at' => 'datetime:D, m/d/o',
        'updated_at' => 'datetime:D, m/d/o',
    ];
}

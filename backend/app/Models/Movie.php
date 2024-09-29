<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Movie extends Model
{
    use HasFactory, HasUuids, Searchable;

    protected $fillable = [
        'id',
        'original_title',
        'original_language',
        'overview',
        'popularity',
        'poster_path',
        'backdrop_path',
        'release_date',
        'vote_average',
        'vote_count',
        'is_adult',
    ];

    protected $casts = [
        'created_at' => 'datetime:D, m/d/o',
        'updated_at' => 'datetime:D, m/d/o',
        'release_date' => 'datetime:D, m/d/o', 
    ];

    public function movieCasts(): HasMany
    {
        return $this->hasMany(MovieCast::class, 'movie_id', 'movie_id');
    }
}

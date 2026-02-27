<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\FilmRoom;


class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'film_category',
        'title_slug',
        'duration',
        'release_date',
        'date_time',
        'description',
    ];

    protected $casts = [
        'release_date' => 'date',
        'date_time' => 'datetime',
    ];

    protected static function boot()
{
    parent::boot();
    static::saving(function ($movie) {
        $movie->title_slug = \Illuminate\Support\Str::slug($movie->title);
    });
}

public function rooms()
{
    return $this->belongsToMany(Room::class, 'film_rooms', 'movie_id', 'room_id');
}
}

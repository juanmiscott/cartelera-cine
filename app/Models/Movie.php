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
        'duration',
        'release_date',
        'date_time',
        'description',
    ];

    protected $casts = [
        'release_date' => 'date',
        'date_time' => 'datetime',
    ];

public function rooms()
{
    return $this->belongsToMany(Room::class, 'film_rooms', 'movie_id', 'room_id');
}
}

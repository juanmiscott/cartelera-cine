<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Movie;
use App\Models\Session;
use App\Models\Ticket;

class FilmRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'movie_id',
    ];

   public function movie()
{
    return $this->belongsTo(Movie::class, 'movie_id');
}

public function room()
{
    return $this->belongsTo(Room::class, 'room_id');
}

public function sessions()
{
    return $this->hasMany(Session::class, 'film_room_id');
}

public function tickets()
{
    return $this->hasMany(Ticket::class, 'film_room_id');
}


}

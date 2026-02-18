<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Session;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
    ];

    public function movies()
{
    return $this->belongsToMany(Movie::class, 'film_rooms');
}

public function seats()
{
    return $this->hasMany(Seat::class, 'room_id');
}

public function sessions()
{
    return $this->hasMany(Session::class, 'room_id');
}
}

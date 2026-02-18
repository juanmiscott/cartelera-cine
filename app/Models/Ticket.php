<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seat;
use App\Models\FilmRoom;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_id',
        'film_room_id',
        'date',
        'price',
    ];

    protected $casts = [
        'date' => 'date',
        'price' => 'decimal:2',
    ];

    public function seat()
{
    return $this->belongsTo(Seat::class, 'seat_id');
}

public function filmRoom()
{
    return $this->belongsTo(FilmRoom::class, 'film_room_id');
}
}

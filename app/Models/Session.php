<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FilmRoom;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_room_id',
        'date_time',
        'price',
        'language',
    ];

    protected $casts = [
        'date_time' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function filmRoom()
{
    return $this->belongsTo(FilmRoom::class, 'film_room_id');
}

}

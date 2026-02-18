<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;


class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_number',
        'room_id',
        'available',
        'row',
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}

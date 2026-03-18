<?php

namespace App\Models\MongoDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $connection = 'mongodb';
    protected $table = 'movies';
    public $timestamps = true;

    public function getRouteKeyName()
    {
        return '_id';
    }

    protected $casts = [
        'release_date' => 'date',
        'date_time' => 'datetime',
    ];
}

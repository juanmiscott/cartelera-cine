<?php

namespace App\Models\MongoDB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'mongodb';
    
    protected $table = 'images';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'filename';
    }

    public function getThumbUrlAttribute()
    {
        return route('admin.images.thumb', ['filename' => $this->filename]);
    }
}
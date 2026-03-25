<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MovieStored
{
  use Dispatchable, SerializesModels;

  public function __construct(
    public $movie,
    public $images,
  ) {}
  
}
<?php

namespace App\Listeners;

use App\Events\MovieStored;
use App\Services\ImageService;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessMovieImages implements ShouldQueue
{
  public $queue = 'default';

  public function __construct(protected ImageService $imageService) {}

  public function handle(MovieStored $event)
  {
    if (!empty($event->images)) {
      $this->imageService->groupAdminImages($event->images, $event->movie);
      $this->imageService->resizeImages($event->images, 'movies', $event->movie->id, $event->movie);
    }
  }
}
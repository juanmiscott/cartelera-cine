<?php

namespace App\Listeners;

use App\Events\MovieStored;
use App\Services\SitemapService;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessMovieSitemap implements ShouldQueue
{
  public $queue = 'default';

  public function __construct(protected SitemapService $sitemapService) {}

  public function handle(MovieStored $event)
  {
    foreach ($event->movie->locale as $language => $fields) {
      $slugs = ['title' => \Str::slug($fields['title'])];
      $this->sitemapService->updateOrCreateSlug('movies', $event->movie->id, $language, 'movie', $slugs);
    }
  }
}
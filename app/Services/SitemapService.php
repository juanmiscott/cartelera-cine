<?php

namespace App\Services;

use App\Models\MySQL\Sitemap;
use Illuminate\Support\Str;

class SitemapService
{
  public function __construct(private Sitemap $sitemap) {}

  public function updateOrCreateSlug($entity, $entityId, $language, $routeName, $slugs)
  {
    $this->sitemap->updateOrCreate([
      'entity' => $entity,
      'entity_id' => $entityId,
      'language' => $language
    ], [
      'path' => route($language . '.' . $routeName, $slugs),
      'route_name' => $language . '.' . $routeName
    ]);
  }

  public function deleteSlug($entity, $entityId)
  {
      $this->sitemap->where('entity', $entity)->where('entity_id', $entityId)->delete();
  }
}
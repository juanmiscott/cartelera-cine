<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\MySQL\Sitemap;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct(
        private Sitemap $sitemap
    ) {}

    public function changeLanguage(Request $request)
    {
        try {
            $sitemap = $this->sitemap
                ->where('path', $request->path)
                ->first();

            $newRouteName = str_replace(
                $sitemap->language,
                $request->language,
                $sitemap->route_name
            );

            $newSitemap = $this->sitemap
                ->where('route_name', $newRouteName)
                ->first();

            return response()->json([
                'url' => $newSitemap->path,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
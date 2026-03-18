<?php

namespace App\Http\Controllers\Public;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MongoDB\Movie;
use Illuminate\Http\Request;
use App\Services\SitemapService;

class MovieController extends Controller
{
    public function __construct(private Movie $movie, private SitemapService $sitemapService) {}

    public function index()
    {
        try {
            $movies = $this->movie->all();
            return View::make('public.home')->with('movies', $movies);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $movie = $this->movie->where('_id', $request->attributes->get('sitemap')->entity_id )->first();

            $view = View::make('public.movie')->with('movie', $movie);
            
            return $view;
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }
}
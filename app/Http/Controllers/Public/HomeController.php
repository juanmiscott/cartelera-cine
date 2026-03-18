<?php

namespace App\Http\Controllers\Public;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MongoDB\Movie;
use App\Models\MySQL\Language;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private Movie $movie,
        private Language $language
    ) {}

    public function index()
    {
        try {
            $movies = $this->movie->all();
            $languages = $this->language->all();

            return View::make('public.home')
                ->with('movies', $movies)
                ->with('languages', $languages);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
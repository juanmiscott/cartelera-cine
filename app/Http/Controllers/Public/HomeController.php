<?php

namespace App\Http\Controllers\Public;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MongoDB\Movie;
use App\Models\MySQL\Language;
use App\Models\MySQL\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private Movie $movie,
        private Language $language,
        private Faq $faq
    ) {}

    public function index()
    {
        try {
            $movies = $this->movie->all();
            $languages = $this->language->all();
            $faqs = $this->faq->orderBy('created_at', 'asc')->get();

            return View::make('public.home')
                ->with('movies', $movies)
                ->with('languages', $languages)
                ->with('faqs', $faqs);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
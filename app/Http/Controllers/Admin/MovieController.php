<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MongoDB\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MovieRequest;
use App\Services\SitemapService;

class MovieController extends Controller
{
    public function __construct(private Movie $movie, private SitemapService $sitemapService) {}

    public function index(Request $request)
    {
        try {
            $query = Movie::query();

            if ($request->filled('title')) {
                $query->where('title', 'like', '%' . $request->title . '%');
            }

            if ($request->filled('film_category')) {
                $query->where('film_category', 'like', '%' . $request->film_category . '%');
            }
            

            $movies = $query
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();

            if (request()->ajax()) {
                return response()->json([
                    'table' => view('components.tables.movie-admin-table', ['records' => $movies])->render(),
                    'form'  => view('components.forms.movie-admin-form', ['record' => $this->movie])->render(),
                ], 200);
            } else {
                return View::make('admin.movies.index')
                    ->with('records', $movies)
                    ->with('record', $this->movie);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function create()
    {
        try {
            if (request()->ajax()) {
                return response()->json([
                    'form' => view('components.forms.movie-admin-form', ['record' => $this->movie])->render(),
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function store(MovieRequest $request)
    {
        try {

            $data = $request->validated();

            $movie = $this->movie->updateOrCreate(
                ['_id' => $request->input('id')],
                $data
            );

            foreach ($movie->locale as $language => $fields) {
                $slugs = [
                    'title' => $fields['title']
                ];

                $this->sitemapService->updateOrCreateSlug('movies', $movie->_id, $language, 'movie', $slugs);
            }

            $movies = $this->movie
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = $request->filled('id')
                ? 'La película se actualizó correctamente'
                : 'La película se creó correctamente';

            return response()->json([
                'table'   => view('components.tables.movie-admin-table', ['records' => $movies])->render(),
                'form'    => view('components.forms.movie-admin-form', ['record' => $this->movie])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Movie $movie)
    {
        try {
            return response()->json([
                'form' => view('components.forms.movie-admin-form', ['record' => $movie])->render(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function destroy(Movie $movie)
    {
        try {
            $movie->delete();

            $this->sitemapService->deleteSlug('movies', $movie->id);

            $movies = $this->movie
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = \Lang::get('admin/notification.destroy');

            return response()->json([
                'table'   => view('components.tables.movie-admin-table', ['records' => $movies])->render(),
                'form'    => view('components.forms.movie-admin-form', ['record' => $this->movie])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }
}
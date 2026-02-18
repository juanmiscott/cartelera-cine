<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct(private Movie $movie) {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'film_category' => ['required', 'string', 'max:255'],
            'duration' => ['required'], // si lo cambias a int: ['required','integer','min:1']
            'release_date' => ['required', 'date'],
            'date_time' => ['required', 'date'],
            'description' => ['required', 'string'],
        ]);

        $movie = Movie::create($data);

        return response()->json([
            'message' => 'Película creada correctamente',
            'data' => $movie
        ], 201);
    }

    public function create()
    {
        try {
            if (request()->ajax()) {
                return response()->json([], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    

    public function edit(Movie $movie)
    {
        return response()->json([
            'data' => $movie,
        ], 200);
    }

public function index(Request $request)
{
    $query = Movie::query();

    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->title . '%');
    }

    if ($request->filled('film_category')) {
        $query->where('film_category', 'like', '%' . $request->film_category . '%');
    }

    $records = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    $tableStructure = [
        'editRoute' => 'movies_edit',
        'fields' => [
            ['key' => 'title', 'label' => 'Título'],
            ['key' => 'film_category', 'label' => 'Categoría'],
            ['key' => 'duration', 'label' => 'Duración'],
            ['key' => 'release_date', 'label' => 'Estreno'],
        ],
    ];

    $formStructure = [
        ['name' => 'title', 'label' => 'Título', 'type' => 'text'],
        ['name' => 'film_category', 'label' => 'Categoría', 'type' => 'text'],
        ['name' => 'duration', 'label' => 'Duración', 'type' => 'text'],
        ['name' => 'release_date', 'label' => 'Fecha estreno', 'type' => 'date'],
        ['name' => 'date_time', 'label' => 'Fecha/Hora', 'type' => 'datetime-local'],
        ['name' => 'description', 'label' => 'Descripción', 'type' => 'text'],
    ];

    $record = new Movie();

    return View::make('admin.movies.index', compact(
        'records',
        'tableStructure',
        'formStructure',
        'record'
    ));
}


    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'film_category' => ['required', 'string', 'max:255'],
            'duration' => ['required'],
            'release_date' => ['required', 'date'],
            'date_time' => ['required', 'date'],
            'description' => ['required', 'string'],
        ]);

        $movie->update($data);

        return response()->json([
            'message' => 'Película actualizada correctamente',
            'data' => $movie,
        ], 200);
    }

    public function destroy(Movie $movie)
    {
        try {
            $movie->delete();

            return response()->json([
                'message' => 'Película eliminada correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
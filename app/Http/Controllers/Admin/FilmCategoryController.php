<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\FilmCategories;
use Illuminate\Http\Request;

class FilmCategoriesController extends Controller
{
    public function __construct(private FilmCategories $filmCategories) {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $filmCategories = FilmCategories::create($data);

        return response()->json([
            'message' => 'Categoría creada correctamente',
            'data' => $filmCategories
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

    public function edit(FilmCategories $filmCategories)
    {
        return response()->json([
            'data' => $filmCategories,
        ], 200);
    }

    public function index(Request $request)
    {
        $query = FilmCategories::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', $request->name);
        }

        $records = $query
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return View::make('admin.film_categories.index')->with('records', $records);
    }

    public function update(Request $request, FilmCategories $filmCategories)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        $filmCategories->update($data);

        return response()->json([
            'message' => 'Categoría actualizada correctamente',
            'data' => $filmCategories,
        ], 200);
    }

    public function destroy(FilmCategories $filmCategories)
    {
        try {
            $filmCategories->delete();

            return response()->json([
                'message' => 'Categoría eliminada correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
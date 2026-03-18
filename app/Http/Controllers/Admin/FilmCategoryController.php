<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MySQL\FilmCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FilmCategoryRequest;

class FilmCategoryController extends Controller
{
    public function __construct(private FilmCategory $filmCategory) {}

    public function index(Request $request)
    {
        try {
            $query = FilmCategory::query();

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            $filmCategories = $query
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();

            if (request()->ajax()) {
                return response()->json([
                    'table' => view('components.tables.film-category-admin-table', ['records' => $filmCategories])->render(),
                    'form'  => view('components.forms.film-category-admin-form', ['record' => $this->filmCategory])->render(),
                ], 200);
            } else {
                return View::make('admin.film-categories.index')
                    ->with('records', $filmCategories)
                    ->with('record', $this->filmCategory);
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
                    'form' => view('components.forms.film-category-admin-form', ['record' => $this->filmCategory])->render(),
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function store(FilmCategoryRequest $request)
    {
        try {
            $data = $request->validated();

            $this->filmCategory->updateOrCreate(
                ['id' => $request->input('id')],
                $data
            );

            $filmCategories = $this->filmCategory
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = $request->filled('id')
                ? 'La categoría se actualizó correctamente'
                : 'La categoría se creó correctamente';

            return response()->json([
                'table'   => view('components.tables.film-category-admin-table', ['records' => $filmCategories])->render(),
                'form'    => view('components.forms.film-category-admin-form', ['record' => $this->filmCategory])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

   public function edit(FilmCategories $film_category)
{
    try {
        return response()->json([
            'form' => view('components.forms.film-category-admin-form', ['record' => $film_category])->render(),
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => \Lang::get('admin/notification.error'),
        ], 500);
    }
}

   public function destroy(FilmCategories $film_category)
{
    try {
        $film_category->delete();

        $filmCategories = $this->filmCategory
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $message = \Lang::get('admin/notification.destroy');

        return response()->json([
            'table'   => view('components.tables.film-category-admin-table', ['records' => $filmCategories])->render(),
            'form'    => view('components.forms.film-category-admin-form', ['record' => $this->filmCategory])->render(),
            'message' => $message,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'message' => \Lang::get('admin/notification.error'),
        ], 500);
    }
}
}
<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\FilmSession;
use Illuminate\Http\Request;

class FilmSessionController extends Controller
{
    public function __construct(private FilmSession $filmSession){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Session::query();

        if ($request->filled('language')) {
            $query->where('language', 'like', '%' . $request->language . '%');
        }

        $records = $query
            ->orderBy('date_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        return View::make('admin.sessions.index')
            ->with('records', $records);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'film_room_id' => ['required', 'integer'],
            'date_time' => ['required', 'date'],
            'price' => ['required', 'numeric'],
            'language' => ['required', 'string', 'max:255'],
        ]);

        $filmSession = FilmSession::create($data);

        return response()->json([
            'message' => 'Sesión creada correctamente',
            'data' => $filmSession
        ], 201);
    }

    public function create()
    {
        if (request()->ajax()) {
            return response()->json([], 200);
        }
    }

    public function edit(FilmSession $filmSession)
    {
        return response()->json([
            'data' => $filmSession,
        ], 200);
    }

    public function update(Request $request, FilmSession $filmSession)
    {
        $data = $request->validate([
            'film_room_id' => ['required', 'integer'],
            'date_time' => ['required', 'date'],
            'price' => ['required', 'numeric'],
            'language' => ['required', 'string', 'max:255'],
        ]);

        $filmSession->update($data);

        return response()->json([
            'message' => 'Sesión actualizada correctamente',
            'data' => $filmSession,
        ], 200);
    }

    public function destroy(FilmSession $filmSession)
    {
        $filmSession->delete();

        return response()->json([
            'message' => 'Sesión eliminada correctamente',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct(private Session $session){}

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

        $session = Session::create($data);

        return response()->json([
            'message' => 'Sesión creada correctamente',
            'data' => $session
        ], 201);
    }

    public function create()
    {
        if (request()->ajax()) {
            return response()->json([], 200);
        }
    }

    public function edit(Session $session)
    {
        return response()->json([
            'data' => $session,
        ], 200);
    }

    public function update(Request $request, Session $session)
    {
        $data = $request->validate([
            'film_room_id' => ['required', 'integer'],
            'date_time' => ['required', 'date'],
            'price' => ['required', 'numeric'],
            'language' => ['required', 'string', 'max:255'],
        ]);

        $session->update($data);

        return response()->json([
            'message' => 'Sesión actualizada correctamente',
            'data' => $session,
        ], 200);
    }

    public function destroy(Session $session)
    {
        $session->delete();

        return response()->json([
            'message' => 'Sesión eliminada correctamente',
        ], 200);
    }
}

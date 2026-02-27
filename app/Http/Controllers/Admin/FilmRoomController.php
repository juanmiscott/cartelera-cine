<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\FilmRoom;
use Illuminate\Http\Request;

class FilmRoomController extends Controller
{
  public function __construct(private FilmRoom $filmRoom){
    $this->middleware('auth');
  }
 
 public function store(Request $request)
{
    $data = $request->validate([
        'room_id' => ['required', 'integer'],
        'movie_id' => ['required', 'integer'],
    ]);

    $filmRoom = FilmRoom::create($data);

    return response()->json([
        'message' => 'Sala de cine creada correctamente',
        'data' => $filmRoom
    ], 201);
}

  public function create()
  {
   try {
      if (request()->ajax()) {
        return response()->json([
        ], 200);
      }
    } catch (\Exception $e) {
      return response()->json([
        'message' =>  \Lang::get('admin/notification.error'),
      ], 500);
    }

  }

  public function edit(FilmRoom $filmRoom)
  {
    return response()->json([
      'data' => $filmRoom,
    ], 200);
  }

  public function index(Request $request)
{
    $query = FilmRoom::query();

    if ($request->filled('room_id')) {
        $query->where('room_id', 'like', '%' . $request->room_id . '%');
    }

    if ($request->filled('movie_id')) {
        $query->where('movie_id', 'like', '%' . $request->movie_id . '%');
    }

    $records = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    return View::make('admin.film_rooms.index')->with('records', $records);
}

public function update(Request $request, FilmRoom $filmRoom)
{
    $data = $request->validate([
        'room_id' => ['required', 'integer'],
        'movie_id' => ['required', 'integer'],
    ]);

    $filmRoom->update($data);

    return response()->json([
        'message' => 'Sala de cine actualizada correctamente',
        'data' => $filmRoom,
    ], 200);
}

  public function destroy(FilmRoom $filmRoom)
  {
    try{
      $filmRoom->delete();
     
      return response()->json([
        'message' => 'Sala de cine eliminada correctamente',
      ], 200);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(private Room $room){}

    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->filled('room_number')) {
            $query->where('room_number', $request->room_number);
        }

        $records = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return View::make('admin.rooms.index')
            ->with('records', $records);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_number' => ['required', 'integer'],
        ]);

        $room = Room::create($data);

        return response()->json([
            'message' => 'Sala creada correctamente',
            'data' => $room
        ], 201);
    }

    public function create()
    {
        if (request()->ajax()) {
            return response()->json([], 200);
        }
    }

    public function edit(Room $room)
    {
        return response()->json([
            'data' => $room,
        ], 200);
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'room_number' => ['required', 'integer'],
        ]);

        $room->update($data);

        return response()->json([
            'message' => 'Sala actualizada correctamente',
            'data' => $room,
        ], 200);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'message' => 'Sala eliminada correctamente',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function __construct(private Seat $seat){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Seat::query();

        if ($request->filled('seat_number')) {
            $query->where('seat_number', $request->seat_number);
        }

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }

        $records = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return View::make('admin.seats.index')
            ->with('records', $records);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'seat_number' => ['required', 'integer'],
            'room_id' => ['required', 'integer'],
            'row' => ['required', 'string', 'max:10'],
            'available' => ['boolean'],
        ]);

        $seat = Seat::create($data);

        return response()->json([
            'message' => 'Asiento creado correctamente',
            'data' => $seat
        ], 201);
    }

    public function create()
    {
        if (request()->ajax()) {
            return response()->json([], 200);
        }
    }

    public function edit(Seat $seat)
    {
        return response()->json([
            'data' => $seat,
        ], 200);
    }

    public function update(Request $request, Seat $seat)
    {
        $data = $request->validate([
            'seat_number' => ['required', 'integer'],
            'room_id' => ['required', 'integer'],
            'row' => ['required', 'string', 'max:10'],
            'available' => ['boolean'],
        ]);

        $seat->update($data);

        return response()->json([
            'message' => 'Asiento actualizado correctamente',
            'data' => $seat,
        ], 200);
    }

    public function destroy(Seat $seat)
    {
        $seat->delete();

        return response()->json([
            'message' => 'Asiento eliminado correctamente',
        ], 200);
    }
}

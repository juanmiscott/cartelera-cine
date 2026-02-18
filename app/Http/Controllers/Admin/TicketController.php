<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(private Ticket $ticket){}

    public function index(Request $request)
    {
        $query = Ticket::query();

        if ($request->filled('seat_id')) {
            $query->where('seat_id', $request->seat_id);
        }

        $records = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return View::make('admin.tickets.index')
            ->with('records', $records);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'seat_id' => ['required', 'integer'],
            'film_room_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'price' => ['required', 'numeric'],
        ]);

        $ticket = Ticket::create($data);

        return response()->json([
            'message' => 'Ticket creado correctamente',
            'data' => $ticket
        ], 201);
    }

    public function create()
    {
        if (request()->ajax()) {
            return response()->json([], 200);
        }
    }

    public function edit(Ticket $ticket)
    {
        return response()->json([
            'data' => $ticket,
        ], 200);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'seat_id' => ['required', 'integer'],
            'film_room_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'price' => ['required', 'numeric'],
        ]);

        $ticket->update($data);

        return response()->json([
            'message' => 'Ticket actualizado correctamente',
            'data' => $ticket,
        ], 200);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json([
            'message' => 'Ticket eliminado correctamente',
        ], 200);
    }
}

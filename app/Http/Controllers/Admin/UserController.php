<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
  public function __construct(private User $user){}
 
 public function store(Request $request)
{
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed', 'min:6'],
    ]);

    $data['password'] = Hash::make($data['password']);

    $user = User::create($data);

    return response()->json([
        'message' => 'Usuario creado correctamente',
        'data' => $user
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

  

  public function edit(User $user)
  {
    return response()->json([
      'data' => $user,
    ], 200);
  }

  public function index(Request $request)
{
    $query = User::query();

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    $records = $query
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString();

    // ✅ Estructura para el componente de tabla
    $tableStructure = [
        'editRoute' => 'users_edit',
        'fields' => [
            ['key' => 'name', 'label' => 'Nombre'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'created_at', 'label' => 'Creado'],
            ['key' => 'updated_at', 'label' => 'Actualizado'],
        ],
    ];

    // ✅ Estructura para el componente de formulario
    $formStructure = [
        ['name' => 'name', 'label' => 'Nombre', 'type' => 'text'],
        ['name' => 'email', 'label' => 'Email', 'type' => 'email'],
        ['name' => 'password', 'label' => 'Contraseña', 'type' => 'password'],
        ['name' => 'password_confirmation', 'label' => 'Confirmar contraseña', 'type' => 'password'],
    ];

    // ✅ Registro vacío para “crear”
    $record = new User();

    return View::make('admin.users.index', compact(
        'records',
        'tableStructure',
        'formStructure',
        'record'
    ));
}

public function update(Request $request, User $user)
{
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
    ]);

    $user->update($data);

    return response()->json([
        'message' => 'Usuario actualizado correctamente',
        'user' => $user,
    ], 200);
}

  public function destroy(User $user)
  {
    try{
      $user->delete();
     
      return response()->json([
        'message' => 'Usuario eliminado correctamente',
      ], 200);
    }catch(\Exception $e){
      return response()->json([
        'error' => $e->getMessage(),
      ], 500);
    }
  }

  
}

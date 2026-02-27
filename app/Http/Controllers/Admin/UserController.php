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

    public function index(Request $request)
    {
        try {
            $query = User::query();

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            $users = $query
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();

            if (request()->ajax()) {
                return response()->json([
                    'table' => view('components.admin-table', ['tableStructure' => $this->user->getTableStructure(), 'records' => $users])->render(),
                    'form'  => view('components.admin-form', ['formStructure' => $this->user->getFormStructure(), 'record' => $this->user])->render(),
                ], 200);
            } else {
                $view = View::make('admin.users.index')
                    ->with('tableStructure', $this->user->getTableStructure())
                    ->with('formStructure', $this->user->getFormStructure())
                    ->with('records', $users)
                    ->with('record', $this->user);
                return $view;
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
                    'form' => view('components.admin-form', ['formStructure' => $this->user->getFormStructure(), 'record' => $this->user])->render(),
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();

            unset($data['password_confirmation']);

            if ($request->filled('id') && empty($data['password'])) {
                unset($data['password']);
            }

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $this->user->updateOrCreate(
                ['id' => $request->input('id')],
                $data
            );

            $users = $this->user
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = $request->filled('id')
                ? 'El usuario se actualizó correctamente'
                : 'El usuario se creó correctamente';

            return response()->json([
                'table'   => view('components.admin-table', ['tableStructure' => $this->user->getTableStructure(), 'records' => $users])->render(),
                'form'    => view('components.admin-form', ['formStructure' => $this->user->getFormStructure(), 'record' => $this->user])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(User $user)
{
    try {
        return response()->json($user, 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => \Lang::get('admin/notification.error'),
        ], 500);
    }
}

    public function destroy(User $user)
    {
        try {
            $user->delete();

            $users = $this->user
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = \Lang::get('admin/notification.destroy');

            return response()->json([
                'table'   => view('components.admin-table', ['tableStructure' => $this->user->getTableStructure(), 'records' => $users])->render(),
                'form'    => view('components.admin-form', ['formStructure' => $this->user->getFormStructure(), 'record' => $this->user])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }
}
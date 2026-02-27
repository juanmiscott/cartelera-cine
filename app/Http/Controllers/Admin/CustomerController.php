<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CustomerRequest;

class CustomerController extends Controller
{
    public function __construct(private Customer $customer){}

    public function index(Request $request)
    {
        try {
            $query = Customer::query();

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }

            $customers = $query
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();

            if (request()->ajax()) {
                return response()->json([
                    'table' => view('components.admin-table', ['tableStructure' => $this->customer->getTableStructure(), 'records' => $customers])->render(),
                    'form'  => view('components.admin-form', ['formStructure' => $this->customer->getFormStructure(), 'record' => $this->customer])->render(),
                ], 200);
            } else {
                $view = View::make('admin.customers.index')
                    ->with('tableStructure', $this->customer->getTableStructure())
                    ->with('formStructure', $this->customer->getFormStructure())
                    ->with('records', $customers)
                    ->with('record', $this->customer);
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
                    'form' => view('components.admin-form', ['formStructure' => $this->customer->getFormStructure(), 'record' => $this->customer])->render(),
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function store(CustomerRequest $request)
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

            $this->customer->updateOrCreate(
                ['id' => $request->input('id')],
                $data
            );

            $customers = $this->customer
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = $request->filled('id')
                ? 'El usuario se actualizó correctamente'
                : 'El usuario se creó correctamente';

            return response()->json([
                'table'   => view('components.admin-table', ['tableStructure' => $this->customer->getTableStructure(), 'records' => $customers])->render(),
                'form'    => view('components.admin-form', ['formStructure' => $this->customer->getFormStructure(), 'record' => $this->customer])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Customer $customer)
{
    try {
        return response()->json($customer, 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => \Lang::get('admin/notification.error'),
        ], 500);
    }
}

    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();

            $customers = $this->customer
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = \Lang::get('admin/notification.destroy');

            return response()->json([
                'table'   => view('components.admin-table', ['tableStructure' => $this->customer->getTableStructure(), 'records' => $customers])->render(),
                'form'    => view('components.admin-form', ['formStructure' => $this->customer->getFormStructure(), 'record' => $this->customer])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }
}
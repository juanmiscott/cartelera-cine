<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\MySQL\Faq;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FaqRequest;

class FaqController extends Controller
{
    public function __construct(private Faq $faq) {}

    public function index(Request $request)
    {
        try {
            $query = Faq::query();

            if ($request->filled('title')) {
                $query->where('locale->es->title', 'like', '%' . $request->title . '%');
            }

            $faqs = $query
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();

            if (request()->ajax()) {
                return response()->json([
                    'table' => view('components.tables.faq-admin-table', ['records' => $faqs])->render(),
                    'form'  => view('components.forms.faq-admin-form', ['record' => $this->faq])->render(),
                ], 200);
            } else {
                return View::make('admin.faqs.index')
                    ->with('records', $faqs)
                    ->with('record', $this->faq);
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
                    'form' => view('components.forms.faq-admin-form', ['record' => $this->faq])->render(),
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function store(FaqRequest $request)
    {
        try {
            $data = $request->validated();

            $this->faq->updateOrCreate(
                ['id' => $request->input('id')],
                $data
            );

            $faqs = $this->faq
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = $request->filled('id')
                ? 'La FAQ se actualizó correctamente'
                : 'La FAQ se creó correctamente';

            return response()->json([
                'table'   => view('components.tables.faq-admin-table', ['records' => $faqs])->render(),
                'form'    => view('components.forms.faq-admin-form', ['record' => $this->faq])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(Faq $faq)
    {
        try {
            return response()->json([
                'form' => view('components.forms.faq-admin-form', ['record' => $faq])->render(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            $faqs = $this->faq
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $message = \Lang::get('admin/notification.destroy');

            return response()->json([
                'table'   => view('components.tables.faq-admin-table', ['records' => $faqs])->render(),
                'form'    => view('components.forms.faq-admin-form', ['record' => $this->faq])->render(),
                'message' => $message,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => \Lang::get('admin/notification.error'),
            ], 500);
        }
    }
}
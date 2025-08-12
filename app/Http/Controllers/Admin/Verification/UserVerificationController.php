<?php

namespace App\Http\Controllers\Admin\Verification;

use App\Http\Controllers\Controller;
use App\Models\identity_verification_users;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserVerificationController extends Controller
{
    public function index()
    {
        return view('admin.verification.users.index');
    }

    public function getdata(Request $request)
    {
        $query = identity_verification_users::with('user');

        if ($request->filled('name')) {
            $query->whereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->name . '%'));
        }

        if ($request->filled('email')) {
            $query->whereHas('user', fn($q) => $q->where('email', 'like', '%' . $request->email . '%'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('user_name', fn($item) => $item->user->name ?? '-')
            ->addColumn('email', fn($item) => $item->user->email ?? '-')
            ->addColumn('status', fn($item) => __($item->status))
            ->addColumn('action', function ($item) {
                $toggleText = $item->status === 'approved' ? 'إلغاء التوثيق' : 'توثيق';
                $toggleIcon = $item->status === 'approved' ? '<i class="fas fa-times-circle"></i>' : '<i class="fas fa-check-circle"></i>';

                return '
                    <form method="POST" action="' . route('admin.verification.users.toggle') . '" style="display:inline;">
                        ' . csrf_field() . '
                        <input type="hidden" name="id" value="' . $item->id . '">
                        <button type="submit" class="btn btn-sm btn-primary me-1">
                            ' . $toggleIcon . ' ' . $toggleText . '
                        </button>
                    </form>

                    <button class="btn btn-sm btn-success me-1 edit-btn"
                        data-id="' . $item->id . '"
                        data-name="' . e($item->user->name) . '"
                        data-email="' . e($item->user->email) . '"
                        data-card="' . e($item->id_card_number) . '"
                        data-status="' . $item->status . '">
                        <i class="fas fa-edit"></i> تعديل
                    </button>

                    <button class="btn btn-sm btn-danger delete-btn"
                        data-id="' . $item->id . '">
                        <i class="fas fa-trash-alt"></i> حذف
                    </button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function toggle(Request $request)
    {
        $item = identity_verification_users::findOrFail($request->id);
        $item->status = $item->status === 'approved' ? 'rejected' : 'approved';
        $item->reviewed_by = auth('admin')->id();
        $item->reviewed_at = now();
        $item->save();

        return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
    }

    public function delete(Request $request)
    {
        $item = identity_verification_users::findOrFail($request->id);
        $item->delete();

        return response()->json(['success' => 'تم حذف الطلب']);
    }
}

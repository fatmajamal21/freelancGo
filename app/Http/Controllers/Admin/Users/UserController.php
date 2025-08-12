<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function getdata(Request $request)
    {
        $users = User::query();

        if ($request->filled('name')) {
            $users->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $users->where('email', 'like', '%' . $request->email . '%');
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($admin) {
                return '<div class="d-flex align-items-center gap-3 fs-6">
                        <a data-id="' . $admin->id . '" data-name="' . $admin->name . '" data-email="' . $admin->email . '" data-bs-toggle="modal" data-bs-target="#edit-modal" class="text-warning edit_btn">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a data-id="' . $admin->id . '" class="text-danger delete-btn">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['success' => 'تم إضافة المستخدم بنجاح']);
    }

    public function edit(Request $request)
    {
        $user = User::findOrFail($request->id);
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
    // php artisan make:controller Verification/UserVerificationController

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['success' => 'تم التحديث بنجاح']);
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->delete();

        return response()->json(['success' => 'تم الحذف بنجاح']);
    }

    // public function __construct()
    // {
    //     $this->middleware(['permission:view own profile,web']);
    // }
}

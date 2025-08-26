<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FreelancerController extends Controller
{
    public function index()
    {
        return view('admin.admins.index');
    }

    public function getdata(Request $request)
    {
        $admins = Admin::query();

        if ($request->filled('name')) {
            $admins->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $admins->where('email', 'like', '%' . $request->email . '%');
        }

        return DataTables::of($admins)
            ->addIndexColumn()
            ->addColumn('action', function ($admin) {
                return '<div class="d-flex align-items-center gap-3">
        <a data-id="' . $admin->id . '" 
           data-name="' . $admin->name . '" 
           data-email="' . $admin->email . '" 
           data-bs-toggle="modal" 
           data-bs-target="#edit-modal" 
           class="action-btn btn-edit">
            <i class="bi bi-pencil-fill"></i> تعديل
        </a>
        <a data-id="' . $admin->id . '" 
           class="action-btn btn-delete delete-btn">
            <i class="bi bi-trash-fill"></i> حذف
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
            'email' => 'required|email|unique:admins,email',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['success' => 'تم إضافة الإداري بنجاح']);
    }

    public function edit(Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        return response()->json([
            'name' => $admin->name,
            'email' => $admin->email,
        ]);
    }

    public function update(Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json(['success' => 'تم التحديث بنجاح']);
    }

    public function delete(Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        $admin->delete();

        return response()->json(['success' => 'تم الحذف بنجاح']);
    }

    // public function __construct()
    // {
    //     $this->middleware(['permission:verify freelancers,admin']);
    // }
}

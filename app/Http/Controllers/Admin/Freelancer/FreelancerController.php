<?php

namespace App\Http\Controllers\Admin\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;  // تأكد من أن هذا هو النموذج الصحيح للفريلانسر
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FreelancerController extends Controller
{
    // عرض صفحة المستقلين
    public function index()
    {
        return view('admin.freelancers.index');
    }

    // جلب البيانات للمستقلين باستخدام DataTables
    public function getdata(Request $request)
    {
        $freelancers = Freelancer::query(); // أو من نموذج Freelancers الموجود في تطبيقك

        if ($request->filled('name')) {
            $freelancers->where('fullname', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $freelancers->where('email', 'like', '%' . $request->email . '%');
        }

        return DataTables::of($freelancers)
            ->addIndexColumn()
            ->addColumn('action', function ($freelancer) {
                return '<div class="d-flex align-items-center gap-3 fs-6">
                        <a data-id="' . $freelancer->id . '" data-email="' . $freelancer->email . '" data-bs-toggle="modal" data-bs-target="#edit-modal" class="text-warning edit_btn">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <a data-id="' . $freelancer->id . '" class="text-danger delete-btn">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // إضافة مستنقل جديد
    public function store(Request $request)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:freelancers,email',
        ]);

        // إنشاء مستقل جديد
        Freelancer::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => 'تمت إضافة المستقل بنجاح'
        ]);
    }

    // تحديث بيانات مستنقل
    // public function update(Request $request)
    // {
    //     $freelancer = Freelancer::findOrFail($request->id);

    //     // التحقق من البيانات المدخلة
    //     $request->validate([
    //         'fullname' => 'required|string|max:255',
    //         'email' => 'required|email|unique:freelancers,email,' . $freelancer->id,
    //     ]);

    //     $freelancer->update([
    //         'fullname' => $request->fullname,
    //         'email' => $request->email,
    //     ]);

    //     return response()->json([
    //         'success' => 'تم تحديث بيانات المستقل بنجاح'
    //     ]);
    // }

    public function edit(Request $request)
    {
        $freelancer = Freelancer::findOrFail($request->id);
        return response()->json([
            'fullname' => $freelancer->fullname,
            'email' => $freelancer->email,
        ]);
    }
    public function update(Request $request)
    {
        $freelancer = Freelancer::findOrFail($request->id);
        $freelancer->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
        ]);

        return response()->json(['success' => 'تم التحديث بنجاح']);
    }

    // حذف مستنقل
    public function delete(Request $request)
    {
        $freelancer = Freelancer::findOrFail($request->id);
        $freelancer->delete();

        return response()->json(['success' => 'تم الحذف بنجاح']);
    }
}

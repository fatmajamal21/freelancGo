<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    function index()
    {
        $models = config('app.models');
        $guards = config('app.guards');

        return view('admin.permissions.index', compact('models', 'guards'));
    }

    public function getdata(Request $request)
    {
        $query = Permission::query();

        // تطبيق الفلاتر
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('desc') && $request->desc != '') {
            $query->where('description', 'like', '%' . $request->desc . '%');
        }

        // إعادة البيانات باستخدام DataTables
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('desc', function ($permission) {
                return $permission->description;
            })
            ->addColumn('guard', function ($permission) {
                return __($permission->guard_name);
            })
            ->addColumn('action', function ($permission) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $permission->id . '" ';
                $data_attr .= 'data-name="' . $permission->name . '" ';
                $data_attr .= 'data-email="' . $permission->email . '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#update-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';

                $action .= '     <a data-id="' . $permission->id . '"  data-url="" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';

                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['action', 'desc', 'guard'])
            ->make(true);
    }

    // function getdata(Request $request)
    // {

    //     $users = Permission::query();
    //     return DataTables::of($users)
    //         ->addIndexColumn()
    //         ->addColumn('desc', function ($qur) {
    //             return  $qur->description;
    //         })
    //         ->addColumn('guard', function ($qur) {
    //             return __($qur->guard_name);
    //         })
    //         ->addColumn('action', function ($qur) {
    //             $data_attr = ' ';
    //             $data_attr .= 'data-id="' . $qur->id . '" ';
    //             $data_attr .= 'data-name="' . $qur->name . '" ';
    //             $data_attr .= 'data-email="' . $qur->email . '" ';

    //             $action = '';
    //             $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

    //             $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#update-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';

    //             $action .= '     <a data-id="' . $qur->id . '"  data-url="" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';


    //             $action .= '</div>';

    //             return $action;
    //         })
    //         ->rawColumns(['action', 'desc', 'guard'])
    //         ->make(true);
    // }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[\s\w-]*$/', 'alpha_dash', 'min:3', 'max:15'],
            'description' => 'required|string',
            'model' => 'required|string',
            'guard' => 'required|string',
        ]);

        $permName = strtolower(class_basename($request->model) . '.' . $request->name);
        $permission = Permission::firstOrCreate([
            'name' => $permName,
            'description' => $request->description,
            'guard_name' => $request->guard,
        ]);

        // إرجاع استجابة بعد إضافة الصلاحية
        return response()->json([
            'status' => 'success',
            'message' => 'تم إضافة الصلاحية بنجاح',
            'data' => $permission
        ]);
    }


    public function update(Request $request)
    {
        // البحث عن الصلاحية باستخدام الـ ID
        $permission = Permission::findOrFail($request->id);
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->guard_name = $request->guard;

        // حفظ التغييرات
        $permission->save();

        // إرسال استجابة النجاح
        return response()->json(['success' => 'تم تحديث الصلاحية بنجاح']);
    }

    public function delete(Request $request)
    {
        // البحث عن الصلاحية باستخدام الـ ID
        $permission = Permission::findOrFail($request->id);

        // حذف الصلاحية
        $permission->delete();

        // إرسال استجابة النجاح
        return response()->json(['success' => 'تم حذف الصلاحية بنجاح']);
    }

    // function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'regex:/^[\s\w-]*$/', 'alpha_dash', 'min:3', 'max:15'],
    //         'description' => 'required|string',
    //         'model' => 'required|string',
    //         'guard' => 'required|string',
    //     ]);


    //     $permName = strtolower(class_basename($request->model) . '.' . $request->name);
    //     $permission = Permission::firstOrCreate([
    //         'name' => $permName,
    //         'description' => $request->description,
    //         'guard_name' => $request->guard,
    //     ]);


    //     return response()->json();
    // }
}

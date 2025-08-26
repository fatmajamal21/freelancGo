<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $permissions = Permission::all()->groupBy('guard_name');
        $guards = config('app.guards');
        return view('admin.roles.index', compact('permissions', 'guards'));
    }

    public function store(Request $request)
    {
        $role = Role::firstOrCreate([
            'name' => $request->name,
            'guard_name' => $request->guard,
        ]);

        foreach ($request->permissions as $perm) {
            $permission = Permission::find($perm);
            $role->givePermissionTo($permission);
        }

        return response()->json();
    }

    public function getdata(Request $request)
    {
        $query = Role::query();

        // Apply filters for name and guard_name
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('guard') && $request->guard != '') {
            $query->where('guard_name', 'like', '%' . $request->guard . '%');
        }

        // Return data via DataTables
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('permissions', function ($role) {
                return $role->permissions->pluck('description')->join(', ');
            })
            ->addColumn('guard', function ($role) {
                return $role->guard_name;
            })
            ->rawColumns(['permissions'])
            ->make(true);
    }

    public function update(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $role->name = $request->name;
        $role->guard_name = $request->guard;

        // Sync permissions
        $role->permissions()->sync($request->permissions);

        return response()->json(['success' => 'Role updated successfully']);
    }

    public function delete(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $role->delete();

        return response()->json(['success' => 'Role deleted successfully']);
    }
}

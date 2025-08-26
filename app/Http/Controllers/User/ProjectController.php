<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index');
    }

    public function getdata(Request $request)
    {
        $query = Project::with('user')->latest();

        // ✨ لو فيه تصفية بالحالة نطبقها
        if ($request->has('status') && in_array($request->status, ['open', 'in_progress', 'completed', 'cancelled'])) {
            $query->where('status', $request->status);
        }

        return DataTables::of($query)
            ->addColumn('user', fn($row) => $row->user->name ?? '—')
            ->addColumn('actions', function ($row) {
                return '
        <div class="d-flex gap-2 justify-content-center">
            <button onclick="viewProject(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')" 
                    class="btn btn-sm btn-outline-info" title="عرض">
                <i class="bi bi-eye"></i>
            </button>
            <button onclick="editProject(' . htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') . ')" 
                    class="btn btn-sm btn-outline-warning" title="تعديل">
                <i class="bi bi-pencil-square"></i>
            </button>
            <button onclick="deleteProject(' . $row->id . ')" 
                    class="btn btn-sm btn-outline-danger" title="حذف">
                <i class="bi bi-trash"></i>
            </button>
        </div>  ';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }
    public function show(Request $request)
    {
        $project = Project::with('user')->findOrFail($request->id);

        return response()->json([
            'success' => true,
            'data' => $project
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'duration' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'required|in:open,in_progress,completed,cancelled',
        ]);

        Project::create($request->all());
        return redirect()->back()->with('success', 'تم إنشاء المشروع بنجاح');

        // return response()->json(['success' => 'تم إنشاء المشروع بنجاح']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:projects,id',
            'title' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'description' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'duration' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'required|in:open,in_progress,completed,cancelled',
        ]);

        $project = Project::find($request->id);
        $project->update($request->except('id'));
        return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');

        // return response()->json(['success' => 'تم تعديل المشروع بنجاح']);
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'required|exists:projects,id']);

        Project::destroy($request->id);
        return redirect()->back()->with('success', 'تم حذف المشروع   ');

        // return response()->json(['success' => 'تم حذف المشروع']);
    }

    // public function __construct()
    // {
    //     $this->middleware('permission:create project,admin')->only('create');
    //     $this->middleware('permission:edit project,admin')->only('edit');
    //     $this->middleware('permission:delete project,admin')->only('destroy');
    //     $this->middleware('permission:show all projects,admin')->only('index');
    // }
}

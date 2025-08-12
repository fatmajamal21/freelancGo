<?php

namespace App\Http\Controllers\Admin\Text;

use App\Events\TextRequested;
use App\Http\Controllers\Controller;
use App\Models\TextMail;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class TextMailController extends Controller
{
    function index()
    {
        return view('admin.texts.index');
    }

    function store(Request $request)
    {
        $textMail = TextMail::create([
            'text' => $request->text,
        ]);

        TextRequested::dispatch($textMail);

        return 'تمت المهمة بنجاح';
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
            ->addColumn('action', function ($user) {
                return '<button class="btn btn-sm btn-primary" data-id="' . $user->id . '">تعديل</button>
                    <button class="btn btn-sm btn-danger" data-id="' . $user->id . '">حذف</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

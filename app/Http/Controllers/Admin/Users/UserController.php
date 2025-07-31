<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // abort_unless(auth()->guard('admin')->user()->can('User.view'), 403);
        return view('admin.users.index');
    }
}

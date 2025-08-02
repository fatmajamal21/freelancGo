<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index');
    }

    // public function getdata()
    // {
    //     // return DataTables or JSON response
    // }

    // public function store(Request $request)
    // {
    //     // logic to store new project
    // }

    // public function update(Request $request)
    // {
    //     // logic to update project
    // }

    // public function delete(Request $request)
    // {
    //     // logic to delete project
    // }
}

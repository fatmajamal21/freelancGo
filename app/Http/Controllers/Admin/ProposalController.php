<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\proposals;
use Illuminate\Http\Request;

class ProposalController extends Controller

{
    public function index()
    {
        $proposals = proposals::with(['project', 'freelancer'])->get();
        return view('admin.proposals.index', compact('proposals'));
    }

    public function show($id)
    {
        $proposal = proposals::with(['project', 'freelancer'])->findOrFail($id);
        return view('admin.proposals.show', compact('proposal'));
    }
}

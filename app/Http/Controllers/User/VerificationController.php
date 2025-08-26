<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function index()
    {
        // $userRequests = IdentityVerificationUser::with('user')->get();
        // $freelancerRequests = IdentityVerificationFreelancer::with('freelancer')->get();

        return view('admin.verification.index', compact('userRequests', 'freelancerRequests'));
    }

    public function toggle(Request $request)
    {
        $type = $request->type;
        $id = $request->id;

        // if ($type === 'user') {
        //     $verification = IdentityVerificationUser::findOrFail($id);
        // } elseif ($type === 'freelancer') {
        //     $verification = IdentityVerificationFreelancer::findOrFail($id);
        // } else {
        //     return response()->json(['error' => 'Invalid type'], 400);
        // }

        // $newStatus = $verification->status === 'approved' ? 'rejected' : 'approved';
        // $verification->status = $newStatus;
        // $verification->reviewed_at = now();
        // $verification->reviewed_by = auth('admin')->id();
        // $verification->save();

        // return response()->json(['status' => $newStatus]);
    }
}

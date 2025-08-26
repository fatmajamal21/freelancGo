<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\Admin;

use App\Models\identity_verification_users;
use App\Models\identity_verification_freelancers;

use App\Models\User;
use App\Models\Project;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $adminsCount = Admin::count();
        $usersCount = User::count();
        $freelancersCount = Freelancer::count();
        $projectsCount = Project::count();
        // عدد طلبات التوثيق المجمل
        $verificationsCount = identity_verification_users::count() + identity_verification_freelancers::count();

        // عدد طلبات توثيق كل نوع
        $verificationsUsersCount = identity_verification_users::count();
        $verificationsFreelancersCount = identity_verification_freelancers::count();

        $totalProjects       = Project::count();
        $completedProjects   = Project::where('status', 'completed')->count();
        $inProgressProjects  = Project::where('status', 'in_progress')->count();
        $cancelledProjects   = Project::where('status', 'cancelled')->count();
        $openProjects        = Project::where('status', 'open')->count();
        $lateProjects        = Project::where('status', 'late')->count(); // لو فعلاً عندك الحالة دي


        return view('admin.dashboardadmin', compact(
            'adminsCount',
            'usersCount',
            'freelancersCount',
            'projectsCount',
            'verificationsCount',
            'verificationsUsersCount',
            'verificationsFreelancersCount',
            'completedProjects',
            'inProgressProjects',
            'cancelledProjects',
            'openProjects',
            'lateProjects'
        ));
    }
}

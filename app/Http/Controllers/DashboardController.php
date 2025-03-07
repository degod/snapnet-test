<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Enums\UserRole;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'totalUsers' => User::count(),
            'totalAdminUsers' => User::where('role', UserRole::ADMIN)->count(),
            'totalRegularUsers' => User::where('role', UserRole::USER)->count(),
            'totalProjects' => Project::count(),
            'totalTasks' => Task::count(),
            'pendingTasks' => Task::where('status', TaskStatus::PENDING)->count(),
            'inProgressTasks' => Task::where('status', TaskStatus::IN_PROGRESS)->count(),
            'completedTasks' => Task::where('status', TaskStatus::COMPLETED)->count(),
            'failedJobs' => DB::table('failed_jobs')->count(),
        ]);
    }
}

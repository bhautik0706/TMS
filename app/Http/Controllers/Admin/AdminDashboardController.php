<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\ActivityLog;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::where('role_id', 1)->count();
        $totalTasks = Task::whereNull('deleted_at')->count();
        $totalActivityLogs = ActivityLog::count();

        return view('admin.dashboard', compact('totalUsers', 'totalTasks', 'totalActivityLogs'));
    }
}

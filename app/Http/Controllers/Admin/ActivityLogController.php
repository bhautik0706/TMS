<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    //
    public function index()
    {
        $activityLogs = ActivityLog::with('user')
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->latest()
            ->paginate(10); 

        return view('admin.activityLog.activityLog', compact('activityLogs'));
    }
}
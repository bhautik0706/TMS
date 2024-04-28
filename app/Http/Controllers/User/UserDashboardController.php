<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', auth()->user()->id);


        if ($request->has('priority')) {
            $priority = $request->input('priority');
            $query->where('priority', $priority);
        }


        if ($request->has('due_date')) {
            $dueDate = $request->input('due_date');
            $query->whereDate('due_date', $dueDate);
        }


        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }


        $tasks = $query->paginate(10);

        return view('user.dashboard', ['tasks' => $tasks]);
    }
}
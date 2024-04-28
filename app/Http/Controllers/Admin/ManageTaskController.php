<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\ActivityLogger;

class ManageTaskController extends Controller
{
    //
    public function index()
    {
        $tasks = Task::with('user')
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->paginate(10);

        return view('admin.tasks.tasks', compact('tasks'));
    }
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.tasks.manageEditTask', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
        ]);

        $task = Task::findOrFail($id);
        ActivityLogger::logUpdatedTask(auth()->id(), 'Task updated successfully');
        $task->update($request->only('title', 'description', 'due_date', 'priority', 'status'));

        return redirect()->route('admin.manageTask.index')->with('success', 'Task updated successfully.');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        ActivityLogger::logDeletedTask(auth()->id(), 'Task deleted successfully');
        return redirect()->route('admin.manageTask.index')->with('success', 'Task deleted successfully.');
    }

    public function markCompleted($id)
    {
        $task = Task::findOrFail($id);
        $task->status = 'completed';
        $task->save();
        ActivityLogger::logUpdatedTask(auth()->id(), 'Task marked as completed');
        return redirect()->route('admin.manageTask.index')->with('success', 'Task marked as completed.');
    }
}
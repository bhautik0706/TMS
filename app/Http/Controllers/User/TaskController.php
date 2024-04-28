<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\ActivityLogger;

class TaskController extends Controller
{

    public function create()
    {
        return view('user.task.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->priority = $request->priority;
        $task->status = 'pending';
        $task->user_id = auth()->user()->id;
        $task->save();
        ActivityLogger::logCreatedTask(auth()->id(), 'Task created successfully');
        return redirect()->route('user.dashboard')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('user.task.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => $request->status
        ]);
        ActivityLogger::logUpdatedTask(auth()->id(), 'Task updated successfully');
        return redirect()->route('user.dashboard')->with('success', 'Task updated successfully.');
    }
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        ActivityLogger::logDeletedTask(auth()->id(), 'Task deleted successfully');
        return redirect()->route('user.dashboard')->with('success', 'Task deleted successfully.');
    }
    public function complete(Request $request, Task $task)
    {

        if ($task->user_id !== auth()->id()) {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized action.');
        }

        $task->update(['status' => 'completed']);
        ActivityLogger::logUpdatedTask(auth()->id(), 'Task marked as completed');
        return redirect()->route('user.dashboard')->with('success', 'Task marked as completed successfully.');
    }
}
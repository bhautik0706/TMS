@extends('user.layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="container">
    <h1>Edit Task</h1>
    <form method="POST" action="{{ route('task.update', $task->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}">
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description"
                class="form-control">{{ old('description', $task->description) }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input id="due_date" type="text" name="due_date" class="form-control"
                value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}">

            @error('due_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select id="priority" name="priority" class="form-control" required>
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium
                </option>
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending
                </option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed
                </option>
            </select>
            @error('status')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
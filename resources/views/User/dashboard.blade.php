@extends('user.layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1>Tasks</h1>

    <!-- Filter form -->
    <form method="GET" action="{{ route('user.dashboard') }}">
        <div class="row">
            <div class="col-md-4">
                <label for="priority">Priority:</label>
                <select name="priority" id="priority" class="form-control">
                    <option value="">All</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="due_date">Due Date:</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Apply Filters</button>
    </form>
    <!-- End Filter form -->
    <br>
    @if($tasks->isEmpty())
    <p>No tasks found.</p>
    @else
    <!-- Display tasks -->
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ $task->priority }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <!-- Action buttons -->
                    <a href="{{ route('task.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('task.delete', $task->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    @if ($task->status != 'completed')
                    <form action="{{ route('task.complete', $task->id) }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Complete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- End Display tasks -->

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $tasks->links() }}
    </div>
    <!-- End Pagination -->
    @endif
</div>
@endsection
@extends('admin.layouts.app')

@section('title', 'Manage Tasks')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1>Manage Tasks</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Created By</th>
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
                <td>{{ $task->status }}</td>
                <td>{{ optional($task->user)->name }}</td>
                <td>
                    <a href="{{ route('admin.manageTask.edit', $task->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.manageTask.destroy', $task->id) }}" method="POST"
                        style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    @if ($task->status != 'completed')
                    <form action="{{ route('admin.manageTask.markCompleted', $task->id) }}" method="POST"
                        style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Mark Completed</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $tasks->links() }}
</div>
@endsection
@extends('admin.layouts.app')

@section('title', 'Activity Log')

@section('content')
<div class="container">
    <h1>Activity Log</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Action</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activityLogs as $activityLog)
            <tr>
                <td>{{ $activityLog->id }}</td>
                <td>
                    @if($activityLog->user)
                    {{ $activityLog->user->name }}
                    @else
                    User Deleted
                    @endif
                </td>
                <td>{{ $activityLog->action }}</td>
                <td>{{ $activityLog->description }}</td>
                <td>{{ $activityLog->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-end">
        {{ $activityLogs->links() }}
    </div>
</div>
@endsection
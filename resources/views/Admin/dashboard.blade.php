@extends('admin.layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Users
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Tasks
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalTasks }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Total Activity Logs
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalActivityLogs }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.layout')

@section('title', 'Registration')

@section('content')
<h1 class="text-center">Task Management System</h1>
<div class="d-flex justify-content-center">
    <div class="form-container">
        <h2 class="text-center">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" autofocus>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>



            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <div class="text-center mt-3">
            <p>Alredy account? <a href="{{ route('login') }}">Register here</a></p>
        </div>
    </div>
</div>
@endsection
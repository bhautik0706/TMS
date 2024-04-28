<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->whereNull('deleted_at') // Exclude soft-deleted users
            ],
            'password' => 'required|string|min:8',
        ]);

        $regularUserRole = Role::where('name', 'regular_user')->first();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $regularUserRole->id; // Assign the ID of the regular_user role
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
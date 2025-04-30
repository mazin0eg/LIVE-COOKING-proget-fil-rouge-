<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    public function ShowRegister()  {
        return view('auth.register'); 
    }

    public function ShowLogin()  {
            return view('auth.login');  
    }

public function login(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string|min:8',
    ]);

    if (Auth::attempt($validated)) {
        $request->session()->regenerate();
        
        if (Gate::allows('admin_redirection')) {
            return redirect('/admin')->with('success', 'Login successful!');
        } else {
            return redirect('/')->with('success', 'Login successful!');
        }
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
}

    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        
        
        $validated['role'] = 'cooker';

        
        $user = User::create($validated);
        Auth::login($user);

        return redirect('/')->with('success', 'Registration successful!');

    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'You have been logged out successfully!');
}
}

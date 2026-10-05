<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup() {
        return view("auth.signup");
    }
    public function signin() {
        return view("auth.signin");
    }
    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create($validated);
        Auth::login($user);
        return redirect()->route('home');
    }
    public function login(Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'The provided credentials are incorrect.',
    ])->onlyInput('email');
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}

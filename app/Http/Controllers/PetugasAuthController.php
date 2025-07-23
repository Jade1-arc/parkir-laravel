<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-petugas');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials['role'] = 'petugas';
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('petugas.dashboard'));
        }
        return back()->withErrors([
            'email' => 'Email atau password salah, atau Anda bukan petugas parkir.',
        ]);
    }
} 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $user = $request->user();

        return view('auth.login')
        ->with('user',$user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $login = Auth::attempt($credentials);
        if (!$login) {
            return redirect()->back()
            ->with('errors', collect(["Hatalı email ya da şifre!"]));
        }

        $user = Auth::user();
        return view('home')
        ->with('user', $user);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('loginForm');

    }
}

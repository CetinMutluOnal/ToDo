<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function loginForm(Request $request)
    {

    if(Auth::user() == null ){
        $user = $request->user();

        return view('auth.login')
        ->with('user',$user);
    }

    return view('home');

    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        $login = Auth::guard('web')->attempt($credentials);
        if (!$login) {
            return redirect()->back()
            ->with('errors', collect(["Hatalı email ya da şifre!"]));
        }
        $user = Auth::guard('web')->user();

        return redirect()->route('home')
        ->with('user', Auth::user())
        ->with('todos',Todo::all());
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('loginForm');

    }
}

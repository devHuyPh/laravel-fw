<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/welcome'); 
        }

        return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác.');
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect('/login'); 
    }
}

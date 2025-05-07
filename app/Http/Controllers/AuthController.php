<?php

namespace App\Http\Controllers;

use COM;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login() {
        return View('login');
    }

    public function authenticate(Request $request)
    {
       $credential = $request->validate([
            'email' => ['required|email:dns'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    
}
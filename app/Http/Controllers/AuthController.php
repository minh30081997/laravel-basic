<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['name' => $username, 'password' => $password])) {
            return view('success')->with(['message' => 'Login Success', 'user' => Auth::user()]);
        } else {
            return view('login')->with(['message' => 'Login Fail']);
        }
    }

    public function logout() 
    {
        Auth::logout();
        return view('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function loginuser(Request $request) {
        // return($request->all());
       if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }
        return redirect('login')->with('toast_success', 'Login Berhasil');
    }

    public function logout() {
        Auth::logout();
        return redirect('login');
    }
    // public function register() {
    //     return view('register');
    // }
}

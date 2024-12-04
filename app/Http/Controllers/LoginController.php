<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request) {
        $credentials = [
            'name' => $request->input('login_name'), // Map login_email to email
            'password' => $request->input('login_password'), // Map login_password to password
        ];
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended('settings');
        }
    
        return redirect('login')->withErrors(['login' => 'Nesprávné údaje']);
    }
}

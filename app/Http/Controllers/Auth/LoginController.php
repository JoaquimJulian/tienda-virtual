<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        
    }

    public function login(Request $request)
    {
        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}

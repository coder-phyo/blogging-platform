<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function dashboard()
    {
        if (Auth::user()->role === 0 || Auth::user()->role === 1) {
            return redirect()->route('author#home');
        } else {
            return redirect()->route('user#home');
        }
    }
}

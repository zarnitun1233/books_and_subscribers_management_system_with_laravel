<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show Login Page
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Doing Login Process
     * @param Request $request
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route("login")->with('success', 'Login Succeed');
        }
        return redirect()->route("login")->with('fail', 'Login Failed');
    }

    /**
     * Doing Logout Process
     * @return response()
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route("login")->with('logout', 'Logout Succeed');
    }
}

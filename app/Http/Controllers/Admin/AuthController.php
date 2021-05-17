<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    public function login()
    {
        if(Auth::check()){
            return redirect()->route('admin.dashboard.index');
        }
        
        return view('admin.login.login');
    }

    public function do_login(Request $request)
    {

        $credentials = $request->all();

        if (Auth::viaRemember()) {

            return redirect()->intended('admin/dashboard');

        } else {

            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status' => 1], $request->has('remember'))) {
                return redirect()->intended('admin/dashboard');
            }

        }
        
    }

    public function password()
    {

        if(Auth::check()){
            return redirect()->route('admin.dashboard.index');
        }

        return view('admin.login.password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}

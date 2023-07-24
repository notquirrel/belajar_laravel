<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function postLogin(request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            Session::put([
                'name' => Auth::user()->name,
                'password' => Auth::user()->password,
            ]);
            return redirect('admin/home');
        }
            return redirect()->back()->with('message', 'Username or Password is Wrong');

    }
}

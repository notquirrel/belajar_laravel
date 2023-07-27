<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

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
    public function register(){
        return view('register');
    }
    public function postRegister(Request $request){
        $request->validate([
            'name'       => 'required',
            'email'      => 'required',
            'password'   => 'required',
        ]);

        Users::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => password_hash($request->password, PASSWORD_BCRYPT),
        ]);
        return redirect('/register')->with('success', 'Akun Berhasil Dibuat');
    }
    public function forgot(){
        return view('forgot');
    }
    public function postForgot(request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    public function reset($token){
        return view('reset', ['token' => $token]);
    }
    public function postReset(request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }
}

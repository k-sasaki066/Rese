<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function getRegister()
    {
        return view('auth/register');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return view('auth/thanks');
        } catch (\Throwable $th) {
            return redirect('auth/register')->with('result', 'エラーが発生しました');
        }
        return view('auth/register');
    }

    // public function getLogin()
    // {
    //     return view('auth/login');
    // }

    // public function postLogin(LoginRequest $request)
    // {
    //     if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
    //         return redirect('/')->with('result', 'ログインに成功しました');
    //     } else {
    //         return redirect('/login')->with('result', 'メールアドレスまたはパスワードが間違っております');
    //     };
    // }

    // public function postLogout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect("/login");
    // }
}

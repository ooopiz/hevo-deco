<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(URL_DASHBOARD2);
        }
        return view('user.login');
    }

    public function doLogin(Request $request)
    {
        $messages = [
            'email.required' => ':attribute 為必填欄位',
            'email.email' => ':attribute 格式錯誤',
            'password.required' => ':attribute 為必填欄位'
        ];
        $rules = array(
            'email'=>'required|email',
            'password'=>'required',
        );
        $request->validate($rules, $messages);

        $email = $request->get('email');
        $password = $request->get('password');
        $remember_me = true;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)) {
            return redirect(URL_DASHBOARD2);
        } else {
            return redirect(URL_USER_LOGIN);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(URL_HOME);
    }
}

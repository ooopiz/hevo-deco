<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $loginUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, UsersRepository $usersRepository)
    {
        $loginUser = $this->loginUser;
        if ($request->method() == 'GET') {
            return view('dashboard.profile', compact('loginUser'));
        }

        $pass = $request->get('password');
        $repass = $request->get('repassword');

        if ($pass == $repass) {
            $bool =$usersRepository->update([['id', '=', $this->loginUser->id]], ['password' => bcrypt($pass)]);
            $result['css'] = 'alert-success';
            $result['message'] = '更改成功';
            if (!$bool) {
                $result['css'] = 'alert-danger';
                $result['message'] = '更新失敗';
            }
        } else {
            $result['css'] = 'alert-danger';
            $result['message'] = '兩次密碼不符合';
        }

        $loginUser = $this->loginUser;
        return view('dashboard.profile', compact('loginUser', 'result'));
    }
}

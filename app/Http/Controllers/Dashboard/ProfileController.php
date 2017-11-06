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

    public function index()
    {
        $loginUser = $this->loginUser;
        return view('dashboard.profile', compact('loginUser'));
    }

    public function doPasswordReset(Request $request, UsersRepository $usersRepository)
    {
        $validateMessages = array('password.confirmed' => '確認密碼不相符合');
        $validateRules = array(
            'password'=>'required|confirmed',
            'password_confirmation' => 'required'
        );
        $request->validate($validateRules, $validateMessages);

        $password = $request->get('password');
        $bool =$usersRepository->update([['id', '=', $this->loginUser->id]], ['password' => bcrypt($password)]);

        $message = $bool ? '修改成功' : '修改失敗';

        return redirect()->back()->with('message', $message);
    }
}

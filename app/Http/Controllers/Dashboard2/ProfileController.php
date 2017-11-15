<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard2.profile');
    }

    public function doPasswordReset(Request $request, UsersRepository $usersRepository)
    {
        $validateMessages = array('password.confirmed' => '確認密碼不相符合');
        $validateRules = array(
            'password'=>'required|confirmed',
            'password_confirmation' => 'required'
        );
        $request->validate($validateRules, $validateMessages);

        $userId = Auth::id();
        $password = $request->get('password');
        $bool =$usersRepository->update([['id', '=', $userId]], ['password' => bcrypt($password)]);

        $message = $bool ? '修改成功' : '修改失敗';
        $class = $bool ? 'alert-success' : 'alert-danger';

        return redirect()->back()
            ->with('message', array('class' => $class, 'content' => $message));
    }
}

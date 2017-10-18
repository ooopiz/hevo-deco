<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthorityController extends Controller
{
    /** @var UsersRepository */
    private $usersRepository;

    private $loginUser;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $loginUser = $this->loginUser;
        $users = $this->usersRepository->findAllBy(array(['id', '>', 0]));

        return view('dashboard.authority_user', compact('loginUser', 'users'));
    }

    public function edit()
    {
        $loginUser = $this->loginUser;
        return view('dashboard.authority_user_edit', compact('loginUser'));
    }
}

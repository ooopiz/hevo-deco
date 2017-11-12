<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ElseController extends Controller
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
        return view('dashboard.else', compact('loginUser'));
    }

    public function doUpdate()
    {
        $project_dir = "/usr/share/nginx/hevo-deco";
        $orderLog = new Logger('Git');
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/pull.log')));

        if (getenv('APP_ENV') === 'production') {
            $cwd = getcwd();
            chdir($project_dir);
            exec("git pull", $result);
//            exec("/usr/local/bin/composer install --no-dev", $rs_composer);
            chdir($cwd);

            $message = '更新成功';
            $log = [
                'status' => $message,
                'result' => $result
            ];
        } else {
            $message = '非線上環境，nothing to do ...';
            $log = [
                'status' => $message,
            ];
        }
        $orderLog->info('pull log', $log);

        return redirect()->back()->with('message', $message);
    }
}

<?php

namespace App\Http\Controllers\Dashboard2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ElseController extends Controller
{
    public function index()
    {
        return view('dashboard2.else');
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

            $class = 'alert-success';
            $content = '更新成功';
        } else {
            $class = 'alert-info';
            $content = '非線上環境，nothing to do ...';
        }
        $orderLog->info('pull log', array($content));

        return redirect()->back()
            ->with('message', array('class' => $class, 'content' => $content));
    }
}

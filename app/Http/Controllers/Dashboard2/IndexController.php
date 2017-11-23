<?php

namespace App\Http\Controllers\Dashboard2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return redirect(URL_DASHBOARD2_BANNER);
    }
}

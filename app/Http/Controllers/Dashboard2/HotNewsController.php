<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\HotNewsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotNewsController extends Controller
{
    /** @var HotNewsRepository */
    private $hotNewsRepsoitory;

    public function __construct(HotNewsRepository $hotNewsRepository)
    {
        $this->hotNewsRepsoitory = $hotNewsRepository;
    }

    public function index()
    {
        $hotNews = $this->hotNewsRepsoitory->all();
        return view('dashboard2.hotnews', compact('hotNews'));
    }
}

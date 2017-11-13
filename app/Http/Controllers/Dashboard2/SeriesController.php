<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    /** @var SeriesRepository */
    protected $seriesRepository;

    public function __construct(SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
    }

    public function index()
    {
        $series = $this->seriesRepository->all();
//        $series = $series->sortByDesc('id');
        return view('dashboard2.series', compact('series'));
    }
}

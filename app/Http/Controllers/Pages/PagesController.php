<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    /** @var SeriesRepository */
    private $seriesRepository;

    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.index');
    }

    public function product(CategoriesRepository $categoriesRepository, SeriesRepository $seriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->seriesRepository = $seriesRepository;

        $conditionCategory = array(
            ['id', '>', 0],
            ['display', '=', 'Y'],
            ['active', '=', 'Y'],
            ['delete', '<>', 'Y']
        );
        $categories = $this->categoriesRepository->findAllBy($conditionCategory);

        $conditionSeries = array(
            ['id', '>', 0],
            ['display', '=', 'Y'],
            ['active', '=', 'Y'],
            ['delete', '<>', 'Y']
        );
        $series = $this->seriesRepository->findAllBy($conditionSeries);

        return view('pages.product', compact('categories', 'series'));
    }
}

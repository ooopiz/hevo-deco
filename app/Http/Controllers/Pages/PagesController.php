<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\OptionsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    /** @var SeriesRepository */
    private $seriesRepository;

    /** @var OptionsRepository */
    private $optionsRepository;

    public function __construct()
    {
    }

    public function index(OptionsRepository $optionsRepository)
    {
        //get banner
        $banner = $optionsRepository->findAllBy(['key' => 'banner']);
        $banner = $banner->sortBy('sub_key');

        return view('pages.index', compact('banner'));
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

    public function category()
    {
        return view('pages.category');
    }

    public function series()
    {
        return view('pages.series');
    }
}

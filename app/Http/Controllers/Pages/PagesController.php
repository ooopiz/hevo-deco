<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\HotNewsRepository;
use App\Repositories\OptionsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Database\Eloquent\Collection;
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

    public function index(OptionsRepository $optionsRepository, HotNewsRepository $hotNewsRepository)
    {
        //get banner
        $banner = $optionsRepository->findAllBy(['key' => 'banner']);
        $banner = $banner->sortBy('sub_key');

        //get news
        $newsItem = $hotNewsRepository->findAllBy([['id', '>', 0]]);
        $newsItem = $newsItem->sortByDesc('created_at');
        // rearrange index
        $newsItem = $newsItem->values();

        $news = new Collection();
        for($i=0; $i<=$newsItem->count(); $i=$i+3) {
            if (isset($newsItem[$i])) {
                $news->push($newsItem[$i]);
            }
            if (isset($newsItem[$i + 1])) {
                $news->push($newsItem[$i + 1]);
            }
            if (isset($newsItem[$i + 2])) {
                $news->push($newsItem[$i + 2]);
            }
        }

        return view('pages.index', compact('banner', 'news'));
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

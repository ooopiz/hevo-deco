<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\CategoryListsRepository;
use App\Repositories\SeriesListsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    /** @var SeriesRepository */
    private $seriesRepository;

    /** @var CategoryListsRepository */
    private $categoryListRepository;

    /** @var SeriesListsRepository */
    private $seriesListsRepository;

    public function __construct(CategoriesRepository $categoriesRepository,
                                SeriesRepository $seriesRepository,
                                CategoryListsRepository $categoryListsRepository,
                                SeriesListsRepository $seriesListsRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->seriesRepository = $seriesRepository;
        $this->categoryListRepository = $categoryListsRepository;
        $this->seriesListsRepository = $seriesListsRepository;
    }

    public function product()
    {
        $conditionCategory = array(['id', '>', 0], ['display', '=', 'Y']);
        $categories = $this->categoriesRepository->findAllBy($conditionCategory);

        $conditionSeries = array(['id', '>', 0], ['display', '=', 'Y']);
        $series = $this->seriesRepository->findAllBy($conditionSeries);

        // 載入關聯
        foreach($categories as $key => $cat) {
            $cat->load(['categoryList' => function ($query) {
                $query->orderBy('product_id', 'asc');
            }]);

            foreach($cat->categoryList as $k1 => $catList) {
                $catList->load('product');

                $catList->product->load(['materialImages' => function ($query) {
                    $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
                }]);
            }
        }

        // 載入關聯
        foreach($series as $key => $ser) {
            $ser->load(['seriesList' => function ($query) {
                $query->orderBy('product_id', 'asc');
            }]);

            foreach($ser->seriesList as $k1 => $serList) {
                $serList->load('product');

                $serList->product->load(['materialImages' => function ($query) {
                    $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
                }]);
            }
        }

//        foreach($categories as $key => $cat) {
//            var_dump($cat->categoryList->isEmpty());
//        }
//        dd();

//        $categoryLists = $this->categoryListRepository->findAllBy(array(['id', '>', 0]), ['category', 'product']);
//        $seriesLists = $this->seriesListsRepository->findAllBy(array(['id', '>', 0]), ['series', 'product']);
//        // load product images
//        foreach($categoryLists as $key => $catList) {
//            $catList->product->load(['materialImages' => function ($query) {
//                $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
//            }]);
//        }
//        foreach($seriesLists as $key => $serList) {
//            $serList->product->load(['materialImages' => function ($query) {
//                $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
//            }]);
//        }

        return view('pages.product', compact('categories', 'series'));
//        return view('pages.product', compact('categories', 'series', 'categoryLists', 'seriesLists'));
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

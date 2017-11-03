<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\CategoryListsRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SeriesListsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    /** @var SeriesRepository */
    private $seriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository,
                                SeriesRepository $seriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->seriesRepository = $seriesRepository;
    }

    public function index()
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

        return view('pages.product', compact('categories', 'series'));
    }

    public function productDetail($id = null, ProductsRepository $productsRepository)
    {
        $condition = array(['id', '=', $id], ['active', '=', 'Y']);
        $product = $productsRepository->findOneBy($condition);
        if (is_null($product)) {
            return redirect(URL_PRODUCT);
        }

        $product->load(['materialImages' => function ($query) {
            $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
        }]);

        return view('pages.product_detail', compact('product'));
    }
}

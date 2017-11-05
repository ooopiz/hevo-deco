<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\CategoryListsRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SeriesListsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Database\Eloquent\Collection;
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

    public function productDetail($id = null, ProductsRepository $productsRepository, CategoryListsRepository $categoryListsRepository)
    {
        $condition = array(['id', '=', $id], ['active', '=', 'Y']);
        $product = $productsRepository->findOneBy($condition);
        if (is_null($product)) {
            return redirect(URL_PRODUCT);
        }

        $product->load(['materialLists' => function ($query) {
            $query->orderBy('material_id', 'asc');
        }]);

        foreach($product->materialLists as $val) {
            $val->load('material');
        }

        $product->load(['materialImages' => function ($query) {
            $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
        }]);

        //同類別產品
        $categoryId = $categoryListsRepository->findOneBy(['product_id' => $product->id])->category_id;
        $sel = array(
            ['category_id', '=', $categoryId],
            ['product_id', '<>', $product->id]
        );
        $categoryLists = $categoryListsRepository->findAllBy($sel);
        $categoryCount = $categoryLists->count();

        $similarProduct = new Collection();
        if ($categoryCount == 0) {
            //
        } elseif (($categoryCount > 0) and ($categoryCount <=3)) {
            foreach($categoryLists as $val){
                $val->load('product');
                $val->product->load(['materialImages' => function ($query) {
                    $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
                }]);
                $similarProduct->push($val);
            }
        } else {
            $arr = $this->unique_rand(0, $categoryCount-1, 3);
            foreach($arr as $val) {
                $similarProduct->push($categoryLists[$val]);
            }
        }

        return view('pages.product_detail', compact('product', 'similarProduct'));
    }

    private function unique_rand($min, $max, $num) {
        $count = 0;
        $return = array();
        while ($count < $num) {
            $return[] = mt_rand($min, $max);
            $return = array_flip(array_flip($return));
            $count = count($return);
        }
        shuffle($return);
        return $return;
    }
}

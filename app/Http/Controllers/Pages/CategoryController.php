<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    /** @var SeriesRepository */
    private $seriesRepository;

    /**
     * CategoryController constructor.
     * @param CategoriesRepository $categoriesRepository
     * @param SeriesRepository $seriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository, SeriesRepository $seriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->seriesRepository = $seriesRepository;
    }

    public function index($id = null)
    {
        $category = $this->categoriesRepository->findOneById($id);
        if (is_null($category)) {
            return redirect(URL_PRODUCT);
        }
        // load relationship
        $category->load(['categoryList' => function ($query) {
            $query
                ->join('products', function ($join) {
                    $join->on('products.id', '=', 'category_lists.product_id')
                        ->where(array(['products.display', 'Y'], ['products.active', 'Y']));
                })
                ->orderBy('product_id', 'asc');
        }]);
        foreach($category->categoryList as $k1 => $catList) {
            $catList->load('product');

            $catList->product->load(['materialImages' => function ($query) {
                $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
            }]);
        }

        // left Nav
        $conditionCategory = array(['id', '>', 0], ['display', '=', 'Y']);
        $categoryNav = $this->categoriesRepository->findAllBy($conditionCategory);
        $conditionSeries = array(['id', '>', 0], ['display', '=', 'Y']);
        $seriesNav = $this->seriesRepository->findAllBy($conditionSeries);

        return view('pages.category', compact('categoryNav', 'seriesNav', 'category'));
    }
}

<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    /** @var SeriesRepository */
    private $seriesRepository;

    /** @var CategoriesRepository */
    private $categoriesRepository;

    /**
     * SeriesController constructor.
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
        $series = $this->seriesRepository->findOneById($id);
        if (is_null($series)) {
            return redirect(URL_PRODUCT);
        }
        // load relationship
        $series->load(['seriesList' => function ($query) {
            $query
                ->join('products', function ($join) {
                    $join->on('products.id', '=', 'series_lists.product_id')
                        ->where(array(['products.display', 'Y'], ['products.active', 'Y']));
                })
                ->orderBy('product_id', 'asc');
        }]);

        foreach ($series->seriesList as $k1 => $catList) {
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

        return view('pages.series', compact('categoryNav', 'seriesNav', 'series'));
    }
}
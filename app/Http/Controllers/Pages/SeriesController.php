<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesController extends Controller
{
    /** @var SeriesRepository */
    private $seriesRepository;

    /**
     * SeriesController constructor.
     * @param SeriesRepository $seriesRepository
     */
    public function __construct(SeriesRepository $seriesRepository)
    {
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
            $query->orderBy('product_id', 'asc');
        }]);
        foreach ($series->seriesList as $k1 => $catList) {
            $catList->load('product');

            $catList->product->load(['materialImages' => function ($query) {
                $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
            }]);
        }

        return view('pages.series', compact('series'));
    }
}
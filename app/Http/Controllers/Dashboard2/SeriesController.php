<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\SeriesListsRepository;
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

    public function doSaveSeries(Request $request)
    {
        $validateRules = array(
            'id' => 'required',
            'name' => 'required',
            'display' => 'required'
        );
        $request->validate($validateRules);

        $seriesID = $request->get('id');
        $seriesName = $request->get('name');
        $seriesDisplay = $request->get('display');
        $seriesDesc = $request->get('desc');
        $seriesDesc = is_null($seriesDesc) ? '' : $seriesDesc;

        $arrId = array('id' => $seriesID);
        $arrData = array(
            'name' => $seriesName,
            'desc' => $seriesDesc,
            'display' => $seriesDisplay
        );

        $category = $this->seriesRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD2_SERIES)
            ->with('message', array('class' => 'alert-success', 'content' => '存檔成功'));
    }

    public function doDelSeries(Request $request, SeriesListsRepository $seriesListsRepository)
    {
        $validateRules = array(
            'id' => 'required'
        );
        $request->validate($validateRules);

        $seriesId = $request->get('id');

        $seriesLists = $seriesListsRepository->findAllBy(['series_id' => $seriesId]);
        if ($seriesLists->count() > 0) {
            return redirect(URL_DASHBOARD2_SERIES)
                ->with('message', array('class' => 'alert-danger', 'content' => '目前有產品屬於該系列，無法刪除'));
        }

        $bool = $this->seriesRepository->delete(['id' => $seriesId]);
        return redirect(URL_DASHBOARD2_SERIES)
            ->with('message', array('class' => 'alert-success', 'content' => '刪除成功'));
    }
}

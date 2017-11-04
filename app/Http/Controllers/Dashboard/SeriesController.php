<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\SeriesListsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    /** @var SeriesRepository */
    private $seriesRepository;

    private $siteVar;

    private $loginUser;

    public function __construct(SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;

        $this->siteVar = array(
            'sn_prefix' => 'SER'
        );

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $condition = array(['id', '>', 0]);
        $series = $this->seriesRepository->findAllBy($condition);
//        $series = $series->sortByDesc('id');

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.series', compact('siteVar', 'loginUser', 'series'));
    }

    public function doEdit(Request $request)
    {
        $seriesID = $request->get('series_id');
        $seriesName = $request->get('series_name');
        $seriesDesc = $request->get('series_desc');
        $seriesDisplay = $request->get('series_display');

        $seriesDesc = is_null($seriesDesc) ? '' : $seriesDesc;

        $arrId = array('id' => $seriesID);
        $arrData = array(
            'name' => $seriesName,
            'desc' => $seriesDesc,
            'display' => $seriesDisplay
        );

        $series = $this->seriesRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD_SERIES);
    }

    public function doDelete(Request $request, SeriesListsRepository $seriesListsRepository)
    {
        $seriesId = $request->get('series_id');

        $seriesLists = $seriesListsRepository->findAllBy(['series_id' => $seriesId]);
        if ($seriesLists->count() > 0) {
            return response()->json(['status' => false, 'message' => '目前有產品屬於該系列，無法刪除']);
        }

        $bool = $this->seriesRepository->delete(['id' => $seriesId]);
        if ($bool) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'message' => 'delete fail ...']);
        }
    }
}

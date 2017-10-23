<?php

namespace App\Http\Controllers\Dashboard;

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
        $condition = array(['id', '>', 0], ['delete', '<>', 'Y']);
        $series = $this->seriesRepository->findAllBy($condition);
        $series = $series->sortByDesc('id');

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.series', compact('siteVar', 'loginUser', 'series'));
    }

    public function edit($id = null)
    {
        $loginUser = $this->loginUser;
        $siteVar = $this->siteVar;

        if (is_null($id)) {
            $series = $this->seriesRepository->getModel();
        } else {
            $series = $this->seriesRepository->findOneById($id);
        }
        return view('dashboard.series_edit', compact('siteVar', 'loginUser', 'series'));
    }

    public function doEdit(Request $request)
    {
        $seriesID = $request->get('series_id');
        $seriesName = $request->get('series_name');
        $seriesDesc = $request->get('series_desc');
        $seriesDisplay = $request->get('series_display');
        $seriesActive = $request->get('series_active');

        $seriesDesc = is_null($seriesDesc) ? '' : $seriesDesc;

        $arrId = array('id' => $seriesID);
        $arrData = array(
            'name' => $seriesName,
            'desc' => $seriesDesc,
            'display' => $seriesDisplay,
            'active' => $seriesActive,
            'delete' => 'N'
        );

        $series = $this->seriesRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD_SERIES);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /** @var MaterialRepository */
    private $materialRepository;

    private $siteVar;

    private $loginUser;

    /**
     * MaterialController constructor.
     * @param MaterialRepository $materialRepository
     */
    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;

        $this->siteVar = array(
            'sn_prefix' => 'MAT'
        );

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $condition = array(['id', '>', 0], ['delete', '<>', 'Y']);
        $materials = $this->materialRepository->findAllBy($condition);
        $materials = $materials->sortByDesc('id');

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.material', compact('siteVar', 'loginUser', 'materials'));
    }

    public function edit($id = null)
    {
        $loginUser = $this->loginUser;
        $siteVar = $this->siteVar;

        if (is_null($id)) {
            $material = $this->materialRepository->getModel();
        } else {
            $material = $this->materialRepository->findOneById($id);
        }
        return view('dashboard.material_edit', compact('siteVar', 'loginUser', 'material'));
    }

    public function doEdit(Request $request)
    {
        $materialID = $request->get('material_id');
        $materialName = $request->get('material_name');

        $arrId = array('id' => $materialID);
        $arrData = array(
            'name' => $materialName,
            'delete' => 'N'
        );

        $material = $this->materialRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD_MATERIAL);
    }
}

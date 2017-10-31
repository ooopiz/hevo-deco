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
        $condition = array(['id', '>', 0]);
        $materials = $this->materialRepository->findAllBy($condition);
        $materials = $materials->sortByDesc('id');

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.material', compact('siteVar', 'loginUser', 'materials'));
    }

    public function doEdit(Request $request)
    {
        $materialID = $request->get('material_id');
        $materialName = $request->get('material_name');

        $arrId = array('id' => $materialID);
        $arrData = array(
            'name' => $materialName,
        );

        $material = $this->materialRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD_MATERIAL);
    }

    public function doDelete(Request $request)
    {
        $materialId = $request->get('material_id');
        $bool = $this->materialRepository->delete(['id' => $materialId]);

        if ($bool) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

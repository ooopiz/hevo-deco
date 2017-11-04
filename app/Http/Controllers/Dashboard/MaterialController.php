<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\MaterialRepository;
use App\Services\ImageManageService;
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

    public function doEdit(Request $request, ImageManageService $imageManageService)
    {
        $materialID = is_null($request->get('material_id')) ? 0 : $request->get('material_id');
        $materialName = $request->get('material_name');

        if ((!$request->hasFile('material_image')) && $materialID == 0) {
            return 'Image require';
        }

        if ($request->hasFile('material_image')) {
            $newsImage = $request->file('material_image');
            $fileOriginalName = $newsImage->getClientOriginalName();
            $fileOriginalExtension = $newsImage->getClientOriginalExtension();
            $fileContents = file_get_contents($newsImage);
            $fileSaveName = uniqid("news_") . '.' . strtolower($fileOriginalExtension);

            $material = $this->materialRepository->findOneById($materialID);
            if (is_null($material)) {
                $res = $imageManageService->putMaterialImage($fileSaveName, $fileContents);
                if ($res['status']) {
                    $newImage = $res['file'];
                    $insertData = array(
                        'name' => $materialName,
                        'image_url' => $newImage
                    );
                    $this->materialRepository->createOne($insertData);
                }
            } else {
                $oldImage = $material->image_url;
                $res = $imageManageService->putMaterialImage($fileSaveName, $fileContents);
                if ($res['status']) {
                    $newImage = $res['file'];
                    $material->name = $materialName;
                    $material->image_url = $newImage;
                    $material->save();
                    $imageManageService->delMaterialImage($oldImage);
                }
            }
        } else {
            $material = $this->materialRepository->findOneById($materialID);
            if (!is_null($material)) {
                $material->name = $materialName;
                $material->save();
            }
        }

        return redirect(URL_DASHBOARD_MATERIAL);
    }

    public function doDelete(Request $request, ImageManageService $imageManageService)
    {
        $materialId = $request->get('material_id');
        $material = $this->materialRepository->findOneById($materialId);
        $imageUrl = $material->image_url;
        if ($material->delete()) {
            $imageManageService->delMaterialImage($imageUrl);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

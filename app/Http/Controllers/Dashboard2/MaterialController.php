<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\MaterialListsRepository;
use App\Repositories\MaterialRepository;
use App\Services\ImageManageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /** @var MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function index()
    {
        $materials = $this->materialRepository->all();
//        $materials = $materials->sortByDesc('id');
        return view('dashboard2.material', compact('materials'));
    }

    public function doSaveMaterial(Request $request, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'id' => 'required',
            'name' => 'required'
        );
        $request->validate($validateRules);

        $materialID = is_null($request->get('id')) ? 0 : $request->get('id');
        $materialName = $request->get('name');

        if ((!$request->hasFile('image')) && $materialID == 0) {
            return redirect(URL_DASHBOARD2_MATERIAL)
                ->with('message', array('class' => 'alert-danger', 'content' => '新增失敗 Image require'));
        }

        if ($request->hasFile('image')) {
            $newsImage = $request->file('image');
            $fileOriginalName = $newsImage->getClientOriginalName();
            $fileOriginalExtension = $newsImage->getClientOriginalExtension();
            $fileContents = file_get_contents($newsImage);
            $fileSaveName = uniqid("MAT_") . '.' . strtolower($fileOriginalExtension);

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

        return redirect(URL_DASHBOARD2_MATERIAL)
            ->with('message', array('class' => 'alert-success', 'content' => '存檔成功'));
    }

    public function doDelMaterial(Request $request, MaterialListsRepository $materialListsRepository, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'id' => 'required'
        );
        $request->validate($validateRules);

        $materialId = $request->get('id');

        $materialLists = $materialListsRepository->findAllBy(['material_id' => $materialId]);
        if ($materialLists->count() > 0) {
            return redirect(URL_DASHBOARD2_MATERIAL)
                ->with('message', array('class' => 'alert-danger', 'content' => '目前有產品屬於該材質，無法刪除'));
        }

        $material = $this->materialRepository->findOneById($materialId);
        $imageUrl = $material->image_url;
        if ($material->delete()) {
            $imageManageService->delMaterialImage($imageUrl);
        }

        return redirect(URL_DASHBOARD2_MATERIAL)
            ->with('message', array('class' => 'alert-success', 'content' => '刪除成功'));
    }
}

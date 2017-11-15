<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\HotNewsRepository;
use App\Services\ImageManageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotNewsController extends Controller
{
    /** @var HotNewsRepository */
    private $hotNewsRepsoitory;

    public function __construct(HotNewsRepository $hotNewsRepository)
    {
        $this->hotNewsRepsoitory = $hotNewsRepository;
    }

    public function index()
    {
        $hotNews = $this->hotNewsRepsoitory->all();
        return view('dashboard2.hotnews', compact('hotNews'));
    }

    public function doSaveNews(Request $request, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'id'=>'required'
        );
        $request->validate($validateRules);

        $newsId = is_null($request->get('id')) ? 0 : $request->get('id');
        $newsDesc = $request->get('desc');

        if ((!$request->hasFile('image')) && $newsId == 0) {
            return redirect(URL_DASHBOARD2_HOTNEWS)
                ->with('message', array('class' => 'alert-danger', 'content' => '新增失敗 Image require'));
        }

        if ($request->hasFile('image')) {
            $newsImage = $request->file('image');
            $fileOriginalName = $newsImage->getClientOriginalName();
            $fileOriginalExtension = $newsImage->getClientOriginalExtension();
            $fileContents = file_get_contents($newsImage);
            $fileSaveName = uniqid("news_") . '.' . strtolower($fileOriginalExtension);

            $hotNews = $this->hotNewsRepsoitory->findOneById($newsId);
            if (is_null($hotNews)) {
                $res = $imageManageService->putNewsImage($fileSaveName, $fileContents);
                if ($res['status']) {
                    $newImage = $res['file'];
                    $insertData = array(
                        'desc' => $newsDesc,
                        'image_url' => $newImage
                    );
                    $this->hotNewsRepsoitory->createOne($insertData);
                }
            } else {
                $oldImage = $hotNews->image_url;
                $res = $imageManageService->putNewsImage($fileSaveName, $fileContents);
                if ($res['status']) {
                    $newImage = $res['file'];
                    $hotNews->desc = $newsDesc;
                    $hotNews->image_url = $newImage;
                    $hotNews->save();
                    $imageManageService->delNewImage($oldImage);
                }
            }
        } else {
            $hotNews = $this->hotNewsRepsoitory->findOneById($newsId);
            if (!is_null($hotNews)) {
                $hotNews->desc = $newsDesc;
                $hotNews->save();
            }
        }

        return redirect(URL_DASHBOARD2_HOTNEWS);
    }

    public function doDelNews(Request $request, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'id'=>'required'
        );
        $request->validate($validateRules);

        $newsId = $request->get('id');

        $hotNews = $this->hotNewsRepsoitory->findOneById($newsId);
        $imageUrl = $hotNews->image_url;
        if ($hotNews->delete()) {
            $imageManageService->delNewImage($imageUrl);
        }
        return redirect(URL_DASHBOARD2_HOTNEWS)
            ->with('message', array('class' => 'alert-success', 'content' => '刪除成功'));
    }
}

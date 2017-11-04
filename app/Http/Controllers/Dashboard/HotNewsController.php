<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\HotNewsRepository;
use App\Services\ImageManageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HotNewsController extends Controller
{
    /** @var HotNewsRepository */
    private $hotNewsRepsoitory;

    private $siteVar;

    private $loginUser;

    /**
     * HotNewsController constructor.
     * @param HotNewsRepository $hotNewsRepository
     */
    public function __construct(HotNewsRepository $hotNewsRepository)
    {
        $this->hotNewsRepsoitory = $hotNewsRepository;

        $this->siteVar = array();

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $condition = array(['id', '>', 0]);
        $hotNews = $this->hotNewsRepsoitory->findAllBy($condition);

        $loginUser = $this->loginUser;
        return view('dashboard.hotnews', compact('loginUser', 'hotNews'));
    }

    public function doEdit(Request $request, ImageManageService $imageManageService)
    {
        if (!$request->has('news_desc')) {
            return 'Description require';
        }

        $newsId = is_null($request->get('news_id')) ? 0 : $request->get('news_id');
        $newsDesc = $request->get('news_desc');

        if ((!$request->hasFile('news_image')) && $newsId == 0) {
            return 'Image require';
        }

        if ($request->hasFile('news_image')) {
            $newsImage = $request->file('news_image');
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

        return redirect(URL_DASHBOARD_HOTNEWS);
    }

    public function doDelete(Request $request, ImageManageService $imageManageService)
    {
        $newsId = $request->get('news_id');
        $hotNews = $this->hotNewsRepsoitory->findOneById($newsId);
        $imageUrl = $hotNews->image_url;
        if ($hotNews->delete()) {
            $imageManageService->delNewImage($imageUrl);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

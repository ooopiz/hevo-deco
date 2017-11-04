<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\OptionsRepository;
use App\Services\ImageManageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /** @var OptionsRepository */
    private $optionsRepository;

    private $siteVar;

    private $loginUser;

    /**
     * BannerController constructor.
     * @param OptionsRepository $optionsRepository
     */
    public function __construct(OptionsRepository $optionsRepository)
    {
        $this->optionsRepository = $optionsRepository;

        $this->siteVar = array();

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $banner = $this->optionsRepository->findAllBy(['key' => 'banner']);
        $banner = $banner->keyBy('sub_key');

        $loginUser = $this->loginUser;
        return view('dashboard.banner', compact('loginUser', 'banner'));
    }

    public function doEdit(Request $request, ImageManageService $imageManageService)
    {
        if (!$request->hasFile('banner_image')) {
            return 'Image require';
        }
        if (!$request->has('banner_id')) {
            return 'banner_id require';
        }

        $bannerId = is_null($request->get('banner_id')) ? 0 : $request->get('banner_id');

        $newsImage = $request->file('banner_image');
        $fileOriginalName = $newsImage->getClientOriginalName();
        $fileOriginalExtension = $newsImage->getClientOriginalExtension();
        $fileContents = file_get_contents($newsImage);
        $fileSaveName = uniqid("banner_") . '.' . $fileOriginalExtension;

        $banner = $this->optionsRepository->findOneBy(['key' => 'banner', 'sub_key' => $bannerId]);
        if (is_null($banner)) {
            $res = $imageManageService->putBannerImage($fileSaveName, $fileContents);
            if ($res['status']) {
                $newImage = $res['file'];
                $insertData = array(
                    'key' => 'banner',
                    'sub_key' => $bannerId,
                    'value' => $newImage
                );
                $this->optionsRepository->createOne($insertData);
            }
        } else {
            $oldImage = $banner->value;
            $res = $imageManageService->putBannerImage($fileSaveName, $fileContents);
            if ($res['status']) {
                $newImage = $res['file'];
                $banner->value = $newImage;
                $banner->save();
                $imageManageService->delBannerImage($oldImage);
            }
        }
        return redirect(URL_DASHBOARD_BANNER);
    }

    public function doDelete(Request $request, ImageManageService $imageManageService)
    {
        $bannerId = $request->get('banner_id');
        $banner = $this->optionsRepository->findOneBy(['key' => 'banner', 'sub_key' => $bannerId]);
        $imageUrl = $banner->value;
        if ($banner->delete()) {
            $imageManageService->delBannerImage($imageUrl);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

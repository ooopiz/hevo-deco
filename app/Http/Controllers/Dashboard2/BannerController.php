<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\OptionsRepository;
use App\Services\ImageManageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /** @var OptionsRepository */
    private $optionsRepository;

    /**
     * BannerController constructor.
     * @param OptionsRepository $optionsRepository
     */
    public function __construct(OptionsRepository $optionsRepository)
    {
        $this->optionsRepository = $optionsRepository;
    }

    public function index()
    {
        $banner = $this->optionsRepository->findAllBy(['key' => 'banner']);
        $banner = $banner->keyBy('sub_key');
        return view('dashboard2.banner', compact('banner'));
    }

    public function doSaveBanner(Request $request, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'no'=>'required'
        );
        $request->validate($validateRules);

        if (!$request->hasFile('banner_image')) {
            return redirect(URL_DASHBOARD2_BANNER)
                ->with('message', array('class' => 'alert-warning', 'content' => '無上傳圖片'));
        }

        $bannerNo = $request->get('no');
        if (($bannerNo <= 0) && ($bannerNo > 5)) {
            return redirect(URL_DASHBOARD2_BANNER)
                ->with('message', array('class' => 'alert-warning', 'content' => 'banner no fail ...'));
        }

        $newsImage = $request->file('banner_image');
        $fileOriginalName = $newsImage->getClientOriginalName();
        $fileOriginalExtension = $newsImage->getClientOriginalExtension();
        $fileContents = file_get_contents($newsImage);
        $fileSaveName = uniqid("banner_") . '.' . $fileOriginalExtension;

        $banner = $this->optionsRepository->findOneBy(['key' => 'banner', 'sub_key' => $bannerNo]);
        if (is_null($banner)) {
            $res = $imageManageService->putBannerImage($fileSaveName, $fileContents);
            if ($res['status']) {
                $newImage = $res['file'];
                $insertData = array(
                    'key' => 'banner',
                    'sub_key' => $bannerNo,
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
        return redirect(URL_DASHBOARD2_BANNER)
            ->with('message', array('class' => 'alert-success', 'content' => '存檔成功'));
    }

    public function doDelBanner(Request $request, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'no'=>'required'
        );
        $request->validate($validateRules);

        $bannerId = $request->get('no');

        $banner = $this->optionsRepository->findOneBy(['key' => 'banner', 'sub_key' => $bannerId]);
        if (!is_null($banner)) {
            $imageUrl = $banner->value;
            if ($banner->delete()) {
                $imageManageService->delBannerImage($imageUrl);
            }
        }
        return redirect(URL_DASHBOARD2_BANNER)
            ->with('message', array('class' => 'alert-success', 'content' => '刪除成功'));
    }
}

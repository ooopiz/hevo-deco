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

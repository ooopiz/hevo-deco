<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\OptionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function doEdit(Request $request)
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
        $fileSaveName = uniqid("banner_") . '.' .$fileOriginalExtension;

        $uploaded = Storage::disk('public')->put('banner/' .$fileSaveName, $fileContents);
        if ($uploaded) {
            $imageUrl = 'banner/' . $fileSaveName;
            $arrSel = array(
                'key' => 'banner',
                'sub_key' => $bannerId,
            );
            $arrVal = array(
                'value' => $imageUrl
            );
            $this->optionsRepository->updateOrCreate($arrSel, $arrVal);
        }
        //TODO - delete original image

        return redirect(URL_DASHBOARD_BANNER);
    }

    public function doDelete(Request $request)
    {
        $bannerId = $request->get('banner_id');
        $banner = $this->optionsRepository->findOneBy(['key' => 'banner', 'sub_key' => $bannerId]);
        $imageUrl = $banner->value;
        if ($banner->delete()) {
            Storage::disk('public')->delete($imageUrl);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\HotNewsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $condition = array(['id', '>', 0], ['delete', '<>', 'Y']);
        $hotNews = $this->hotNewsRepsoitory->findAllBy($condition);

        $loginUser = $this->loginUser;
        return view('dashboard.hotnews', compact('loginUser', 'hotNews'));
    }

    public function doEdit(Request $request)
    {
        if (!$request->hasFile('news_image')) {
            return 'Image require';
        }
        if (!$request->has('news_desc')) {
            return 'Description require';
        }

        $newsId = is_null($request->get('news_id')) ? 0 : $request->get('news_id');
        $newsDesc = $request->get('news_desc');

        $newsImage = $request->file('news_image');
        $fileOriginalName = $newsImage->getClientOriginalName();
        $fileOriginalExtension = $newsImage->getClientOriginalExtension();
        $fileContents = file_get_contents($newsImage);
        $fileSaveName = uniqid("news_") . '.' .$fileOriginalExtension;

        $uploaded = Storage::disk('public')->put('news/' .$fileSaveName, $fileContents);
        if ($uploaded) {
            $imageUrl = 'news/' . $fileSaveName;
            $arrId = array('id' => $newsId);
            $arrData = array(
                'desc' => $newsDesc,
                'image_url' => $imageUrl,
                'delete' => 'N'
            );
            $this->hotNewsRepsoitory->updateOrCreate($arrId, $arrData);
        }
        //TODO - delete original image

        return redirect(URL_DASHBOARD_HOTNEWS);
    }

    public function doDelete(Request $request)
    {
        $newsId = $request->get('news_id');
        $hotNews = $this->hotNewsRepsoitory->findOneById($newsId);
        $imageUrl = $hotNews->image_url;
        if ($hotNews->delete()) {
            Storage::disk('public')->delete($imageUrl);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

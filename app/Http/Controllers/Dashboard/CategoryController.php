<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\CategoriesRepository;
use App\Repositories\CategoryListsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    private $siteVar;

    private $loginUser;

    /**
     * CategoryController constructor.
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;

        $this->siteVar = array(
            'sn_prefix' => 'CAT'
        );

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $condition = array(['id', '>', 0]);
        $categories = $this->categoriesRepository->findAllBy($condition);
//        $categories = $categories->sortByDesc('id');

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.category', compact('siteVar', 'loginUser', 'categories'));
    }

    public function doEdit(Request $request)
    {
        $categoryID = $request->get('category_id');
        $categoryName = $request->get('category_name');
        $categoryDesc = $request->get('category_desc');
        $categoryDisplay = $request->get('category_display');

        $categoryDesc = is_null($categoryDesc) ? '' : $categoryDesc;

        $arrId = array('id' => $categoryID);
        $arrData = array(
            'name' => $categoryName,
            'desc' => $categoryDesc,
            'display' => $categoryDisplay
        );

        $category = $this->categoriesRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD_CATEGORY);
    }

    public function doDelete(Request $request, CategoryListsRepository $categoryListsRepository)
    {
        $categoryId = $request->get('category_id');

        $categoryLists = $categoryListsRepository->findAllBy(['category_id' => $categoryId]);
        if ($categoryLists->count() > 0) {
            return response()->json(['status' => false, 'message' => '目前有產品屬於該類別，無法刪除']);
        }

        $bool = $this->categoriesRepository->delete(['id' => $categoryId]);
        if ($bool) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}

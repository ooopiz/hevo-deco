<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\CategoriesRepository;
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
        $condition = array(['id', '>', 0], ['delete', '<>', 'Y']);
        $categories = $this->categoriesRepository->findAllBy($condition);
        $categories = $categories->sortByDesc('id');

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.category', compact('siteVar', 'loginUser', 'categories'));
    }

    public function edit($id = null)
    {
        $loginUser = $this->loginUser;
        $siteVar = $this->siteVar;

        if (is_null($id)) {
            $category = $this->categoriesRepository->getModel();
        } else {
            $category = $this->categoriesRepository->findOneById($id);
        }
        return view('dashboard.category_edit', compact('siteVar', 'loginUser', 'category'));
    }

    public function doEdit(Request $request)
    {
        $categoryID = $request->get('category_id');
        $categoryName = $request->get('category_name');
        $categoryDesc = $request->get('category_desc');
        $categoryDisplay = $request->get('category_display');
        $categoryActive = $request->get('category_active');

        $arrId = array('id' => $categoryID);
        $arrData = array(
            'name' => $categoryName,
            'desc' => $categoryDesc,
            'display' => $categoryDisplay,
            'active' => $categoryActive,
            'delete' => 'N'
        );

        $category = $this->categoriesRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD_CATEGORY);
    }
}

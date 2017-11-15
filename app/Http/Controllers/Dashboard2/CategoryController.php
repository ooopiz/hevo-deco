<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\CategoriesRepository;
use App\Repositories\CategoryListsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index()
    {
        $categories = $this->categoriesRepository->all();
//        $categories = $categories->sortByDesc('id');
        return view('dashboard2.category', compact('categories'));
    }

    public function doSaveCategory(Request $request)
    {
        $validateRules = array(
            'id' => 'required',
            'name' => 'required',
            'display' => 'required'
        );
        $request->validate($validateRules);

        $categoryID = $request->get('id');
        $categoryName = $request->get('name');
        $categoryDisplay = $request->get('display');
        $categoryDesc = $request->get('desc');
        $categoryDesc = is_null($categoryDesc) ? '' : $categoryDesc;

        $arrId = array('id' => $categoryID);
        $arrData = array(
            'name' => $categoryName,
            'desc' => $categoryDesc,
            'display' => $categoryDisplay
        );

        $category = $this->categoriesRepository->updateOrCreate($arrId, $arrData);

        return redirect(URL_DASHBOARD2_CATEGORY)
            ->with('message', array('class' => 'alert-success', 'content' => '存檔成功'));
    }

    public function doDelCategory(Request $request, CategoryListsRepository $categoryListsRepository)
    {
        $validateRules = array(
            'id' => 'required'
        );
        $request->validate($validateRules);

        $categoryId = $request->get('id');
        $categoryLists = $categoryListsRepository->findAllBy(['category_id' => $categoryId]);
        if ($categoryLists->count() > 0) {
            return redirect(URL_DASHBOARD2_CATEGORY)
                ->with('message', array('class' => 'alert-danger', 'content' => '目前有產品屬於該類別，無法刪除'));
        }

        $bool = $this->categoriesRepository->delete(['id' => $categoryId]);
        return redirect(URL_DASHBOARD2_CATEGORY)
            ->with('message', array('class' => 'alert-success', 'content' => '刪除成功'));
    }
}

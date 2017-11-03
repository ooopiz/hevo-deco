<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\CategoriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /** @var CategoriesRepository */
    private $categoriesRepository;

    /**
     * CategoryController constructor.
     * @param CategoriesRepository $categoriesRepository
     */
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index($id = null)
    {
        $category = $this->categoriesRepository->findOneById($id);
        if (is_null($category)) {
            return redirect(URL_PRODUCT);
        }

        // load relationship
        $category->load(['categoryList' => function ($query) {
            $query->orderBy('product_id', 'asc');
        }]);
        foreach($category->categoryList as $k1 => $catList) {
            $catList->load('product');

            $catList->product->load(['materialImages' => function ($query) {
                $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
            }]);
        }

        return view('pages.category', compact('category'));
    }
}

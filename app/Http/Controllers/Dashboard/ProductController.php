<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\CategoriesRepository;
use App\Repositories\CategoryListsRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SeriesListsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /** @var ProductsRepository */
    private $productsRepository;

    /** @var CategoriesRepository */
    private $categoriesRepository;

    /** @var SeriesRepository */
    private $seriesRepository;

    /** @var CategoryListsRepository */
    private $categoryListsRepository;

    /** @var SeriesListsRepository */
    private $seriesListsRepository;

    private $siteVar;

    private $loginUser;

    /**
     * ProductController constructor.
     * @param ProductsRepository $productsRepository
     * @param CategoriesRepository $categoriesRepository
     * @param SeriesRepository $seriesRepository
     * @param CategoryListsRepository $categoryListsRepository
     * @param SeriesListsRepository $seriesListsRepository
     */
    public function __construct(ProductsRepository $productsRepository,
                                CategoriesRepository $categoriesRepository,
                                SeriesRepository $seriesRepository,
                                CategoryListsRepository $categoryListsRepository,
                                SeriesListsRepository $seriesListsRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->seriesRepository = $seriesRepository;
        $this->categoryListsRepository = $categoryListsRepository;
        $this->seriesListsRepository = $seriesListsRepository;

        $this->siteVar = array(
            'sn_prefix' => 'SN'
        );

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $condition = array(['id', '>', 0], ['delete', '<>', 'Y']);
        $products = $this->productsRepository->findAllBy($condition, ['categoryLists', 'seriesLists']);
        $products = $products->sortByDesc('id');

        foreach($products as $key => $product)
        {
            foreach($product->categoryLists as $kk => $categoryList){
                $categoryList->load('category');
                $categoryList->load('category');
            }
        }

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.product', compact('siteVar', 'loginUser', 'products'));
    }

    public function edit($id = null)
    {
        $loginUser = $this->loginUser;
        $siteVar = $this->siteVar;

        $arrCat = array(['id', '>', 0], ['active', '=', 'Y'], ['delete', '<>', 'Y']);
        $categories = $this->categoriesRepository->findAllBy($arrCat);
        $arrSer = array(['id', '>', 0], ['active', '=', 'Y'], ['delete', '<>', 'Y']);
        $series = $this->seriesRepository->findAllBy($arrSer);

        if (is_null($id)) {
            $product = $this->productsRepository->getModel();
            $categoryList = $this->categoryListsRepository->getModel();
            $seriesList = $this->seriesListsRepository->getModel();
        } else {
            $product = $this->productsRepository->findOneById($id);
            $categoryList = $this->categoryListsRepository->findOneBy(['product_id' => $id]);
            $seriesList = $this->seriesListsRepository->findOneBy(['product_id' => $id]);
        }
        return view('dashboard.product_edit', compact('siteVar', 'loginUser', 'product', 'categories', 'series', 'categoryList', 'seriesList'));
    }

    public function doEdit(Request $request)
    {
        $productID = $request->get('product_id');
        $productName = $request->get('product_name');
        $productDesc = $request->get('product_desc');
        $productDisplay = $request->get('product_display');
        $productActive = $request->get('product_active');
        $categoryIds = $request->get('category_ids');
        $seriesIds = $request->get('series_ids');

        $productDesc = is_null($productDesc) ? '' : $productDesc;

        $arrId = array('id' => $productID);
        $arrData = array(
            'name' => $productName,
            'desc' => $productDesc,
            'display' => $productDisplay,
            'active' => $productActive,
            'delete' => 'N',
        );
        $product = $this->productsRepository->updateOrCreate($arrId, $arrData);

        $this->categoryListsRepository->delete(['product_id' => $product->id]);
        $arrCat = array('category_id' => $categoryIds, 'product_id' => $product->id);
        $categoryLists = $this->categoryListsRepository->createOne($arrCat);

        $this->seriesListsRepository->delete(['product_id' => $product->id]);
        $arrSer = array('series_id' => $seriesIds, 'product_id' => $product->id);
        $seriesLists = $this->seriesListsRepository->createOne($arrSer);

        return redirect(URL_DASHBOARD_PRODUCT);
    }
}

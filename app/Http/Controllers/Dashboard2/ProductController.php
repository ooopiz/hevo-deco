<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\CategoryListsRepository;
use App\Repositories\MaterialImagesRepository;
use App\Repositories\MaterialListsRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SeriesListsRepository;
use App\Services\ImageManageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /** @var ProductsRepository */
    private $productsRepository;

    /** @var CategoryListsRepository */
    private $categoryListsRepository;

    /** @var SeriesListsRepository */
    private $seriesListsRepository;

    /** @var MaterialListsRepository */
    private $materialListsRepository;

    /** @var MaterialImagesRepository */
    private $materialImagesRepository;

    public function __construct(
        ProductsRepository $productsRepository,
        CategoryListsRepository $categoryListsRepository,
        SeriesListsRepository $seriesListsRepository,
        MaterialListsRepository $materialListsRepository,
        MaterialImagesRepository $materialImagesRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->categoryListsRepository = $categoryListsRepository;
        $this->seriesListsRepository = $seriesListsRepository;
        $this->materialListsRepository = $materialListsRepository;
        $this->materialImagesRepository = $materialImagesRepository;
    }

    public function index()
    {
        $products = $this->productsRepository->all();
        return view('dashboard2.product', compact('products'));
    }

    public function product($id=0)
    {
        $product = $this->productsRepository->findOneById($id);
        if (is_null($product)) {
            return redirect(URL_DASHBOARD2_PRODUCT)
                ->with('message', array('class' => 'alert-danger', 'content' => '查無此商品'));
        }
        return view('dashboard2.product_edit', compact('product'));
    }

    public function newProduct()
    {
        return view('dashboard2.product_edit');
    }

    public function doSaveProduct(Request $request)
    {
        $validateRules = array(
            'id' => 'regex:/^\d+$/',
            'name'=>'required|max:100',
            'subtitle'=>'required|max:100',
            'length'=>'required|regex:/^\d*\.?\d+$/',
            'width'=>'required|regex:/^\d*\.?\d+$/',
            'height'=>'required|regex:/^\d*\.?\d+$/',
            'display'=>'required|regex:/[YN]/',
            'active'=>'required|regex:/[YN]/',
            'content'=>'max:500',

            'category_ids'=>'required',
            'series_ids'=>'required',
        );
        $request->validate($validateRules);

        $productID = $request->has('id') ? $request->get('id') : 0;
        $productID = is_null($productID) ? 0 : $productID;
        $productName = $request->get('name');
        $productSubtitle = $request->get('subtitle');
        $productContent = $request->has('content') ? $request->get('content') : '';
        $productContent = is_null($productContent) ? '' : $productContent;
        $productLength = $request->get('length');
        $productWidth = $request->get('width');
        $productHeight = $request->get('height');
        $productDisplay = $request->get('display');
        $productActive = $request->get('active');

        $categoryIds = $request->get('category_ids');
        $seriesIds = $request->get('series_ids');

        $arrId = array('id' => $productID);
        $arrData = array(
            'name' => $productName,
            'subtitle' => $productSubtitle,
            'content' => $productContent,
            'length' => $productLength,
            'width' => $productWidth,
            'height' => $productHeight,
            'display' => $productDisplay,
            'active' => $productActive,
            'delete' => 'N',
        );

        //TODO transaction
        $product = $this->productsRepository->updateOrCreate($arrId, $arrData);

        $this->categoryListsRepository->delete(['product_id' => $product->id]);
        $arrCat = array('category_id' => $categoryIds, 'product_id' => $product->id);
        $categoryLists = $this->categoryListsRepository->createOne($arrCat);

        $this->seriesListsRepository->delete(['product_id' => $product->id]);
        $arrSer = array('series_id' => $seriesIds, 'product_id' => $product->id);
        $seriesLists = $this->seriesListsRepository->createOne($arrSer);

        return redirect(URL_DASHBOARD2_PRODUCT)
            ->with('message', array('class' => 'alert-success', 'content' => '儲存成功'));
    }

    public function doDelProduct(Request $request, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'id'=>'required'
        );
        $request->validate($validateRules);

        $productId = $request->get('id');

        //TODO
        // 1. transaction
        $this->productsRepository->delete(['id' => $productId]);
        $this->categoryListsRepository->delete(['product_id' => $productId]);
        $this->seriesListsRepository->delete(['product_id' => $productId]);
        $this->materialListsRepository->delete(['product_id' => $productId]);
        $materialImages = $this->materialImagesRepository->findAllBy(['product_id' => $productId]);
        $this->materialImagesRepository->delete(['product_id' => $productId]);
        foreach ($materialImages as $materialImage) {
            $imageManageService->delProductImage($materialImage->image_url);
        }

        return redirect(URL_DASHBOARD2_PRODUCT)
            ->with('message', array('class' => 'alert-success', 'content' => '刪除成功'));
    }
}

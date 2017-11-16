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

    public function productMaterial($id=0)
    {
        $product = $this->productsRepository->findOneById($id);
        if (is_null($product)) {
            return redirect(URL_DASHBOARD2_PRODUCT)
                ->with('message', array('class' => 'alert-danger', 'content' => '查無此商品'));
        }

        $materialLists = $this->materialListsRepository->findAllBy(['product_id' => $id]);
        // 載入關聯
        foreach($materialLists as $materialList) {
            $materialList->load(['materialImages' => function ($query) {
                $query->orderBy('material_id', 'asc')->orderBy('order', 'asc');
            }]);
        }
        return view('dashboard2.product_material', compact('product', 'materialLists'));
    }

    public function doAddMaterial(Request $request)
    {
        $validateRules = array(
            'product_id'=>'required',
            'material_id'=>'required'
        );
        $request->validate($validateRules);

        $productId = $request->get('product_id');
        $materialId = $request->get('material_id');

        $arrData = array(
            'product_id' => $productId,
            'material_id' => $materialId
        );
        $bool = $this->materialListsRepository->insertOne($arrData);

        $message = $bool ? '新增成功' : '新增失敗';
        $class = $bool ? 'alert-success' : 'alert-danger';
        return redirect()->back()
            ->with('message', array('class' => $class, 'content' => $message));
    }

    public function doDelMaterial(Request $request, ImageManageService $imageManageService)
    {
        $validateRules = array(
            'id'=>'required',
        );
        $request->validate($validateRules);

        $materialListId = $request->get('id');
        $bool = $this->materialListsRepository->delete(['id' => $materialListId]);
        $materialImages = $this->materialImagesRepository->findAllBy(['material_list_id' => $materialListId]);
        foreach ($materialImages as $val){
            $imageManageService->delProductImage($val->image_url);
            $val->delete();
        }

        $message = $bool ? '刪除成功' : '刪除失敗';
        $class = $bool ? 'alert-success' : 'alert-danger';
        return redirect()->back()
            ->with('message', array('class' => $class, 'content' => $message));
    }

    public function uploadImg(Request $request, ImageManageService $imageManageService)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['status' => false, 'message' => 'require file']);
        }

        $materialListId = $request->get('material_list_id');
        $productId = $request->get('product_id');
        $materialId = $request->get('material_id');

        if (is_null($productId) || is_null($materialId) || is_null($materialListId)) {
            return response()->json(['status' => false, 'message' => 'params fail ...']);
        }

        if ($request->hasFile('file')) {
            $newsImage = $request->file('file');
            $fileOriginalName = $newsImage->getClientOriginalName();
            $fileOriginalExtension = $newsImage->getClientOriginalExtension();
            $fileContents = file_get_contents($newsImage);
            $fileSaveName = uniqid($productId . "_" . $materialId . "_") . '.' . $fileOriginalExtension;

            $res = $imageManageService->putProductImage($fileSaveName, $fileContents);
            if ($res['status']) {
                $newImage = $res['file'];

                $order = 999;
                $arrData = array([
                    'material_list_id' => $materialListId,
                    'product_id' => $productId,
                    'material_id' => $materialId,
                    'order' => $order,
                    'image_url' => $newImage
                ]);
                $this->materialImagesRepository->insertOne($arrData);
            }
        }

        return response()->json(['status' => true]);
    }

    public function deleteImg(Request $request, ImageManageService $imageManageService)
    {
        $id = $request->get('id');

        $materialImages = $this->materialImagesRepository->findOneById($id);
        $imageManageService->delProductImage($materialImages->image_url);
        $materialImages->delete();

        return response()->json(['status' => true]);
    }

    public function resort(Request $request)
    {
        $arrMaterialImageId = $request->get('material_arr');
        $i = 1;
        foreach($arrMaterialImageId as $val) {
            $materialImage = $this->materialImagesRepository->findOneById($val);
            $materialImage->order = $i;
            $materialImage->save();
            $i++;
        }
        return response()->json(['status' => true]);
    }
}

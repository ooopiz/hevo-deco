<?php

namespace App\Http\Controllers\Dashboard;

use App\Repositories\CategoriesRepository;
use App\Repositories\CategoryListsRepository;
use App\Repositories\MaterialImagesRepository;
use App\Repositories\MaterialListsRepository;
use App\Repositories\MaterialRepository;
use App\Repositories\ProductsRepository;
use App\Repositories\SeriesListsRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    /** @var MaterialRepository */
    private $materialRepository;

    /** @var MaterialListsRepository */
    private $materialListsRepository;

    /** @var MaterialImagesRepository */
    private $materialImagesRepository;

    private $siteVar;

    private $loginUser;

    /**
     * ProductController constructor.
     * @param ProductsRepository $productsRepository
     * @param CategoriesRepository $categoriesRepository
     * @param SeriesRepository $seriesRepository
     * @param CategoryListsRepository $categoryListsRepository
     * @param SeriesListsRepository $seriesListsRepository
     * @param MaterialRepository $materialRepository
     * @param MaterialListsRepository $materialListsRepository
     * @param MaterialImagesRepository $materialImagesRepository
     */
    public function __construct(ProductsRepository $productsRepository,
                                CategoriesRepository $categoriesRepository,
                                SeriesRepository $seriesRepository,
                                CategoryListsRepository $categoryListsRepository,
                                SeriesListsRepository $seriesListsRepository,
                                MaterialRepository $materialRepository,
                                MaterialListsRepository$materialListsRepository,
                                MaterialImagesRepository $materialImagesRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->seriesRepository = $seriesRepository;
        $this->categoryListsRepository = $categoryListsRepository;
        $this->seriesListsRepository = $seriesListsRepository;
        $this->materialRepository = $materialRepository;
        $this->materialListsRepository = $materialListsRepository;
        $this->materialImagesRepository = $materialImagesRepository;

        $this->siteVar = array(
            'sn_prefix' => 'SN',
            'mat_prefix' => 'MAT'
        );

        $this->middleware(function ($request, $next) {
            $this->loginUser = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        $condition = array(['id', '>', 0]);
        $products = $this->productsRepository->findAllBy($condition, ['categoryLists', 'seriesLists']);
        $products = $products->sortByDesc('id');

        foreach($products as $key => $product) {
            foreach($product->categoryLists as $kk => $categoryList){
                $categoryList->load('category');
            }
            foreach($product->seriesLists as $kk => $seriesList){
                $seriesList->load('series');
            }
        }

        $categories = $this->categoriesRepository->findAllBy(array(['id', '>', 0]));
        $series = $this->seriesRepository->findAllBy(array(['id', '>', 0]));
        $materials = $this->materialRepository->findAllBy(array(['id', '>', 0]));

        $siteVar = $this->siteVar;
        $loginUser = $this->loginUser;
        return view('dashboard.product', compact(
            'siteVar',
            'loginUser',
            'products',
            'categories',
            'series',
            'materials'
        ));
    }

    public function doEdit(Request $request)
    {
        $productID = $request->get('product_id');
        $productName = $request->get('product_name');
        $productSubtitle = $request->get('product_subtitle');
        $productContent = $request->get('product_content');
        $productLength = $request->get('product_length');
        $productWidth = $request->get('product_width');
        $productHeight = $request->get('product_height');
        $productDisplay = $request->get('product_display');
        $productActive = $request->get('product_active');
        $categoryIds = $request->get('category_ids');
        $seriesIds = $request->get('series_ids');

        $productContent = is_null($productContent) ? '' : $productContent;

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
        $product = $this->productsRepository->updateOrCreate($arrId, $arrData);

        $this->categoryListsRepository->delete(['product_id' => $product->id]);
        $arrCat = array('category_id' => $categoryIds, 'product_id' => $product->id);
        $categoryLists = $this->categoryListsRepository->createOne($arrCat);

        $this->seriesListsRepository->delete(['product_id' => $product->id]);
        $arrSer = array('series_id' => $seriesIds, 'product_id' => $product->id);
        $seriesLists = $this->seriesListsRepository->createOne($arrSer);

        return redirect(URL_DASHBOARD_PRODUCT);
    }

    public function doDelete(Request $request)
    {
        $productId = $request->get('product_id');
        $bool = $this->productsRepository->delete(['id' => $productId]);

        if ($bool) {
            $this->categoryListsRepository->delete(['product_id' => $productId]);
            $this->seriesListsRepository->delete(['product_id' => $productId]);

            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function getMaterialList(Request $request)
    {
        $product_id = $request->get('product_id');
        $materials = $this->materialRepository->findAllBy(array(['id', '>', 0]));
        $materialList = $this->materialListsRepository->findAllBy(['product_id' => $product_id], 'material');

        // 過濾掉已經有的材質
        $arrFilter = array();
        foreach($materialList as $key => $val) {
            array_push($arrFilter, $val->material_id);
        }
        $materials = $materials->whereNotIn('id', $arrFilter);
        $materials = $materials->values();

        $result = array(
            'status' => true,
            'material_list' => $materialList,
            'materials' => $materials
        );
        return response()->json($result);
    }

    public function addMaterialList(Request $request)
    {
        $product_id = $request->get('product_id');
        $material_id = $request->get('material_id');

        $arrData = array(
            'material_id' => $material_id,
            'product_id' => $product_id
        );

        $bool = $this->materialListsRepository->insertOne($arrData);

        if ($bool) {
            $materials = $this->materialRepository->findAllBy(array(['id', '>', 0]));
            $materialList = $this->materialListsRepository->findAllBy(['product_id' => $product_id], 'material');

            // 過濾掉已經有的材質
            $arrFilter = array();
            foreach($materialList as $key => $val) {
                array_push($arrFilter, $val->material_id);
            }
            $materials = $materials->whereNotIn('id', $arrFilter);
            $materials = $materials->values();

            $result = array(
                'status' => true,
                'material_list' => $materialList,
                'materials' => $materials
            );

            return response()->json($result);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function doDeleteMaterial(Request $request) {
        $product_id = $request->get('product_id');
        $material_id = $request->get('material_id');
        $arr = array(
            'product_id' => $product_id,
            'material_id' => $material_id
        );
        $bool = $this->materialListsRepository->delete($arr);
        if ($bool) {
            $materials = $this->materialRepository->findAllBy(array(['id', '>', 0]));
            $materialList = $this->materialListsRepository->findAllBy(['product_id' => $product_id], 'material');

            // 過濾掉已經有的材質
            $arrFilter = array();
            foreach($materialList as $key => $val) {
                array_push($arrFilter, $val->material_id);
            }
            $materials = $materials->whereNotIn('id', $arrFilter);
            $materials = $materials->values();

            $result = array(
                'status' => true,
                'material_list' => $materialList,
                'materials' => $materials
            );

            return response()->json($result);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function uploadImg(Request $request)
    {
        if (!$request->hasFile('material_image')) {
            return response()->json(['status' => false, 'message' => 'require file']);
        }

        $materialListId = $request->get('material_list_id');
        $productId = $request->get('product_id');
        $materialId = $request->get('material_id');

        if (is_null($productId) || is_null($materialId) || is_null($materialListId)) {
            return response()->json(['status' => false, 'message' => 'params fail ...']);
        }

        $file = $request->file('material_image');
        $fileOriginalName = $file->getClientOriginalName();
        $fileOriginalExtension = $file->getClientOriginalExtension();
        $fileContents = file_get_contents($file);
        $fileSaveName = uniqid($productId . "_" . $materialId . "_") . '.' . strtolower($fileOriginalExtension);
        $imageUrl = 'material/' . $fileSaveName;

        $uploaded = Storage::disk('public')->put($imageUrl, $fileContents);
        if ($uploaded) {
            $materialImage = $this->materialImagesRepository->findAllBy(['product_id' => $productId, 'material_id' => $materialId]);
            if (is_null($materialImage)) {
                $order = 1;
            } else {
                $order = $materialImage->max('order') + 1;
            }

            $arrData = array([
                'material_list_id' => $materialListId,
                'product_id' => $productId,
                'material_id' => $materialId,
                'order' => $order,
                'image_url' => $imageUrl
            ]);

            $this->materialImagesRepository->insertOne($arrData);
        } else {
            return response()->json(['status' => false, 'message' => 'upload fail ...']);
        }

        return response()->json(['status' => true]);
    }

    public function deleteImg(Request $request)
    {
        $productId = $request->get('product_id');
        $materialId = $request->get('material_id');
        $order = $request->get('order');

        $condition = array(
            'product_id' => $productId,
            'material_id' => $materialId
        );
        $materialImages = $this->materialImagesRepository->findAllBy($condition);
        $materialImages = $materialImages->sortBy('order');
        $i = 1;
        foreach($materialImages as $key => $val) {

            if ($val->order == $order) {
                $val->delete();
                continue;
            }
            if ($i != $val->order) {
                $val->order = $i;
                $val->save();
            }
            $i++;
        }

        return response()->json(['status' => true]);
    }

    public function getImg(Request $request)
    {
        $productId = $request->get('product_id');
        $materialId = $request->get('material_id');
        $materialImage = $this->materialImagesRepository->findAllBy(['product_id' => $productId, 'material_id' => $materialId]);

        $response = array(
            'status' => true,
            'material_images' => $materialImage
        );
        return response()->json($response);
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

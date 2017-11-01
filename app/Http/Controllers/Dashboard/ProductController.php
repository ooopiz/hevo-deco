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

    public function addMaterial(Request $request)
    {
        $product_id = $request->get('product_id');
        $material_id = $request->get('material_id');

        $arrData = array(
            'material_id' => $material_id,
            'product_id' => $product_id
        );

        $bool = $this->materialListsRepository->insertOne($arrData);

        return redirect(URL_DASHBOARD_PRODUCT);
    }

    public function uploadImg(Request $request)
    {dd($request->all());
        if (!$request->hasFile('file')) {
            return response()->json(['status' => false]);
        }

        $productId = $request->get('product_id');
        $materialId = $request->get('material_id');

        if (is_null($productId) || is_null($materialId)) {
            return response()->json(['status' => false, 'message' => 'params fail ...']);
        }

        //判此產品材質是否存在
        $materialList = $this->materialListsRepository->findOneBy(['product_id' => $productId, 'material_id' => $materialId]);
        if (is_null($materialList)) {
            return response()->json(['status' => false, 'message' => 'don\'t have this material ']);
        }

        $file = $request->file('file');
        $fileOriginalName = $file->getClientOriginalName();
        $fileOriginalExtension = $file->getClientOriginalExtension();
        $fileContents = file_get_contents($file);
        $fileSaveName = uniqid($productId . "_" . $materialId . "_") . '.' .$fileOriginalExtension;

        $uploaded = Storage::disk('public')->put($fileSaveName, $fileContents);
        if ($uploaded) {
            $materialImage = $this->materialImagesRepository->findAllBy(['product_id' => $productId, 'material_id' => $materialId]);
            if (is_null($materialImage)) {
                $order = 1;
            } else {
                $order = $materialImage->max('order') + 1;
            }

            $imageUrl = '/storage/' . $fileSaveName;
            $arrData = array([
                'material_list_id' => $materialList->id,
                'product_id' => $productId,
                'material_id' => $materialId,
                'order' => $order,
                'image_url' => $imageUrl
            ]);

            $this->materialImagesRepository->insertOne($arrData);
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
            'value' => $materialImage
        );
        return response()->json($response);
    }
}

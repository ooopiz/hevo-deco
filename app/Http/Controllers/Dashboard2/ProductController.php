<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /** @var ProductsRepository */
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function index()
    {
        $products = $this->productsRepository->all();
        return view('dashboard2.product', compact('products'));
    }
}

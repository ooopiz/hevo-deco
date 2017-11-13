<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\CategoriesRepository;
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
}

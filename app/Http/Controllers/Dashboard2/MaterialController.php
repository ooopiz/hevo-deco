<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /** @var MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function index()
    {
        $materials = $this->materialRepository->all();
//        $materials = $materials->sortByDesc('id');
        return view('dashboard2.material', compact('materials'));
    }
}

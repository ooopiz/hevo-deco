<?php

namespace App\Http\Controllers\Dashboard2;

use App\Repositories\OptionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /** @var OptionsRepository */
    private $optionsRepository;

    /**
     * BannerController constructor.
     * @param OptionsRepository $optionsRepository
     */
    public function __construct(OptionsRepository $optionsRepository)
    {
        $this->optionsRepository = $optionsRepository;
    }

    public function index()
    {
        $banner = $this->optionsRepository->findAllBy(['key' => 'banner']);
        $banner = $banner->keyBy('sub_key');
        return view('dashboard2.banner', compact('banner'));
    }
}

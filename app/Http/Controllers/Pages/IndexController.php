<?php

namespace App\Http\Controllers\Pages;

use App\Repositories\HotNewsRepository;
use App\Repositories\OptionsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(OptionsRepository $optionsRepository, HotNewsRepository $hotNewsRepository)
    {
        //get banner
        $banner = $optionsRepository->findAllBy(['key' => 'banner']);
        $banner = $banner->sortBy('sub_key');

        //get news
        $newsItem = $hotNewsRepository->findAllBy([['id', '>', 0]]);
        $newsItem = $newsItem->sortByDesc('created_at');
        // rearrange index
        $newsItem = $newsItem->values();

        $news = new Collection();
        for($i=0; $i<=$newsItem->count(); $i=$i+3) {
            if (isset($newsItem[$i])) {
                $news->push($newsItem[$i]);
            }
            if (isset($newsItem[$i + 1])) {
                $news->push($newsItem[$i + 1]);
            }
            if (isset($newsItem[$i + 2])) {
                $news->push($newsItem[$i + 2]);
            }
        }

        return view('pages.index', compact('banner', 'news'));
    }
}

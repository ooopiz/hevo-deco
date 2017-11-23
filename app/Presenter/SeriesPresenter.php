<?php

namespace App\Presenter;

use App\Eloquent\Series;
use App\Repositories\SeriesRepository;

class SeriesPresenter
{
    public function seriesOptions()
    {
        $seriesRepository = new SeriesRepository(new Series());
        return $seriesRepository->all();
    }
}
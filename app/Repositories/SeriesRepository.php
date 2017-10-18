<?php

namespace App\Repositories;

use App\Eloquent\Series;

class SeriesRepository extends AbstractRepository
{
    protected $model;

    /** @var Series */
    private $series;

    /**
     * SeriesRepository constructor.
     * @param Series $series
     */
    public function __construct(Series $series)
    {
        $this->model = $this->series = $series;
    }
}
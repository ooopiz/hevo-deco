<?php

namespace App\Repositories;

use App\Eloquent\SeriesList;

class SeriesListsRepository extends AbstractRepository
{
    protected $model;

    /** @var SeriesList */
    private $seriesList;

    public function __construct(SeriesList $seriesList)
    {
        $this->model = $this->seriesList = $seriesList;
    }
}
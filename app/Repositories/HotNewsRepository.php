<?php

namespace App\Repositories;

use App\Eloquent\HotNews;

class HotNewsRepository extends AbstractRepository
{
    protected $model;

    /** @var HotNews */
    private $hotNews;

    /**
     * HotNewsRepository constructor.
     * @param HotNews $hotNews
     */
    public function __construct(HotNews $hotNews)
    {
        $this->model = $this->hotNews = $hotNews;
    }
}
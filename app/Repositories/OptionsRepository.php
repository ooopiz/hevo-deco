<?php

namespace App\Repositories;


use App\Eloquent\Option;

class OptionsRepository extends AbstractRepository
{
    protected $model;

    /** @var Option */
    private $option;

    /**
     * ProductsRepository constructor.
     * @param Option $option
     */
    public function __construct(Option $option)
    {
        $this->model = $this->option = $option;
    }
}
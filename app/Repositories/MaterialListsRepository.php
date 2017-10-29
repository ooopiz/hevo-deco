<?php

namespace App\Repositories;

use App\Eloquent\MaterialList;

class MaterialListsRepository extends AbstractRepository
{
    protected $model;

    /** @var MaterialList */
    private $materialList;

    public function __construct(MaterialList $materialList)
    {
        $this->model = $this->materialList = $materialList;
    }
}
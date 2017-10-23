<?php

namespace App\Repositories;

use App\Eloquent\Material;

class MaterialRepository extends AbstractRepository
{
    protected $model;

    /** @var Material */
    private $material;

    public function __construct(Material $material)
    {
        $this->model = $this->material = $material;
    }
}
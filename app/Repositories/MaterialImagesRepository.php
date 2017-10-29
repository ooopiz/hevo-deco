<?php

namespace App\Repositories;

use App\Eloquent\MaterialImage;

class MaterialImagesRepository extends AbstractRepository
{
    protected $model;

    /** @var MaterialImage */
    private $materialImage;

    public function __construct(MaterialImage $materialImage)
    {
        $this->model = $this->materialImage = $materialImage;
    }
}
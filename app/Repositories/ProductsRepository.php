<?php

namespace App\Repositories;

use App\Eloquent\Product;

class ProductsRepository extends AbstractRepository
{
    protected $model;

    /** @var Product */
    private $product;

    /**
     * ProductsRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $this->product = $product;
    }
}
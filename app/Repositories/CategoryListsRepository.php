<?php

namespace App\Repositories;

use App\Eloquent\CategoryList;

class CategoryListsRepository extends AbstractRepository
{
    protected $model;

    /** @var CategoryList */
    private $categoryList;

    public function __construct(CategoryList $categoryList)
    {
        $this->model = $this->categoryList = $categoryList;
    }
}
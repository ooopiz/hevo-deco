<?php

namespace App\Repositories;

use App\Eloquent\Category;

class CategoriesRepository extends AbstractRepository
{
    protected $model;

    /** @var Category */
    private $category;

    /**
     * CategoriesRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $this->category = $category;
    }
}
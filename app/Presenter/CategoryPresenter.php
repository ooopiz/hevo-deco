<?php

namespace App\Presenter;

use App\Eloquent\Category;
use App\Repositories\CategoriesRepository;

class CategoryPresenter
{
    public function categoryOptions()
    {
        $categoriesRepository = new CategoriesRepository(new Category());
        return $categoriesRepository->all();
    }
}
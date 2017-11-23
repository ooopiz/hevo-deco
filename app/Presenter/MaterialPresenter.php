<?php

namespace App\Presenter;

use App\Eloquent\Material;
use App\Repositories\MaterialRepository;

class MaterialPresenter
{
    public function materialOptions()
    {
        $materialRepository = new MaterialRepository(new Material());
        return $materialRepository->all();
    }
}
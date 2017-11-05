<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'subtitle', 'content', 'length', 'width', 'height', 'display', 'active'
    ];

    public function categoryLists()
    {
        return $this->hasMany('App\Eloquent\CategoryList', 'product_id', 'id');
    }

    public function seriesLists()
    {
        return $this->hasMany('App\Eloquent\SeriesList', 'product_id', 'id');
    }

    public function materialLists()
    {
        return $this->hasMany('App\Eloquent\MaterialList', 'product_id', 'id');
    }

    public function materialImages()
    {
        return $this->hasMany('App\Eloquent\MaterialImage', 'product_id', 'id');
    }
}

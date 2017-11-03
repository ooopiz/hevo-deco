<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc', 'display'
    ];

    public function categoryList()
    {
        return $this->hasMany('App\Eloquent\SeriesList', 'series_id', 'id');
    }
}

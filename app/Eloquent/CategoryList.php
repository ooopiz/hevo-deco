<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class CategoryList extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'product_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Eloquent\Category', 'category_id', 'id');
    }
}

<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class MaterialImage extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'material_list_id', 'product_id', 'material_id', 'image_url'
    ];
}

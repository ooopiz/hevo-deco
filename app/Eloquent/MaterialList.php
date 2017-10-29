<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class MaterialList extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'material_id', 'product_id'
    ];

    public function material()
    {
        return $this->belongsTo('App\Eloquent\Material', 'material_id', 'id');
    }
}

<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class SeriesList extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'series_id', 'product_id'
    ];

    public function series()
    {
        return $this->belongsTo('App\Eloquent\Series', 'series_id', 'id');
    }
}

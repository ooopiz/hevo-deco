<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'sub_key', 'value'
    ];
}

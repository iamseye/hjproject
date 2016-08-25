<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcont extends Model
{
    protected $fillable=[
        'content',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function productcate()
    {
        return $this->belongsTo('App\Productcate');
    }
}

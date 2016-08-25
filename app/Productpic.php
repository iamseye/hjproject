<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productpic extends Model
{
    protected $fillable=[
        'name',
        'path',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}

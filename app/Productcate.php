<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcate extends Model
{
    protected $fillable=[
        'name',
    ];

    public function productconts()
    {
        return $this->hasMany('App\Productcont');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    //
    protected $fillable=[
        'title',
        'link',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}

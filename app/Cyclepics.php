<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cyclepics extends Model
{
    //
    protected $fillable=[
        'title',
        'save_path',
        'link_path',
        'order'
    ];
}

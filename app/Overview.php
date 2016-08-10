<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    //
    protected $fillable=[
        'keyword',
        'description',
        'logo',
        'ico',
        'contact_phone',
        'contact_email',
        'contact_add'
    ];
}


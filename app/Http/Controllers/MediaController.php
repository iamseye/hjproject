<?php

namespace App\Http\Controllers;

use App\Media;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class MediaController extends Controller
{
    //
    public function index()
    {
        $medias=Media::all();

        return view('media.index',compact('medias'));
    }


}

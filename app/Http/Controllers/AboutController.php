<?php

namespace App\Http\Controllers;

use App\Abouts;
use Illuminate\Http\Request;

use App\Http\Requests;

class AboutController extends Controller
{
    //
    public function index()
    {
        $abouts=Abouts::all();

        return view('about',compact('abouts'));
    }

}

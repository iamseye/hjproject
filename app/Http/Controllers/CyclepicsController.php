<?php

namespace App\Http\Controllers;

use App\Cyclepics;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Response;

class CyclepicsController extends Controller
{
    //
    public function index()
    {
        $picsinfo=Cyclepics::all();

        return view('index',compact('picsinfo'));
    }


}

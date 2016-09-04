<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cyclepics;
use App\Http\Requests;
use Jenssegers\Agent\Agent;


class IndexController extends Controller
{
    //
    public function index()
    {

        $agent = new Agent();

        $checkDevice=$agent->isMobile();;

        if($checkDevice)
        {
            return redirect()->action('MobileController@index');
        }

        else
        {
            $picsinfo=Cyclepics::all();

            return view('index',compact('picsinfo'));
        }

    }

}

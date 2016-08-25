<?php

namespace App\Http\Controllers;

use App\Http\Requests\OverviewRequest;
use Illuminate\Http\Request;
use App\Overview;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;

class OverviewController extends Controller
{
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        return 'test';
    }




}

<?php

namespace App\Http\Controllers;

use App\Messages;
use App\Overview;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContactController extends Controller
{
    //
    public function index()
    {
        $overview=Overview::findOrFail(1);

        return view('contact',compact('overview'));
    }

    public function store(Request $request)
    {
        Messages::create($request->all());

        return redirect('contact');
    }
}

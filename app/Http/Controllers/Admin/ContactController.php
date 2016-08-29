<?php

namespace App\Http\Controllers\Admin;

use App\Messages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //
    public function index()
    {
        $messages=Messages::all();

        return view('backend.contact.index',compact('messages'));
    }
}

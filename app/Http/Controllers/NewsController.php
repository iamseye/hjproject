<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
    //
    public function index()
    {
        $news=News::paginate(10);

        return view('news',['news'=>$news]);
    }

    public function show($id)
    {
        $news=News::findOrFail($id);

        return view('news_show',compact('news'));
    }

}

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
        $about=Abouts::all();

        return view('about.index',compact('about'));
    }

    public function show($id)
    {
        $about=Abouts::findorFail($id);

        return view('about.edit',compact('about'));
    }

    public function update($id,Request $request)
    {
        $about=Abouts::findorFail($id);

        $about->update($request->all());

        $this->succMsg($request,'編輯成功');

        return redirect()->action('AboutController@index');

    }

    // -------end backed Admin --------

    public function failMsg($request,$msg)
    {
        $request->session()->flash('flash_msg', $msg);
        $request->session()->flash('fail_msg', true);
    }

    public function succMsg($request,$msg)
    {
        $request->session()->flash('flash_msg', $msg);
    }

}

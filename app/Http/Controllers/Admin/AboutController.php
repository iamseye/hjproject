<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Abouts;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    //
    public function index()
    {
        $about=Abouts::all();
        return view('backend.about.index',compact('about'));
    }

    public function show($id)
    {
        $about=Abouts::findorFail($id);

        return view('backend.about.edit',compact('about'));
    }

    public function update($id,Request $request)
    {
        $about=Abouts::findorFail($id);

        $about->update($request->all());

        $this->succMsg($request,'編輯成功');

        return redirect('admin/about');

    }

    public function saveSummerPic(Request $request)
    {
        $files=$request->file('file');


            $destinationPath = base_path() . '/public/img/summernote/about';


            $extension=$files->getClientOriginalExtension();
            $fileName = md5(rand(100, 200)).'.'.$extension;
            $files->move($destinationPath,$fileName);

            $imgUrl='img/summernote/about/'.$fileName;
            return Response()->json(['imgUrl'=> $imgUrl]);
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

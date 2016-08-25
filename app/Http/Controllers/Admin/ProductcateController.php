<?php

namespace App\Http\Controllers\Admin;

use App\Productcate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Http\Requests;

class ProductcateController extends Controller
{

    public function index()
    {
        $cates=Productcate::all();
        return view('backend.productcate.index',compact('cates'));
    }

    public function create()
    {
        return view('backend.productcate.create');
    }

    public function store(Request $request)
    {
        Productcate::create($request->all());

        $this->succMsg($request,'新增成功');

        return redirect('admin/productcate');

    }

    public function show($id)
    {
        $cates=Productcate::findorFail($id);

        return view('backend.productcate.edit',compact('cates'));
    }

    public function update($id,Request $request)
    {
        $about=Productcate::findorFail($id);

        $about->update($request->all());

        $this->succMsg($request,'編輯成功');

        return redirect('admin/productcate');

    }

    public function destroy($id, Request $request)
    {
        $task = Productcate::destroy($id);

        $this->succMsg($request,'刪除成功');

        return Response()->json($task);
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

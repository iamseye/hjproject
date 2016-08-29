<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Media;

class MediaController extends Controller
{
    //
    public function index()
    {
        $medias=Media::all();

        return view('backend.media.index',compact('medias'));
    }

    public function create()
    {
        $products = Product::all()->toArray();
        $productSelect=[];

        foreach($products as $product)
        {
            $productSelect[$product['id']]=$product['title'];
        }

        return view('backend.media.create',compact('productSelect'));
    }

    public function store(Request $request)
    {

        $youlink=$request->link;

        if(strpos($youlink, 'http://v.youku.com/v_show/id') === false)
        {

            $this->failMsg($request,'請上傳正確優酷連結');
        }
        else {
            $media = Media::create($request->all());

            $media->product_id = $request->product_id;
            $media->save();

            $this->succMsg($request, '新增成功');
        }

        return redirect('admin/media');

    }

    public function show($id)
    {
        $media=Media::findOrFail($id);

        $products = Product::all()->toArray();
        $productSelect=[];

        foreach($products as $product)
        {
            $productSelect[$product['id']]=$product['title'];
        }

        return view('backend.media.edit',compact('media'),compact('productSelect'));
    }

    public function update($id, Request $request)
    {
        $media = Media::findOrFail($id);

        $media->update($request->all());

        $media->product_id=$request->product_id;
        $media->save();

        $this->succMsg($request,'編輯成功');

        return redirect('admin/media');

    }

    public function destroy($id, Request $request)
    {
        $task = Media::destroy($id);

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

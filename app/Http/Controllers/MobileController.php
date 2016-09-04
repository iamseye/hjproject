<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cyclepics;
use App\Product;

class MobileController extends Controller
{
    //
    public function index()
    {
        $picsinfo=Cyclepics::all();

        $products=Product::all();

        $pic_paths=[];

        foreach($products as $p)
        {
            $main_pic=Product::find($p->id)->productpics()->first();
            $pic_destination=$main_pic->path.'/'.$main_pic->name;
            $pic_paths[$p->id]=$pic_destination;

        }

        return view('mobile.index',compact('picsinfo','products','pic_paths'));
    }

    public function show($id)
    {
        $product=Product::findOrFail($id);
        $pics=$product->productpics()->get();

        $product_contents=Product::findOrFail($id)->productconts()->get();

        foreach($product_contents as $content)
        {
            $content_cate=$content->productcate->name;
            $content->cate_name=$content_cate;
        }


        return view('mobile.product',compact('product','pics','product_contents'));

    }
}

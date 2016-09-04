<?php

namespace App\Http\Controllers;

use App\Product;
use App\Productcate;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Validator;


class ProductController extends Controller
{

    public function index()
    {
        $products=Product::all();


        $pic_paths=[];
        $has_reviews=[];
        $has_medias=[];

        foreach($products as $p)
        {
            $main_pic=Product::find($p->id)->productpics()->first();
            $pic_destination=$main_pic->path.'/'.$main_pic->name;
            $pic_paths[$p->id]=$pic_destination;

            $reviews=Product::find($p->id)->reviews()->get();

            if(!$reviews->isEmpty())
            {
                $has_reviews[$p->id]='Y';
            }
            else
            {
                $has_reviews[$p->id]='N';
            }

            $medias=Product::find($p->id)->medias()->get();

            if(!$medias->isEmpty())
            {
                $has_medias[$p->id]='Y';
            }
            else
            {
                $has_medias[$p->id]='N';
            }
        }

        return view('product.index',compact('products','pic_paths','has_reviews','has_medias'));
    }

    public function show($id)
    {
        $product=Product::findOrFail($id);
        $pics=$product->productpics()->get();


        $product_cates=Productcate::all();

        $product_contents=Product::findOrFail($id)->productconts()->get();

        foreach($product_contents as $content)
        {
            $content_cate=$content->productcate->name;
            $content->cate_name=$content_cate;
        }

        $reviews=Product::find($id)->reviews()->get();

        if(!$reviews->isEmpty())
        {
            $has_review='Y';
        }
        else
        {
            $has_review='N';
        }

        $medias=Product::find($id)->medias()->get();

        if(!$medias->isEmpty())
        {
            $has_media='Y';
        }
        else
        {
            $has_media='N';
        }

        return view('product.show',compact('product','pics','has_review','has_media','product_cates','product_contents'));
    }
}

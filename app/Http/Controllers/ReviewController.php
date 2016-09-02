<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReviewController extends Controller
{

    public function index()
    {
        // 顯示商品再顯示評論
        /*$product=Product::all();

        $pic_paths=[];
        $has_reviews=[];
        foreach($product as $p)
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
        }

        return view('review.index',compact('product','pic_paths','has_reviews'));
        */

        //暫定改成顯示特定商品評論
        $product=Product::findOrFail(3);

        $reviews=Product::findOrFail(3)->reviews()->paginate(10);

        $has_media='';

        $medias=Product::find(3)->medias()->get();

        if(!$medias->isEmpty())
        {
            $has_media='Y';
        }

        return view('review.allReview',compact('product','reviews','has_media'));

    }

    public function showAllReviews($id)
    {
        $product=Product::findOrFail($id);

        $reviews=Product::findOrFail($id)->reviews()->paginate(10);

        $has_media='';

        $medias=Product::find($product->id)->medias()->get();

        if(!$medias->isEmpty())
        {
            $has_media='Y';
        }

        return view('review.allReview',compact('product','reviews','has_media'));
    }

    public function show($id)
    {
        $review=Review::findOrFail($id);

        return view('review.show',compact('review'));
    }
}

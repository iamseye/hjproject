<?php

namespace App\Http\Controllers;

use App\Media;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class MediaController extends Controller
{
    //
    public function index()
    {
//        $product=Product::all();
//
//        $pic_paths=[];
//        $has_medias=[];
//        foreach($product as $p)
//        {
//            $main_pic=Product::find($p->id)->productpics()->first();
//            $pic_destination=$main_pic->path.'/'.$main_pic->name;
//            $pic_paths[$p->id]=$pic_destination;
//
//            $medias=Product::find($p->id)->medias()->get();
//
//            if(!$medias->isEmpty())
//            {
//                $has_medias[$p->id]='Y';
//            }
//            else
//            {
//                $has_medias[$p->id]='N';
//            }
//        }
//
//        return view('media.index',compact('product','pic_paths','has_medias'));

        $product=Product::findOrFail(1);

        $medias=Product::findOrFail(1)->medias()->paginate(10);


        foreach($medias as $media)
        {
            //orignal : http://v.youku.com/v_show/id_XMTY5OTEzODI4MA==.html?spm=0.0.m_223465.5~5~5~5~5~5~A.faIBZK#paction
            $splite_link = explode("http://v.youku.com/v_show/id_", $media->link);
            $splite_link_out=explode("==.html",$splite_link[1]);

            $media->link=$splite_link_out[0];
        }


        $has_reviews='';

        $reviews=Product::find(1)->reviews()->get();

        if(!$reviews->isEmpty())
        {
            $has_reviews='Y';
        }

        return view('media.allMedia',compact('product','medias','has_reviews'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllMedia($id)
    {
        $product=Product::findOrFail($id);

        $medias=Product::findOrFail($id)->medias()->paginate(10);


        foreach($medias as $media)
        {
            //orignal : http://v.youku.com/v_show/id_XMTY5OTEzODI4MA==.html?spm=0.0.m_223465.5~5~5~5~5~5~A.faIBZK#paction
            $splite_link = explode("http://v.youku.com/v_show/id_", $media->link);
            $splite_link_out=explode("==.html",$splite_link[1]);

            $media->link=$splite_link_out[0];
        }



        $has_reviews='';

        $reviews=Product::find($product->id)->reviews()->get();

        if(!$reviews->isEmpty())
        {
            $has_reviews='Y';
        }

        return view('media.allMedia',compact('product','medias','has_reviews'));
    }

    public function show($id)
    {
        $review=Review::findOrFail($id);

        return view('review.show',compact('review'));
    }


}

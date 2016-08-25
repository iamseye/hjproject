<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Review;

class ReviewController extends Controller
{
    //
    public function index()
    {
        $reviews=Review::all();

        return view('backend.review.index',compact('reviews'));
    }

    public function create()
    {
        $products = Product::all()->toArray();
        $productSelect=[];

        foreach($products as $product)
        {
            $productSelect[$product['id']]=$product['title'];
        }

        return view('backend.review.create',compact('productSelect'));
    }

    public function store(Request $request)
    {
        $reivew=Review::create($request->all());

        $reivew->product_id=$request->product_id;
        $reivew->save();

        $this->succMsg($request,'新增成功');


        return redirect('admin/review');

    }

    public function show($id)
    {
        $review=Review::findOrFail($id);

        $products = Product::all()->toArray();
        $productSelect=[];

        foreach($products as $product)
        {
            $productSelect[$product['id']]=$product['title'];
        }

        return view('backend.review.edit',compact('review'),compact('productSelect'));
    }

    public function update($id, Request $request)
    {
        $review = Review::findOrFail($id);

        $review->update($request->all());

        $review->product_id=$request->product_id;
        $review->save();

        $this->succMsg($request,'編輯成功');

        return redirect('admin/review');

    }

    public function destroy($id, Request $request)
    {
        $task = Review::destroy($id);

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

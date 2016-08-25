<?php

namespace App\Http\Controllers\Admin;

use App\Productcate;
use App\Productcont;
use App\Productpic;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\File;



class ProductController extends Controller
{
    //
    public function index()
    {
        $products=Product::all();

        //make every file's path to pathArray attribute

        foreach($products as $product)
        {
            $p_id=$product->id;
            $pics = Product::find($p_id)->productpics;

            $pathArray=[];
            foreach($pics as $pic)
            {
                $pic_destination=$pic->path.'/'.$pic->name;
                array_push($pathArray,$pic_destination);
            }
            $product->pathArray=$pathArray;
        }

        return view('backend.product.index',compact('products'));
    }

    public function create()
    {
        $contentCates=Productcate::all();

        return view('backend.product.create',compact('contentCates'));
    }

    public function store(Requests\CreateProductRequest $request)
    {
        //create new product in db
        $newrow = Product::create([
            'title' => $request->get('title'),
            'price' => $request->get('price'),
            'des'=>$request->get('des')
        ]);

        $id=$newrow->id;

        //-------save every content to productcont table
        $contents=$request->get('content');
        $cateID=$request->get('cateID');

        for($i=0;$i<sizeof($contents);$i++)
        {
            $newContent=Productcont::create([
                'content'=>$contents[$i],
            ]);

            $newContent->product_id=$id;
            $newContent->productcate_id=$cateID[$i];
            $newContent->save();
        }

        //------handle files array -------
        $files =  $request->file('pics_path');

        $filesNumber = count($files) - 1;

        foreach(range(0, $filesNumber) as $index) {

            $destinationPath = base_path() . '/public/img/products/p_'.$id;

            //create folder
            if(!File::exists($destinationPath)) {
                //path does not exist
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }

            $extension=$files[$index]->getClientOriginalExtension();
            $fileName = 'product'.$id.'_'.($index+1).'.'.$extension;
            $files[$index]->move($destinationPath,$fileName);

            $pics=Productpic::create([
                'path'=>'/img/products/p_'.$id,
            ]);

            $pics->product_id=$id;
            $pics->name=$fileName;
            $pics->save();

        }

        //------ end of files array ------

        $this->succMsg($request,'新增成功');

        return redirect('admin/product');

    }

    public function show($id)
    {
        $product=Product::findOrFail($id);

        $contents=Product::find($id)->productconts()->get();

        return view('backend.product.edit',compact('product','contents'));
    }

    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);

        //update new product in db
        $product->update([
            'title' => $request->get('title'),
            'price' => $request->get('price')
        ]);

        $product_id=$product->id;

        //-------save every content to productcont table
        $contents=$request->get('content');
        $cateID=$request->get('cateID');

        for($i=0;$i<sizeof($contents);$i++)
        {
            Productcont::where('product_id', $product_id)
                ->where('productcate_id', $cateID[$i])
                ->update(['content' => $contents[$i]]);
        }


        $this->succMsg($request,'編輯成功');

        return redirect('admin/product');

    }

    public function destroy($id, Request $request)
    {
        $task = Product::destroy($id);

        $this->succMsg($request,'刪除成功');

        return Response()->json($task);
    }

    public function editFiles(Request $request)
    {
        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = 'img/' . $filename; //change this directory
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination);
                echo '/img/' . $filename;//change this URL
            }
            else
            {
                echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
            }
        }
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
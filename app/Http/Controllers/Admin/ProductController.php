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
            'des'=>$request->get('des'),
            'onShelf'=>$request->get('onShelf')
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
            'price' => $request->get('price'),
            'des'=>$request->get('des'),
            'onShelf'=>$request->get('onShelf')
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

        $success = File::cleanDirectory(base_path() . '/public/img/products/p_'.$id);

        $this->succMsg($request,'刪除成功');

        return Response()->json($task);
    }

    //------for product Pictures Edit
    public function productPics($id)
    {
        $pics=Product::findOrFail($id)->productpics()->orderBy('order','ASC')->get();


        return view('backend.product.edit_pics',compact('pics'));
    }

    public function productPicsDel($id)
    {
        $task = Productpic::destroy($id);

        return Response()->json($task);
    }

    public function productPicsAdd(Request $request)
    {

        $product_id=$request->get('product_id');
        //------handle files array -------
        $file =  $request->file('path');

            $destinationPath = base_path() . '/public/img/products/p_'.$product_id;

            //create folder
            if(!File::exists($destinationPath)) {
                //path does not exist
                File::makeDirectory($destinationPath, $mode = 0777, true, true);
            }

            $extension=$file->getClientOriginalExtension();
            $fileName = 'product'.$product_id.'_'.uniqid().'.'.$extension;
            $file->move($destinationPath,$fileName);

            $pics=Productpic::create([
                'path'=>'/img/products/p_'.$product_id,
            ]);

            $pics->product_id=$product_id;
            $pics->name=$fileName;
            $pics->save();

        //------ end of files array ------

    }

    public function updatePicsOrder(Request $request)
    {
        $orderArray=$request->get('order');

        for($i=0;$i<sizeof($orderArray);$i++)
        {
            Productpic::where('id',$orderArray[$i])
                ->update(['order'=>$i+1]);
        }

        $this->succMsg($request,'修改圖片順序成功');

        return Response()->json(array(
            'success' => true,
        ));
    }

    //-------end product Pictures Edit

    public function saveSummerPic(Request $request)
    {
        $files=$request->file('file');
        $destinationPath = base_path() . '/public/img/summernote/product';

        $extension=$files->getClientOriginalExtension();
        $fileName = md5(rand(100, 200)).'.'.$extension;
        $files->move($destinationPath,$fileName);

        $imgUrl='img/summernote/product/'.$fileName;

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

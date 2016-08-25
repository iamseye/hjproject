<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cyclepics;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CyclepicsController extends Controller
{
    //
    public function index()
    {
        $picsinfo=Cyclepics::orderBy('order')->get();

        return view('backend.cyclepics.index',compact('picsinfo'));
    }

    //using ajax to return and store new record
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'save_path'=>'image',
        ]);

        if ($validator->fails())
        {
            $this->failMsg($request,'輸入資訊缺少或上傳檔案錯誤');

            return Response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
        }
        else
        {
            //create row
            $task = Cyclepics::create($request->all());
            $id=$task->id;

            //upload files
            $file = $request->file('save_path');

            if ($file->isValid()) {
                $extension=$file->getClientOriginalExtension();
                $fileName = $id.'.'.$extension;
                $destinationPath = base_path() . '/public/img/cycleImg';
                $file->move($destinationPath,$fileName);

                //update save_path
                $newRow=Cyclepics::find($id);
                $newRow->save_path='img/cycleImg/'.$fileName;
                $newRow->save();

                $this->succMsg($request,'新增資訊成功');
                return Response()->json($task);

            }
            else
            {
                $this->failMsg($request,'檔案內容錯誤！');
                return Response()->json(array(
                    'success' => false,
                    'errors' => '檔案內容錯誤'
                ), 400); // 400 being the HTTP code for an invalid request.
            }
        }
    }

    public function show($id)
    {
        $therow=Cyclepics::findOrFail($id);

        return view('backend.cyclepics.edit',compact('therow'));
    }

    public function update($id,Requests\CyclepicsRequest $request)
    {
        $newRow=Cyclepics::findOrFail($id);
        $newRow->title=$request->get('title');
        $newRow->link_path=$request->get('link_path');
        $newRow->save();


        //upload files


        $file = $request->file('save_path');

        if($file!=null)
        {
            if ($file->isValid()) {
                $extension=$file->getClientOriginalExtension();
                $fileName = $id.'.'.$extension;
                $destinationPath = base_path() . '/public/img/cycleImg';
                $file->move($destinationPath,$fileName);

                //update save_path
                $newRow->save_path='img/cycleImg/'.$fileName;
                $newRow->save();

                $this->succMsg($request,'編輯圖片成功');
            }
            else
            {
                $this->failMsg($request,'檔案內容錯誤！');
                return Response()->json(array(
                    'success' => false,
                    'errors' => '檔案內容錯誤'
                ), 400); // 400 being the HTTP code for an invalid request.
            }
        }
        else
        {
                $this->succMsg($request,'編輯圖片成功');

        }


        return redirect('admin/cyclepics');

    }

    public function destroy($id)
    {
        $task = Cyclepics::destroy($id);

        return Response()->json($task);
    }

    public function updateOrder(Request $request)
    {
        $orderArray=$request->get('order');

        for($i=0;$i<sizeof($orderArray);$i++)
        {
            Cyclepics::where('id',$orderArray[$i])
                ->update(['order'=>$i+1]);
        }

        $this->succMsg($request,'修改圖片順序成功');

        return Response()->json(array(
            'success' => true,
        ));
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

<?php

namespace App\Http\Controllers;

use App\Cyclepics;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Illuminate\Http\Response;

class CyclepicsController extends Controller
{
    //
    public function index()
    {
        $picsinfo=Cyclepics::all();

        return view('cyclepics.edit',compact('picsinfo'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'save_path'=>'image',
            'link_path'=>'required'
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
        return Response()->json($therow);
    }

    public function update($id,Request $request)
    {
        dd($request->all());
        $therow = Cyclepics::findOrFail($id);

        $therow->update($request->all());
        return Response()->json($therow);
    }

    public function destroy($id)
    {
        $task = Cyclepics::destroy($id);

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

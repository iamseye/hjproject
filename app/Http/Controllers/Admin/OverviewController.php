<?php

namespace App\Http\Controllers\Admin;

use App\Overview;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;


class OverviewController extends Controller
{
    //
    public function editOneRecord()
    {
        $overviews= Overview::FindorFail(1);

        return view('backend.overview.edit', compact('overviews'));
    }

    public function updateOneRecord(Request $request)
    {
        //check file type
        $validator = Validator::make($request->all(), [
            'logo'=>'image',
            'ico'=>'mimes:ico'
        ]);

        if ($validator->fails())
        {
            $this->failMsg($request,'上傳檔案類型不符');
            return redirect('admin/overview');
        }
        else {

            //upload files
            if ($request->hasFile('logo')) {

                $file = $request->file('logo');

                if ($file->isValid()) {
                    $fileName = 'logo.png';
                    $destinationPath = base_path() . '/public/img/';

                    //whatever what kind of type , save to png
                    //\Intervention\Image\Facades\Image::make($file)->save($destinationPath,$fileName);
                    Image::make($file)->save($destinationPath . $fileName);
                }
            }

            if ($request->hasFile('ico')) {

                $file = $request->file('ico');

                if ($file->isValid()) {
                    $fileName = 'ico.ico';
                    $destinationPath = base_path() . '/public/img/';
                    $file->move($destinationPath, $fileName);
                }
            }

            //update information
            $overviews = Overview::findOrFail(1);
            $overviews->update($request->all());

            $this->succMsg($request,'更新成功');
            return redirect('admin/overview');

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

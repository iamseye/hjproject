<?php

namespace App\Http\Controllers;

use App\Http\Requests\OverviewRequest;
use Illuminate\Http\Request;
use App\Overview;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;

class OverviewController extends Controller
{
    //
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        return 'test';
    }


    // -------for backed Admin --------

    public function editOneRecord()
    {
        $overviews= Overview::FindorFail(1);

        return view('overview.edit', compact('overviews'));
    }

    public function updateOneRecord(Request $request)
    {
        //check file type
        $validator = Validator::make($request->all(), [
            'logo'=>'mimes:jpeg,bmp,png',
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
            return redirect()->back();

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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    //
    public function index()
    {
        $news=News::all();

        return view('backend.news.index',compact('news'));
    }

    public function create()
    {
        return view('backend.news.create');
    }

    public function store(Request $request)
    {
        News::create($request->all());

        $this->succMsg($request,'新增成功');

        return redirect('admin/news');

    }

    public function show($id)
    {
        $news=News::findOrFail($id);

        return view('backend.news.edit',compact('news'));
    }

    public function update($id, Request $request)
    {
        $news = News::findOrFail($id);

        $news->update($request->all());

        $this->succMsg($request,'編輯成功');

        return redirect('admin/news');

    }

    public function destroy($id, Request $request)
    {
        $task = News::destroy($id);

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

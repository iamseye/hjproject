<!-- for admin -->

@extends('backend.layouts.dashboard')

@section('pageContent')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">首頁資訊</h1>
                    @include('layouts._flash_msg')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">新增圖片</button>
                            <div class="row">

                                <!-- Table-to-load-the-data Part -->
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>編號</th>
                                        <th>圖片</th>
                                        <th>標題</th>
                                        <th>連結</th>
                                        <th>上傳時間</th>
                                        <th>功能</th>

                                    </tr>
                                    </thead>
                                    <tbody id="tasks-list" name="tasks-list">
                                        @foreach($picsinfo as $pic)
                                            <tr id="task{{$pic->id}}">
                                                <td>{{$pic->id}}</td>
                                                <td> {!! Html::image($pic->save_path,null,array('width' => 50 , 'height' => 50,'class'=>'img-responsive')) !!}
                                                </td>
                                                <td>{{$pic->title}}</td>
                                                <td>{{$pic->link_path}}</td>
                                                <td>{{$pic->created_at}}</td>
                                                <td>
                                                    <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$pic->id}}">編輯</button>
                                                    <button class="btn btn-danger btn-xs btn-delete delete-task" value="{{$pic->id}}" >刪除</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End of Table-to-load-the-data Part -->
                           </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

            </div>

            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">編輯資訊</h4>
                        </div>
                        <div class="modal-body">

                            {!! Form::open(array('id'=>'frmTasks','name'=>'frmTasks','class'=>'form-horizontal', 'url'=>'admin/cyclepics','files' => 'true') ) !!}
                            <div class="form-group error">
                                    <label for="title" class="col-sm-2 control-label">標題</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control has-error" id="title" name="title" placeholder="title" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('save_path','圖片',array('class'=>'col-sm-2 control-label'))!!}
                                    <div class="col-sm-10">
                                        {!! Form::file('save_path', null,array('class'=>'form-control')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="link_path" class="col-sm-2 control-label">連結</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="link_path" name="link_path" placeholder="link_path" value="">
                                    </div>
                                </div>
                            {!! Form::close() !!}

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" value="add">儲存</button>
                            <input type="hidden" id="task_id" name="task_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <!--end of Modal -->

            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">編輯資訊</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(array('id'=>'frmEdit','name'=>'frmEdit','class'=>'form-horizontal', 'url'=>'admin/cyclepics') ) !!}
                            <div class="form-group error">
                                <label for="titleEdit" class="col-sm-2 control-label">標題</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control has-error" id="titleEdit" name="titleEdit" placeholder="title" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="titleEdit" class="col-sm-2 control-label">連結</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link_pathEdit" name="link_pathEdit" placeholder="link_path" value="">
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-saveEdit" value="add">儲存</button>
                            <input type="hidden" id="task_idEdit" name="task_idEdit" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <!--end of Modal -->


         </div>
    </div>
    <meta name="_token" content="{{ csrf_token() }}" />
@stop

<!-- the script only use here-->
@section('script')
<script src="{{asset('js/ajax-crud.js')}}"></script>
@stop

@include('layouts._del_check_modal')
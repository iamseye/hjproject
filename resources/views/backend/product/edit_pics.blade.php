@extends('backend.layouts.dashboard')

@section('pageHeader')編輯商品圖片
@stop

@section('pageContent')


    <button id="btn-add" name="btn-add" class="btn btn-primary ">新增圖片</button>

    <div class="row">

        <!-- Table-to-load-the-data Part -->
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>圖片</th>
                    <th>上傳時間</th>
                    <th>功能</th>
                </tr>
            </thead>
            <tbody id="tasks-list" name="tasks-list">
            @for ($i = 0; $i < count($pics); $i++)
                <tr id="{{$pics[$i]->id}}" class="{{ $i==0? 'success': ''}}">
                    <td>{{$pics[$i]->order}}
                        @if($i==0)
                            <input type="hidden" id="product_id" name="product_id" value="{{ $pics[$i]->product_id }}">
                        @endif
                    </td>
                    <td>
                        <a href="{{URL::to(($pics[$i]->path).'/'.($pics[$i]->name)) }}" data-lightbox="pictures" data-title="{{$pics[$i]->name}}">
                            {!! Html::image(($pics[$i]->path).'/'.$pics[$i]->name,null,array('width' => 50 , 'height' => 50,'class'=>'img-responsive')) !!}
                        </a>
                    </td>
                    <td>{{$pics[$i]->created_at}}</td>
                    <td>
                        @if($pics[$i]->order!=1 )
                            <button class="btn btn-danger btn-delete" value="{{$pics[$i]->id}}" >刪除</button>
                        @endif
                    </td>
                </tr>

            @endfor
            </tbody>
        </table>
        <!-- End of Table-to-load-the-data Part -->

        <div class="pull-right">
            <span>使用滑鼠拖曳已改變圖片顯示順序，主要圖片請放在第一順位</span>
            <button id="btn-order" name="btn-order" class="btn btn-primary ">儲存順序</button>
        </div>
    </div>

        <!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">新增圖片</h4>
                    </div>
                    <div class="modal-body">

                        {!! Form::open(array('id'=>'frmTasks','name'=>'frmTasks','class'=>'form-horizontal','files' => 'true') ) !!}
                        <div class="form-group">
                            {!! Form::label('path','圖片',array('class'=>'col-sm-2 control-label'))!!}
                            <div class="col-sm-4">
                                {!! Form::file('path', null,array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">儲存</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end of Modal -->

    <meta name="_token" content="{{ csrf_token() }}" />

@stop


@section('script')
    <script>
        $(document).ready(function() {

            var url = "/admin";

            // sorting table
            $('table tbody').sortable({
                helper: fixWidthHelper
            }).disableSelection();

            //save sorting btn
            $('#btn-order').click(function(){
                var array= $('table tbody').sortable('toArray');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                $.ajax({
                    type: "POST",
                    url: url+'/updatePicsOrder',
                    data:{order:array},
                    dataType: 'json',
                    success: function (data) {

                        console.log(data);
                        location.reload();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

            });

            //display modal form for creating new task
            $('#btn-add').click(function(){
                $('#imgArea').hide();
                $('#frmTasks').trigger("reset");
                $('#myModal').modal('show');
            });

            //delete task and remove it from list

            $('.btn-delete').click(function(){

                $('#checkModal').modal('show');

                $id=$(this).val();
                $('#checkModal').modal().one('click', '#checkDel', function() {
                    var task_id = $id;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    })

                    $.ajax({
                        type: "DELETE",
                        url: url + '/productPicsDel/' + task_id,
                        success: function (data) {
                            console.log(data);
                            location.reload();
                            $("#task" + task_id).remove();

                        },
                        error: function (data) {
                            location.reload();
                            console.log('Error:', data);
                        }
                    });

                    $('#checkModal').modal('hide');
                });
            });


            //create new task / update existing task
            $("#btn-save").click(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })

                e.preventDefault();

                //used to determine the http verb to use [add=POST], [update=PUT]

                var type = "POST"; //for creating new resource
                var product_id = $('#product_id').val();
                var my_url = url+'/productPicsAdd';

                var form = document.getElementById('frmTasks');
                var formData=new FormData(form);
                formData.append("product_id", product_id);


                $.ajax({
                    type: type,
                    url: my_url,
                    data: formData,
                    processData: false,
                    contentType:false,
                    dataType: 'json',
                    success: function (data) {

                        console.log(data);

                        location.reload();

                        $('#frmTasks').trigger("reset");

                        $('#myModal').modal('hide')
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        location.reload();

                    }
                });
            });

        });

        //for sorting table
        function fixWidthHelper(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        }
    </script>
@stop

@include('layouts._del_check_modal')
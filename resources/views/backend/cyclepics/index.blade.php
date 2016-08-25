<!-- for admin -->

@extends('backend.layouts.dashboard')

@section('pageHeader')
    首頁圖片
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
            <th>標題</th>
            <th>連結</th>
            <th>上傳時間</th>
            <th>功能</th>

        </tr>
        </thead>
        <tbody id="tasks-list" name="tasks-list">
        @for ($i = 0; $i < count($picsinfo); $i++)
             <tr id="{{$picsinfo[$i]->id}}">
                    <td>{{$i+1}}</td>
                    <td>
                        <a href="{{URL::to('/'.$picsinfo[$i]->save_path) }}" data-lightbox="{{$picsinfo[$i]->title}}" data-title="{{$picsinfo[$i]->title}}">
                            {!! Html::image($picsinfo[$i]->save_path,null,array('width' => 50 , 'height' => 50,'class'=>'img-responsive')) !!}
                        </a>
                    </td>
                    <td>{{$picsinfo[$i]->title}}</td>
                    <td>{{$picsinfo[$i]->link_path}}</td>
                    <td>{{$picsinfo[$i]->created_at}}</td>
                    <td>
                        <a href="{{ url('admin/cyclepics/'.$picsinfo[$i]->id)  }}" class="btn btn-warning">編輯</a>
                        <button class="btn btn-danger btn-delete delete-task" value="{{$picsinfo[$i]->id}}" >刪除</button>
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
        <!-- End of Table-to-load-the-data Part -->

    <div class="row pull-right ">
        <div class="inline"><button id="btn-order" name="btn-order" class="btn btn-primary ">儲存順序</button></div>
        <div class="inline"><p>使用滑鼠拖曳已改變圖片顯示順序</p></div>
    </div>
</div>
                            <!-- /.row (nested) -->

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
                                    <div class="col-sm-4">
                                        {!! Form::file('save_path', null,array('class'=>'form-control')) !!}
                                    </div>
                                    <div class="col-sm-4" id="imgArea">
                                        {!! Html::image("",null,array('width' => 50 , 'height' => 50,'class'=>'img-responsive','id'=>'savedImg')) !!}
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


         </div>
    </div>
    <meta name="_token" content="{{ csrf_token() }}" />
@stop

<!-- the script only use here-->
@section('script')
<script>
    $(document).ready(function(){

        var url = "/admin/cyclepics";

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
                url: url+'/updateorder',
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
            $('#btn-save').val("add");
            $('#imgArea').hide();
            $('#frmTasks').trigger("reset");
            $('#myModal').modal('show');
        });

        //delete task and remove it from list

        $('.delete-task').click(function(){

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
                    url: url + '/' + task_id,
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

            console.log('token'+$('meta[name="_token"]').attr('content'));

            e.preventDefault();

            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn-save').val();

            var type = "POST"; //for creating new resource
            var task_id = $('#task_id').val();
            var my_url = url;

            var form = document.getElementById('frmTasks');
            var formData=new FormData(form);

            //console.log(type+ ' '+ my_url);

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


    //syn pitures when select files
    function readURL(input,ImgAreaID) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#"+ImgAreaID).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


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
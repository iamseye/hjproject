@extends('backend.layouts.dashboard')

@section('pageContent')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">最新消息</h1>
                    @include('layouts._flash_msg')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <a href="{{ url('admin/news/create')  }}" class="btn btn-primary">新增消息</a>
                            <div class="row">
                                <!-- Table-to-load-the-data Part -->
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>分類</th>
                                        <th>內容</th>
                                        <th>日期</th>
                                        <th>功能</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tasks-list" name="tasks-list">
                                    @foreach($news as $row)
                                        <tr id="{{$row->id}}">
                                            <td> {{$row->cate}}</td>
                                            <td> {{ str_limit(strip_tags($row->content), $limit = 100, $end = '...') }}
                                                </td>
                                            <td>{{$row->created_at}}</td>
                                            <td>
                                                <a href="{{ url('admin/news/'.$row->id)  }}" class="btn btn-warning">編輯</a>
                                                <button class="btn btn-danger delete-task" value="{{$row->id}}">刪除</button>
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
        </div>
    </div>
    <meta name="_token" content="{{ csrf_token() }}" />

@stop

@section('script')
<script>
    $(document).ready(function() {

        //delete task and remove it from list

        $('.delete-task').click(function () {

            var url='news';

            $('#checkModal').modal('show');

            $id = $(this).val();
            $('#checkModal').modal().one('click', '#checkDel', function () {
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

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });

                $('#checkModal').modal('hide');
            });
        });
    });
</script>

@stop

@include('layouts._del_check_modal')

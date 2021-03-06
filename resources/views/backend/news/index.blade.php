@extends('backend.layouts.dashboard')

@section('pageHeader')最新消息
@stop

@section('pageContent')


    <a href="{{ url('admin/news/create')  }}" class="btn btn-primary">新增消息</a>
    <div class="row">
        <!-- Table-to-load-the-data Part -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>編號</th>
                <th>標題</th>
                <th>內容</th>
                <th>日期</th>
                <th>功能</th>
            </tr>
            </thead>
            <tbody id="tasks-list" name="tasks-list">
            @for ($i = 0; $i < count($news); $i++)
                <tr id="{{$news[$i]->id}}">
                    <td> {{($i+1)}}</td>
                    <td> {{$news[$i]->title}}</td>
                    <td> {{ str_limit(strip_tags($news[$i]->content), $limit = 100, $end = '...') }}
                        </td>
                    <td>{{$news[$i]->created_at}}</td>
                    <td>
                        <a href="{{ url('admin/news/'.$news[$i]->id)  }}" class="btn btn-warning">編輯</a>
                        <button class="btn btn-danger delete-task" value="{{$news[$i]->id}}">刪除</button>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
        <!-- End of Table-to-load-the-data Part -->
    </div>
    <!-- /.row (nested) -->

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

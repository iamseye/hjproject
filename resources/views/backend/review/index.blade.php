@extends('backend.layouts.dashboard')
@section('pageHeader')
    使用見證
@stop
@section('pageContent')

<a href="{{ url('admin/review/create')  }}" class="btn btn-primary">新增見證</a>
<div class="row">
    <!-- Table-to-load-the-data Part -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>標題</th>
            <th>商品名稱</th>
            <th>內容</th>
            <th>上傳日期</th>
            <th>功能</th>
        </tr>
        </thead>
        <tbody id="tasks-list" name="tasks-list">

        @foreach($reviews as $row)
            <tr id="{{$row->id}}">
                <td> {{$row->title}}</td>
                <td>{{$row->product->title}}</td>
                <td>{{ str_limit(strip_tags($row->content), $limit = 100, $end = '...') }}
                </td>
                <td>{{$row->created_at}}</td>
                <td>
                    <a href="{{ url('admin/review/'.$row->id)  }}" class="btn btn-warning">編輯</a>
                    <button class="btn btn-danger delete-task" value="{{$row->id}}">刪除</button>
                </td>
            </tr>
        @endforeach

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

                var url='review';

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

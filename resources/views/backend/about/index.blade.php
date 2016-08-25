@extends('backend.layouts.dashboard')

@section('pageHeader')
    關於我們
@stop
@section('pageContent')

    <div class="row">
        <!-- Table-to-load-the-data Part -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>分類</th>
                <th>內容</th>
                <th>功能</th>

            </tr>
            </thead>
            <tbody id="tasks-list" name="tasks-list">
            @foreach($about as $row)
                <tr id="{{$row->id}}">
                    <td> {{$row->cate}}</td>
                    <td>{{ str_limit(strip_tags($row->des), $limit = 100, $end = '...') }}</td>
                    <td>
                        <a href="{{ url('admin/about/'.$row->id)  }}" class="btn btn-warning">編輯</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- End of Table-to-load-the-data Part -->
    </div>
    <!-- /.row (nested) -->

    @stop



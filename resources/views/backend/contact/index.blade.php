@extends('backend.layouts.dashboard')

@section('pageHeader')留言總覽
@stop

@section('pageContent')

    <div class="row">
        <!-- Table-to-load-the-data Part -->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>姓名</th>
                <th>電話</th>
                <th>電子郵件</th>
                <th>內容</th>
            </tr>
            </thead>
            <tbody id="tasks-list" name="tasks-list">
            @foreach($messages as $row)
                <tr id="{{$row->id}}">
                    <td> {{$row->name}}</td>
                    <td> {{$row->phone}}</td>
                    <td> {{$row->email}}</td>
                    <td> {{ $row->content }}
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

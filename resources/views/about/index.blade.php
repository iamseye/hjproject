@extends('backend.layouts.dashboard')

@section('pageContent')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">關於我們</h1>
                    @include('layouts._flash_msg')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
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
                                            <td>{{$row->des}}</td>
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
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

            </div>
         </div>
        </div>
    @stop


<!-- the script only use here-->
@section('script')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@stop


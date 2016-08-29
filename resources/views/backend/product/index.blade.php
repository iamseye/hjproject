@extends('backend.layouts.dashboard')


@section('pageHeader')
商品資訊
@stop

@section('pageContent')

    <a href="{{ url('admin/product/create')  }}" class="btn btn-primary">新增商品</a>
    <a href="{{ url('admin/productcate') }}" class="btn btn-success">管理內容類別</a>

    <div class="row">
    <!-- Table-to-load-the-data Part -->
    <table class="table table-striped">
        <thead>
        <tr>
            <th>編號</th>
            <th>名稱</th>
            <th>價格</th>
            <th>圖片</th>
            <th>日期</th>
            <th>功能</th>
        </tr>
        </thead>
        <tbody id="tasks-list" name="tasks-list">

            @for ($i = 0; $i < count($products); $i++)
            <tr id="{{$products[$i]->id}}">
                <td>{{($i+1)}}</td>
                <td> {{$products[$i]->title}}</td>
                <td>{{$products[$i]->price}}</td>
                <td> @foreach($products[$i]->pathArray as $path)
                     {!! Html::image($path,$products[$i]->title,array('width' => 50 , 'height' => 50)) !!}
                     @endforeach
                    </td>
                <td>{{$products[$i]->created_at}}</td>
                <td>
                    <a href="{{ url('admin/product/'.$products[$i]->id)  }}" class="btn btn-warning">編輯</a>
                    <button class="btn btn-danger delete-task" value="{{$products[$i]->id}}">刪除</button>
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

                var url='product';

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


<div class="modal fade" id="checkModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <p>刪除商品會刪除相關媒體資訊與使用見證</p>
                <p>確認刪除？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-danger" id="checkDel">刪除</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


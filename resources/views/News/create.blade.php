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
                        <div class="panel-heading">
                            新增消息
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    {!! Form::open(['method'=>'POST', 'url'=>'admin/news/']) !!}

                                    <div class='form-group'>
                                        {!! Form::label('cate','分類名稱：')!!}
                                        {!! Form::text('cate', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class='form-group'>
                                        {!! Form::label('content','內容：')!!}
                                        {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <!-- submit -->
                                    <div class='form-group'>
                                        {!! Form::submit('送出', ['class'=>'btn btn-primary form-control'])!!}
                                    </div>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

            </div>



@stop

@section('script')
<script>
    $(document).ready(function() {
        $('#content').summernote();
    });

</script>


@stop
@extends('backend.layouts.dashboard')

@section('pageHeader')使用見證
    @stop
@section('pageContent')


<div class="row">
    <div class="col-lg-12">
        {!! Form::open(['method'=>'POST', 'url'=>'admin/review']) !!}

        <div class='form-group'>
            {!! Form::label('title','標題：')!!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('product_id','商品：')!!}
            {!! Form::select('product_id', $productSelect,['class'=>'form-control']) !!}
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



            @stop

            @section('script')
                <script>
                    $(document).ready(function() {
                        $('#content').summernote({
                            height:200
                        });
                    });

                </script>


@stop
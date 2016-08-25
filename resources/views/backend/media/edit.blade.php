@extends('backend.layouts.dashboard')
@section('pageHeader')
    新聞媒體
@stop

@section('pageContent')


<div class="row">
    <div class="col-lg-12">
        {!! Form::model($media,['method'=>'PATCH', 'url'=>'admin/media/'.$media->id]) !!}

        <div class='form-group'>
            {!! Form::label('title','標題：')!!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('product_id','商品：')!!}
            {!! Form::select('product_id', $productSelect,['class'=>'form-control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::label('link','媒體連結：')!!}
            {!! Form::text('link', null, ['class'=>'form-control']) !!}
        </div>

        <!-- submit -->
        <div class='form-group'>
            {!! Form::submit('送出', ['class'=>'btn btn-primary form-control'])!!}
        </div>
        {!! Form::close() !!}

    </div>
</div>
<!-- /.row (nested) -->



@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });

    </script>


@stop
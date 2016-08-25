@extends('backend.layouts.dashboard')
@section('pageHeader')最新消息
@stop

@section('pageContent')

<div class="row">
    <div class="col-lg-12">
        {!! Form::open(['method'=>'POST', 'url'=>'admin/productcate/']) !!}

        <div class='form-group'>
            {!! Form::label('name','類別名稱：')!!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
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
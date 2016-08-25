@extends('backend.layouts.dashboard')

@section('pageHeader')
    關於我們
@stop

@section('pageContent')


<div class="row">
    <div class="col-lg-12">
        {!! Form::model($about,['method'=>'PATCH', 'url'=>'admin/about/'.$about->id]) !!}

        <div class='form-group'>
            {!! Form::label('cate','分類名稱：')!!}
            {!! Form::text('cate', null, ['class'=>'form-control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::label('des','描述：')!!}
            {!! Form::textarea('des', null, ['class'=>'form-control']) !!}
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
            $('#des').summernote({
                height:200,
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });
        });

    </script>
@stop
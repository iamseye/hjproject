@extends('backend.layouts.dashboard')
@section('pageHeader')最新消息
@stop

@section('pageContent')

<div class="row">
    <div class="col-lg-12">
        {!! Form::open(['method'=>'POST', 'url'=>'admin/news/']) !!}

        <div class='form-group'>
            {!! Form::label('title','標題：')!!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
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

<meta name="_token" content="{{ csrf_token() }}" />



@stop

@section('script')
<script>
    $(document).ready(function() {
        $('#content').summernote({
            height:500,
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                },
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0],editor,welEditable);
                }

            }
        });
    });

    function sendFile(file,editor,welEditable) {
        data = new FormData();
        data.append("file", file);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        $.ajax({
            data: data,
            type: "POST",
            url: "/admin/news/saveSummerPic",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var urlResult=data.imgUrl;
                var APP_URL = {!! json_encode(url('/')) !!}
                $('#content').summernote('editor.insertImage', APP_URL+'/'+urlResult);
            }
        });
    }

</script>


@stop
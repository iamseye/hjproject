@extends('backend.layouts.dashboard')

@section('pageHeader')
    使用見證
    @stop
@section('pageContent')


<div class="row">
    <div class="col-lg-12">
        {!! Form::model($review,['method'=>'PATCH', 'url'=>'admin/review/'.$review->id]) !!}

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
<!-- /.row (nested) -->




@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height:200,
                onImageUpload: function(files, editor, welEditable) {
                    for (var i = files.length - 1; i >= 0; i--) {
                        sendFile(files[i], this);
                    }
                }
            });
        });

        //create record for attachment
        function sendFile(file, el) {
            data = new FormData();
            data.append("file", file);

            $.ajax({
                type: "POST",
                url: "/compose_mails/attachment_upload",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    $(el).summernote('editor.insertImage', response.url.attachment_url.url, response.id);
                },
                error : function(error) {
                    alert('error');
                },
                complete : function(response) {
                }
            });
        }


    </script>


@stop
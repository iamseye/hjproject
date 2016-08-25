@extends('backend.layouts.dashboard')

@section('pageHeader')最新消息
@stop

@section('pageContent')


<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            {!! Form::model($news,['method'=>'PATCH', 'url'=>'admin/news/'.$news->id]) !!}

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
</div>
<!-- /.panel-body -->


  @stop

 @section('script')
                <script>
                    $(document).ready(function() {

                        $('#content').summernote({
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
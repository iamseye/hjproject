@extends('backend.layouts.dashboard')

@section('pageHeader')首頁圖片
@stop

@section('pageContent')


    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                {!! Form::model($therow,['method'=>'PATCH', 'url'=>'admin/cyclepics/'.$therow->id,'files' => 'true'])!!}

                <div class="row">
                    <div class="col-lg-3">
                        {!! Form::label('save_path','圖片：')!!}
                        {!! Form::file('save_path', null) !!}
                    <br>
                        <a href="{{URL::to('/'.$therow->save_path) }}" data-lightbox="{{$therow->title}}" data-title="{{$therow->title}}" id="save_pic_zoom">
                            {!! Html::image($therow->save_path,null,array('width' => 100 , 'height' => 100,'class'=>'img-responsive','id'=>'save_pic')) !!}
                        </a>
                    </div>

                    <div class ="col-lg-4">
                        <div class='form-group'>
                            {!! Form::label('title','標題：')!!}
                            {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class='form-group'>
                            {!! Form::label('link_path','連結：')!!}
                            {!! Form::text('link_path', null, ['class'=>'form-control']) !!}
                        </div>

                        <!-- submit -->
                            {!! Form::submit('送出', ['class'=>'btn btn-primary '])!!}
                        {!! Form::close() !!}
                    </div>

                </div>



            </div>
        </div>
        <!-- /.row (nested) -->
    </div>
    <!-- /.panel-body -->


@stop


@section('script')
    <script>
        $(document).ready(function() {

            $("#save_path").change(function(){
                readURL(this,'save_pic','save_pic_zoom');
            });

        });

        function readURL(input,ImgAreaID,ImgZoom) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#"+ImgAreaID).attr('src', e.target.result);
                    $("#"+ImgZoom).attr('href', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@stop
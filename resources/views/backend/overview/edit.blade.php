<!-- for admin -->

@extends('backend.layouts.dashboard')

@section('pageHeader')
網站總覽
@stop
@section('pageContent')


<div class="row">
    <div class="col-lg-6">

        {!! Form::model($overviews,['method'=>'POST' , 'url'=>'admin/overview/update','files' => 'true'] ) !!}

        <div class='form-group'>
            <div class="row">
                <div class="col-lg-6">
                    {!! Form::label('logo','Logo：')!!}
                    {!! Form::file('logo', null) !!}
                </div>
                <div class="col-lg-4">
                    {!! Html::image('img/logo.png','logo',array('width' => 200 , 'height' => 100,'id'=>'logoImg','data-lightbox'=>'logo')) !!}
                </div>
            </div>
        </div>

        <div class='form-group'>
            <div class="row">
                <div class="col-lg-6">
                    {!! Form::label('ico','Favio：')!!}
                    {!! Form::file('ico', null) !!}
                    請上傳.ico檔案
                </div>
                <div class="col-lg-4">
                    {!! Html::image('img/ico.ico','ico',array('width' => 50 , 'height' => 50,'id'=>'icoImg')) !!}
                </div>
            </div>

        </div>
    </div>
    <!-- /.col-lg-6 (nested) -->
    <div class="col-lg-6">

        <div class='form-group'>
            {!! Form::label('contact_phone','聯絡電話：')!!}
            {!! Form::input('number','contact_phone', null, ['class'=>'form-control']) !!}

        </div>

        <div class='form-group'>
            {!! Form::label('contact_email','聯絡郵件：')!!}
            {!! Form::email('contact_email', null, ['class'=>'form-control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::label('contact_add','聯絡地址：')!!}
            {!! Form::text('contact_add', null, ['class'=>'form-control']) !!}
        </div>

        <!-- submit field -->

        <div class='form-group'>
            {!! Form::submit('更新資料', ['class'=>'btn btn-primary'])!!}
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.col-lg-6 (nested) -->
</div>
<!-- /.row (nested) -->


@stop

@section('script')
    <script>
        $(document).ready(function() {

            $("#ico").change(function(){
                readURL(this,'icoImg');
            });

            $("#logo").change(function(){
                readURL(this,'logoImg');
            });
        });

        function readURL(input,ImgAreaID) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#"+ImgAreaID).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@stop

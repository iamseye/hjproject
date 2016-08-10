<!-- for admin -->

@extends('backend.layouts.dashboard')


@section('pageContent')

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">總覽</h1>
                    @include('layouts._flash_msg')
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            修改資料
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    {!! Form::model($overviews,['method'=>'POST' , 'url'=>'admin/overview/update','files' => 'true'] ) !!}

                                    <div class='form-group'>
                                        {!! Form::label('keyword','關鍵字：')!!}
                                        {!! Form::text('keyword', null, ['class'=>'form-control']) !!}
                                    </div>

                                    <div class='form-group'>
                                        {!! Form::label('description','描述：')!!}
                                        {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class='form-group'>
                                        <div class="row">
                                            <div class="col-lg-4">
                                        {!! Form::label('logo','Logo：')!!}
                                        {!! Form::file('logo', null) !!}
                                            </div>
                                            <div class="col-lg-4">
                                        {!! Html::image('img/logo.png','logo',array('width' => 50 , 'height' => 50)) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class='form-group'>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                {!! Form::label('ico','Ico：')!!}
                                                {!! Form::file('ico', null) !!}
                                                請上傳.ico檔案
                                            </div>
                                            <div class="col-lg-4">
                                                {!! Html::image('img/ico.ico','ico',array('width' => 50 , 'height' => 50)) !!}
                                            </div>
                                        </div>

                                    </div>

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
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

    </div>



@stop


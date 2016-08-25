@extends('backend.layouts.dashboard')

@section('css')
    <style>
        .item_box img{
            width:100%;
            height:100%;
        }
    </style>
@stop

@section('pageHeader')
    商品資訊
@stop
@section('pageContent')


    <div class="row">
        <div class="col-lg-12">

            {!! Form::model($product,['method'=>'PATCH', 'url'=>'admin/product/'.$product->id]) !!}

            <div class='form-group'>
                {!! Form::label('title','名稱：')!!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>

            <div class='form-group'>
                {!! Form::label('price','價格：')!!}
                {!! Form::input('number','price', null, ['class'=>'form-control']) !!}
            </div>

            <div class='form-group'>
                {!! Form::label('des','產品描述：')!!}
                {!! Form::textarea('des', null, ['class'=>'form-control content']) !!}
            </div>

            @for($i=0;$i<sizeof($contents);$i++)
                <div class='form-group'>
                    {{ Form::hidden('cateID['.$i.']', $contents[$i]->productcate_id) }}
                    <div><span class="label label-default">{!! $contents[$i]->productcate->name !!}</span></div>
                    {!! Form::textarea('content['.$i.']', $contents[$i]->content, ['class'=>'form-control content']) !!}
                </div>
            @endfor

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

            //plug for editor
            $('.content').summernote({
                height:200,
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });

            //add list of upload files
            var fileUpload=document.getElementById('pics_path');
            var list = document.getElementById('fileList');

        });

        //fileList can't remove files, have to change to use Ajax to upload file
        /*
         function del_btn(order)
         {
         $('#fileList li').eq(order).remove();

         //刪除檔案上傳的顯示
         // 先刪掉第一個li會顯示錯誤

         var input = document.getElementById('pics_path');
         var file = input.files;
         console.log(file);
         }*/

    </script>
@stop


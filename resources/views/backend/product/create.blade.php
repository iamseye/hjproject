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

        {!! Form::open(['method'=>'POST', 'url'=>'admin/product/','files'=>'true']) !!}

        <div class='form-group'>
            {!! Form::label('title','名稱：')!!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::label('price','價格：')!!}
            {!! Form::input('number','price', null, ['class'=>'form-control']) !!}
        </div>

        <div class='form-group'>
        {!! Form::label('pics_path','圖片：')!!}
        {!! Form::file('pics_path[]', array('multiple'=>true,'id'=>'pics_path','class'=>'form-control')) !!}

            請將主圖片放在第一順位上傳
        </div>
        <ul class="list-group" id="fileList">
        </ul>

        <div class='form-group'>
            {!! Form::label('des','產品描述：')!!}
            {!! Form::textarea('des', null, ['class'=>'form-control content']) !!}
        </div>

        @for($i=0;$i<sizeof($contentCates);$i++)
            <div class='form-group'>
                {{ Form::hidden('cateID['.$i.']', $contentCates[$i]->id) }}
                <div><span class="label label-default">{!! $contentCates[$i]->name !!}</span></div>
                {!! Form::textarea('content['.$i.']', null, ['class'=>'form-control content']) !!}
            </div>
        @endfor


        <!-- submit -->
        <div class='form-group'>
            {!! Form::submit('送出', ['class'=>'btn btn-primary form-control'])!!}
        </div>
        {!! Form::close() !!}

    </div>
</div>
<meta name="_token" content="{{ csrf_token() }}" />


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

        //send files in summernote editor
        function sendFile(file, url, editor) {
            var data = new FormData();
            data.append("file", file);
            console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

            $.ajax({
                data: data,
                type: "POST",
                url: '/admin/productEditFiles',
                cache: false,
                contentType: false,
                processData: false,
                success: function(objFile) {
                    editor.summernote('insertImage', objFile.folder+objFile.file);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            });
        }

        //add list of upload files
        var fileUpload=document.getElementById('pics_path');
        var list = document.getElementById('fileList');

        fileUpload.onchange=function(){

            //for every file...
             for (var x = 0; x < fileUpload.files.length; x++) {

             console.log(fileUpload.files[x].name);

                 //add to list
             var li = document.createElement('li');
                 li.setAttribute("class", "list-group-item");

                 //var button_del='<button type="button" class="close" aria-label="Close" onclick="del_btn('+x+')">&times;</button>';

                 li.innerHTML = '檔案 ' + (x + 1) + ':  ' + fileUpload.files[x].name;
                 list.appendChild(li);
             }
        };

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


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

            圖片順序請至編輯調整
        </div>


        <div class='form-group'>
            {!! Form::label('onShelf','商品狀態：')!!}
            {{ Form::radio('onShelf', 1,true) }} 上架
            {{ Form::radio('onShelf', 0) }} 敬請期待
        </div>


        <div class='form-group'>
            {!! Form::label('des','商品描述：')!!}
            {!! Form::textarea('des', null, ['class'=>'form-control content']) !!}
        </div>

        {{ Form::hidden('contentNum', sizeof($contentCates),['id'=>'contentNum']) }}

        @for($i=0;$i<sizeof($contentCates);$i++)
            <div class='form-group'>
                {{ Form::hidden('cateID['.$i.']', $contentCates[$i]->id) }}
                <div><span class="label label-default">{!! $contentCates[$i]->name !!}</span></div>
                {!! Form::textarea('content['.$i.']', null, ['class'=>'form-control content','id'=>'content_'.$i]) !!}
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
        summernoteEditor('des');
        var contentNum = $('#contentNum').val();
        for(var i=0;i<contentNum;i++)
        {
            summernoteEditor('content_'+i);

        }

    });

    function summernoteEditor(id)
    {
        $('#'+id).summernote({
            height:500,
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                },onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0],editor,welEditable,id);
                }

            }
        });
    }

    function sendFile(file,editor,welEditable,id) {
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
            url: "/admin/product/saveSummerPic",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                var urlResult=data.imgUrl;
                var APP_URL = {!! json_encode(url('/')) !!}
                console.log(urlResult);
                    $('#'+id).summernote('editor.insertImage', APP_URL+'/'+urlResult);
            }
        });
    }


</script>
@stop


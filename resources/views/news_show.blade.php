@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
@stop

@section('banner')
    <div id="bannerInside">
        <div class="bannerInsideContent">
            <img src="/images/bannerInside05.jpg" />
        </div>
    </div>
@stop

@section('content')
    <div id="content">
        <div class="wrapper">

            <div id="newsinsideTitle">
                <div class="newsinsideDate">{{date_format($news->created_at,'Y/m/d')}}</div>
                <div class="newsinsideTitle">{{$news->title}}</div>
            </div>

            <div id="newsContent">
               {!! $news->content !!}
            </div>

            <a href="{{url()->previous()}}"><div id="back">上一頁</div></a>
        </div>
    </div>
@stop

@section('script')
    {!! HTML::script('js/slide.js') !!}

@stop
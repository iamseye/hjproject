@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            <img src="./images/bannerInside01.jpg" />
        </div>
    </div>
@stop

@section('content')
    <div id="content">
        <div class="wrapper">
            <ul id="insideSelect">
                @foreach($abouts as $about)
                    <li>{{ $about->cate }}</li>
                @endforeach
            </ul>

            <div id="insideContent">
                @foreach($abouts as $about)
                    <div class="insideText">
                        <h2>{{ $about->cate }}</h2>
                        <div class="textArea">
                            {!! $about->des !!}
                        </div>
                    </div>
                @endforeach

                <div id="goTopArea">
                    <div id="goTop">回到選單</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    {!! HTML::script('js/slide.js') !!}

@stop
@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
    {!! Html::style('css/product.css') !!}
@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            {{ HTML::image('images/bannerInside03.jpg',null) }}
        </div>
    </div>
@stop

@section('content')
    <div id="content">
        <div class="wrapper">

            <div id="newsinsideTitle">
                <div class="mitnessinsidePerson">{{$review->name}}</div>
                <div class="newsinsideTitle">{{$review->title}}。</div>
            </div>

            <div id="newsContent">
                {!!  $review->content !!}

            </div>

            <a href="{{url()->previous()}}"><div id="back">上一頁</div></a>
        </div>
    </div>
@stop

@section('script')
    {!! HTML::script('js/slide.js') !!}


            <script>
                $(document).ready(function(){

                    $("#mitnessSelect").slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 3000
                    });
                });
            </script>

@stop


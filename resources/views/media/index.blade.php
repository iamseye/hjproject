@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
    {!! Html::style('css/product.css') !!}

@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            <img src="./images/bannerInside04.jpg" />
        </div>
    </div>
@stop

@section('content')
    <div id="content">
        <div class="wrapper" style="overflow:visible;">
            <div id="mitnessSelect">
                @foreach($product as $p)
                    <div class="mitnessSelectContent">
                        <h3>{{$p->title}}</h3>
                        <img src="{{URL::to($pic_paths[$p->id])}}" />
                        <p> {{ strip_tags($p->des) }}
                        </p>
                        @if(($p->onShelf==1) && ($has_medias[$p->id]=='Y'))
                            <a href="{{ url('media/showAllMedia/'.$p->id) }}"><div class="buyBTN">瞭解更多</div></a>
                        @endif
                    </div>

                @endforeach

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


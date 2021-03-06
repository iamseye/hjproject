@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
    {!! Html::style('css/product.css') !!}

@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            <img src="./images/bannerInside03.jpg" />
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
                        @if(($p->onShelf==1) && ($has_reviews[$p->id]=='Y'))
                            <a href="{{ url('review/showAllReviews/'.$p->id) }}"><div class="buyBTN">瞭解更多</div></a>
                        @elseif($p->onShelf!=1)
                            <a ><div class="waitBTN">盡請期待</div></a>
                        @endif
                    </div>

                @endforeach
            </div>
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


@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
    {!! Html::style('css/product.css') !!}

@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            <img src="./images/bannerInside02.jpg" />
        </div>
    </div>
@stop

@section('content')
    <div id="content">
        @foreach($products as $product)

            <div class="product">
                <img class="productImg" src="{{URL::to($pic_paths[$product->id])}}" />

                <div class="productText">
                    <div class="name">
                        {{$product->title}}
                    </div>
                    <div class="price">NT<span>{{$product->price}}</span></div>
                </div>

                <div class="productInfo">
                    <p>
                        {{ strip_tags($product->des) }}
                    </p>
                </div>

                <div class="productBTN">
                    @if($has_reviews[$product->id]=='Y')
                        <a href="{{ url('review/showAllReviews/'.$product->id) }}"><div class="cartBTN">使用見證</div></a>
                    @endif
                    @if($has_medias[$product->id]=='Y')
                        <a href="{{ url('review/showAllMedias/'.$product->id) }}"><div class="cartBTN">新聞媒體</div></a>
                    @endif

                    @if($product->onShelf==1 )
                        <a href="{{ url('product/'.$product->id) }}"><div class="buyBTN">瞭解更多</div></a>
                    @endif
                </div>
             </div>

        @endforeach

        <div class="clear"></div>
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


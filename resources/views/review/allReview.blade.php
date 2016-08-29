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

        <div class="product">

            <div class="productText" style="width:100%">
                <div class="name">
                    {{$product->title}}
                </div>
                <div class="price">NT<span>{{$product->price}}</span></div>
            </div>

            <div class="productInfo">
                <p>
                    {{strip_tags($product->des)}}
                </p>
            </div>

            <div class="productBTN">
                @if($has_media=='Y')
                    <a href="{{ url('media/showAllMedia/'.$product->id) }}"><div class="cartBTN">新聞媒體</div></a>
                @endif
                    <a href="{{ url('product/'.$product->id) }}"><div class="buyBTN">瞭解更多</div></a>
            </div>

            <!--div class="productBTN">
                <div class="number">
                    數量
                    <input type="number" />
                </div>
                <a href="./cart_1.html"><div class="cartBTN">加入購物車</div></a>
                <a href="./cart_1.html"><div class="buyBTN">購買</div></a>
            </div-->
        </div>

        <div class="wrapper">
            <ul id="newsList" style="margin-top:0;">
                @foreach($reviews as $review)
                    <li>
                        <div class="newsPerson">{{$review->name}}</div>
                        <div class="newsTitle">{{$review->title}}</div>
                        <a href="{{ url('review/'.$review->id) }}"><div class="newsBTN">閱讀更多</div></a>
                    </li>
                @endforeach

            </ul>

            @include('layouts._pagination', ['paginator' => $reviews])


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


@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
    {!! Html::style('css/product.css') !!}

@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            {{ HTML::image('images/bannerInside04.jpg',null) }}
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
                @if($has_reviews=='Y')
                <a href="{{ url('review/showAllReviews/'.$product->id) }}"><div class="cartBTN">使用见证</div></a>
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
            <ul id="videoList">
                @foreach($medias as $media)
                    <li>
                        <embed class="video" src="http://player.youku.com/player.php/sid/{{$media->link}}==/v.swf" allowFullScreen="true" quality="high" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
                    </li>
                @endforeach

            </ul>

            @include('layouts._pagination', ['paginator' => $medias])

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


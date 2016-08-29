@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
    {!! Html::style('css/product.css') !!}

@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            {{ HTML::image('images/bannerInside02.jpg',null) }}
        </div>
    </div>
@stop

@section('content')

    <div id="productArea" class="wrapper">
        <div class="product">
            <div class="productImg">
                <div id="proImg1">
                    @foreach($pics as $pic)
                        <div class="proImg1">
                            {{ HTML::image($pic->path.'/'.$pic->name,null) }}
                        </div>
                    @endforeach
                </div>

                <div id="proImg2">
                    @foreach($pics as $pic)
                        <div class="proImg2">
                            {{ HTML::image($pic->path.'/'.$pic->name,null) }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="productText">
                <div class="name">
                    {{$product->title}}
                </div>
                <div class="price">NT<span>{{$product->price}}</span></div>
            </div>

            <div class="productInfo">
                <p>
                    {!! $product->des !!}
                </p>
            </div>

            <div class="productBTN">
                @if($has_review=='Y')
                    <a href="{{ url('review/showAllReviews/'.$product->id) }}"><div class="cartBTN">使用見證</div></a>
                @endif
                @if($has_media=='Y')
                    <a href="{{ url('review/showAllMedias/'.$product->id) }}"><div class="cartBTN">新聞媒體</div></a>
                @endif

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

        <div class="clear"></div>
    </div>

    <div id="content">
        <div class="wrapper">

            <ul id="insideSelect">
                @foreach($product_cates as $cate)
                    <li>{{$cate->name}}</li>
                @endforeach
            </ul>

            <div>
                @foreach($product_contents as $product_content)
                    <div class="page">
                        <div class="insideText">
                            <h2>{{$product_content->cate_name }}</h2>
                            <div class="textArea">
                                {!! $product_content->content !!}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div id="goTopArea">
                <div id="goTop">回到選單</div>
            </div>

        </div>
    </div>
@stop

@section('script')
    {!! HTML::script('js/page.js') !!}
    <script>
        $(document).ready(function(){

            $('#proImg1').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '#proImg2'
            });

            $('#proImg2').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '#proImg1',
                dots: true,
                focusOnSelect: true
            });
        });
    </script>
@stop
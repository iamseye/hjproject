@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
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
                <div class="mitnessSelectContent">
                    <h3>吾良伴</h3>
                    <img src="./images/product.png" />
                    <p>
                        這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。
                    </p>
                    <a href="./mitnessInside.html"><div class="buyBTN">瞭解更多</div></a>
                </div>
                <div class="mitnessSelectContent">
                    <h3>速利醒</h3>
                    <img src="./images/product.png" />
                    <p>
                        這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。
                    </p>
                    <a href="./mitnessInside.html"><div class="buyBTN">瞭解更多</div></a>
                </div>
                <div class="mitnessSelectContent">
                    <h3>產品三</h3>
                    <img src="./images/product.png" />
                    <p>
                        這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。
                    </p>
                    <a href="./mitnessInside.html"><div class="buyBTN">瞭解更多</div></a>
                </div>
                <div class="mitnessSelectContent">
                    <h3>產品四</h3>
                    <img src="./images/product.png" />
                    <p>
                        這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。這邊是一些商品敘述，還有很多吸引人買下手的文案，跟很多很多的產品特點，總之跟商品有關的簡述都可以放在這裡，讓整個版面看起來更豐富囉。
                    </p>
                    <a href="./mitnessInside.html"><div class="buyBTN">瞭解更多</div></a>
                </div>
            </div>


        </div>
    </div>
@stop

@section('script')
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


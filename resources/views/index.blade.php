@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/index.css') !!}
@stop
@section('banner')

    <div id="bannerIndex">
        <div class="wrapper shadow">

            @foreach($picsinfo as $pic)
                <div class="bannerIndexContent">
                    {{ HTML::image($pic->save_path,null) }}
                </div>

            @endforeach

        </div>
    </div>

@stop
@section('script')
    <script type="text/javascript">

    $(window).scroll(function(){
        });

    $(window).resize(function(){
        });


    $(document).ready(function(){
            $("#bannerIndex .wrapper").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            dots:true,
            autoplaySpeed: 3000
            });
    });
    </script>

@stop
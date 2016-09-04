<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>

<head>
    <title>健康水墨</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="../img/ico.ico">
    <link rel="icon" href="../img/ico.ico" type="image/ico">
    <link rel="stylesheet" type="text/css" href="{{ url('css/main2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/index2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/base.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/reset.css') }}">

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

</head>

<body>

<div id="wrapper">
    <div id="header">
        <div class="wrapper">
            <a href="{{ url('m') }}"><img id='logo' src="{{url('img/logo.png')}}"/>
            </a>
        </div>
    </div>

    <div id="content">
        <div class="wrapper" style="overflow:visible;">
            <div id="mitnessSelect">
                <div class="mitnessSelectContent">
                    <h3>{{$product->title}}</h3>
                    @foreach($pics as $pic)
                           <img  src="{{url($pic->path.'/'.$pic->name)}}"/>
                    @endforeach
                    <p>
                        {!! $product->des !!}
                    </p>
                </div>

                <div>

                    <div class="page">
                        @foreach($product_contents as $product_content)
                            <div class="insideText">
                                <h2>{{$product_content->cate_name }}</h2>
                                <div class="textArea">
                                    {!! $product_content->content !!}
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div id="footer">
        <div class="wrapper">
            <ul id="contactList">
                <li>地址：东莞巿南城街道蛤地社区大进步50号二楼</li>
                <li>電話：0769-22118805</li>
                <li>Email：gina@sins-bag.com</li>
            </ul>
            <img id="footerLogo" src="{{url('images/footer_logo.png')}}"/>
            <div id="copyright">&copy; 2016 JiangKangShuiMo. All rights reserved.<br />design by circlestudio</div>
        </div>

    </div>

</div>


<script type="text/javascript" src="{{url('js/jquery-1.10.2.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery.easing.1.3.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/jquery.nicescroll.js')}}"></script>
<script type="text/javascript" src="{{url('js/parallax.js')}}"></script>
<script type="text/javascript" src="{{url('js/slick.js')}}"></script>
<script type="text/javascript" src="{{url('js/menu.js')}}"></script>
<script type="text/javascript" src="{{url('js/waypoints.min.js')}}"></script>
<script type="text/javascript" src="{{url('js/load.js')}}"></script>


</body>


</html>
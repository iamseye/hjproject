<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>

<head>
    <title>健康水墨</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="img/ico.ico">
    <link rel="icon" href="img/ico.ico" type="image/ico">
    <link rel="stylesheet" type="text/css" href="css/main2.css">
    <link rel="stylesheet" type="text/css" href="css/index2.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="js/parallax.js"></script>
    <script type="text/javascript" src="js/slick.js"></script>
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/waypoints.min.js"></script>
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
            <a href="{{ url('m') }}">{{ Html::image('img/logo.png',null,array('id'=>'logo')) }}</a>
        </div>
    </div>

    <div id="bannerIndex">
        <div class="wrapper shadow">
            @foreach($picsinfo as $pic)
                <div class="bannerIndexContent">
                    {{ HTML::image($pic->save_path,null) }}
                </div>
            @endforeach
        </div>
    </div>

    <div id="content">
        <div class="wrapper" style="overflow:visible;">
            <div id="mitnessSelect">

            @foreach($products as $product)
                <div class="mitnessSelectContent">
                    <h3>{{$product->title}}</h3>

                    <img class="productImg" src="{{URL::to($pic_paths[$product->id])}}" />
                    @if($product->onShelf==1 )
                        <a href="{{ url('m/product/'.$product->id) }}"><div class="buyBTN">瞭解更多</div></a>
                    @else
                        <a ><div class="waitBTN">盡請期待</div></a>
                    @endif
                </div>

            @endforeach

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
            <img id="footerLogo" src="images/footer_logo.png" />
            <div id="copyright">&copy; 2016 JiangKangShuiMo. All rights reserved.<br />design by circlestudio</div>
        </div>

    </div>

</div>

</body>

<script type="text/javascript" src="js/load.js"></script>

</html>
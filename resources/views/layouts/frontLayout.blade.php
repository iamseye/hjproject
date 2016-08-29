<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<html>

<head>
    <title>健康水墨</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="{{ asset('img/ico.ico') }}">
    <link rel="icon" href="{{ asset('img/ico.ico') }}" type="image/ico">
    {!! Html::style('css/main.css') !!}
    {!! Html::style('css/slick.css') !!}
    {!! Html::style('css/base.css') !!}
    {!! Html::style('css/reset.css') !!}
    {!! Html::style('css/login.css') !!}

    @yield('css')

</head>

<body>

<div id="wrapper">
    <div id="header">
        <div class="wrapper">
            <a href="{{ url('/') }}">{{ HTML::image('img/logo.png',null,array('id'=>'logo')) }}
            </a>
            <ul id="mainMenu">
                <a href="{{ url('about/') }}"><li>关于我们</li></a>
                <a href="{{ url('product/') }}"><li>产品介绍</li></a>
                <a href="{{ url('review/') }}"><li>使用见证</li></a>
                <a href="{{ url('media/') }}"><li>新闻媒体</li></a>
                <a href="{{ url('news/') }}"><li>最新消息</li></a>
                <a href="{{ url('contact/') }}"><li>联络我们</li></a>
            </ul>
        </div>
    </div>

    @yield('banner')

    @yield('content')

    <div id="footer">
        <div class="wrapper">
            <ul id="subMenu">
                <a href="{{ url('about/') }}"><li>关于我们</li></a>
                <a href="{{ url('product/') }}"><li>产品介绍</li></a>
                <a href="{{ url('review/') }}"><li>使用见证</li></a>
                <a href="{{ url('media/') }}"><li>新闻媒体</li></a>
                <a href="{{ url('news/') }}"><li>最新消息</li></a>
                <a href="{{ url('contact/') }}"><li>联络我们</li></a>
            </ul>
            <ul id="contactList">
                <li>地址：东莞巿南城街道蛤地社区大进步50号二楼</li>
                <li>電話：0769-22118805</li>
                <li>Email：gina@sins-bag.com</li>
            </ul>
            {{ HTML::image('images/footer_logo.png',null,array('id'=>'footerLogo')) }}
            <div id="copyright">&copy; 2016 JiangKangShuiMo. All rights reserved.<br />design by circlestudio</div>
        </div>

    </div>

</div>

</body>

{!! HTML::script('js/jquery-1.10.2.js') !!}
{!! HTML::script('js/jquery.easing.1.3.js') !!}
{!! HTML::script('js/jquery-ui.min.js') !!}
{!! HTML::script('js/jquery.nicescroll.js') !!}
{!! HTML::script('js/parallax.js') !!}
{!! HTML::script('js/slick.js') !!}
{!! HTML::script('js/menu.js') !!}
{!! HTML::script('js/waypoints.min.js') !!}
{!! HTML::script('js/load.js') !!}

@yield('script')

</html>
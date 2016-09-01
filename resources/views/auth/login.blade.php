


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

<div id="loginArea">

    <div id="loginBox">
        <h1>健康水墨登入頁面</h1>
        <div id="loginTable">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} tableRow">
                    <div class="tableCell"><label for="email" class="col-md-4 control-label">電子郵件</label></div>

                    <div class="col-md-6">
                        <div class="tableCell"><input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"></div>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} tableRow">
                    <div class="tableCell"><label for="password" class="col-md-4 control-label">密碼</label></div>

                    <div class="col-md-6">
                        <div class="tableCell"><input id="password" type="password" class="form-control" name="password"></div>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div id="BTNarea"></div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i> 登入
                        </button>
                        </div>
                    </div>
                </div>
            </form>

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



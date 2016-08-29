@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
    {!! Html::style('css/cart.css') !!}
    {!! Html::style('css/product.css') !!}

@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            <img src="./images/bannerInside06.jpg" />
        </div>
    </div>
@stop

@section('content')
    <div id="content">
        <div class="wrapper">

            <ul id="insideSelect">
                <li>联络方式</li>
                <li>留言给我们</li>
            </ul>

            <div>
                <div class="page">

                    <div class="contentText textArea">
                        <ul class="contactContent">
                            <li>东莞巿赫群生物科技有限公司</li>
                            <li>地址：{{$overview->contact_add}}</li>
                            <li>電話：{{$overview->contact_phone}}</li>
                            <li>傳真：{{$overview->contact_phone}}</li>
                            <li>Email：{{$overview->contact_email}}</li>
                        </ul>

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4205.961294173315!2d121.54262620042432!3d25.025059898177318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442aa28f45bf463%3A0x5acad9a76abaf24!2zMTA25Y-w5YyX5biC5aSn5a6J5Y2A5ZKM5bmz5p2x6Lev5LqM5q61Nzblt7cxOeW8hDXomZ8!5e0!3m2!1szh-TW!2stw!4v1438183028716"frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="page">

                    <div class="contentText textArea">

                        {!! Form::open(['method'=>'POST', 'url'=>'contact/']) !!}

                        <div class="table">

                                <div>
                                    <div class="tatleName2">姓名</div>
                                    <div class="left">
                                    {!! Form::text('name', null, ['placeholder'=>'輸入姓名']) !!}
                                    </div>
                                </div>

                                <div>
                                    <div class="tatleName2">聯絡電話</div>
                                    <div class="left">
                                        {!! Form::text('phone', null, ['placeholder'=>'輸入電話']) !!}
                                    </div>
                                    </div>
                            <div>

                                <div class="tatleName2">聯絡信箱</div>
                                <div class="left">
                                    {!! Form::text('email', null, ['placeholder'=>'輸入信箱','type'=>'email']) !!}
                                </div>
                            </div>
                            <div>

                                <div class="tatleName2">內容</div>
                                <div class="left">
                                    {!! Form::textarea('content', null, ['style'=>'...','row'=>8]) !!}
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="fullTable fullTable1">
                        <a>{!! Form::submit('送出', ['class'=>'buyBTN'])!!}</a>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
@stop

@section('script')
    {!! HTML::script('js/page.js') !!}
@stop
@extends('layouts.frontLayout')

@section('css')
    {!! Html::style('css/inside.css') !!}
@stop
@section('banner')

    <div id="bannerInside">
        <div class="bannerInsideContent">
            {{ HTML::image('images/bannerInside05.jpg',null) }}
        </div>
    </div>
@stop

@section('content')
    <div id="content">
        <div class="wrapper">
            <ul id="newsList">
                @foreach($news as $new)
                    <li>
                        <div class="newsDate">{{ date_format($new->created_at,"Y/m/d")}}</div>
                        <div class="newsTitle">{{$new->title}}</div>
                        <a href="{{ url('news/'.$new->id) }}"><div class="newsBTN">閱讀更多</div></a>
                    </li>
                @endforeach

            </ul>

            @include('layouts._pagination', ['paginator' => $news])

        </div>
    </div>
@stop
@section('script')
    {!! HTML::script('js/slide.js') !!}

@stop


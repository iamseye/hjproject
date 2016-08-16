@extends('backend.layouts.plane')

@section('body')

    @include('backend.layouts.partials._nav')

<div class="container-fluid">
    <div class="row">

        @include('backend.layouts.partials._sidebar')
        @yield('pageContent')

    </div>
</div>
@stop
@section('body_script')
    @yield('script')
@stop

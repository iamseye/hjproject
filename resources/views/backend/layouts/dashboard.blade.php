@extends('backend.layouts.plane')
@section('custom_css')
@yield('css')
@stop
@section('body')

    @include('backend.layouts.partials._nav')

<div class="container-fluid">
    <div class="row">

        @include('backend.layouts.partials._sidebar')
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('pageHeader')</h1>
                        @include('layouts._flash_msg')
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-body">
                            @yield('pageContent')

                            <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@stop

@section('body_script')
    @yield('script')
@stop

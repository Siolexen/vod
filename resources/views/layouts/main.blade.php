@extends('adminlte::page')

@section('title', 'Dashboard')

{{--@section('content_header')--}}
{{--    <h1>Dashboard</h1>--}}
{{--@stop--}}

{{--<div id="app">--}}

{{--    <div class="container px-4 px-lg-5">--}}
{{--        @yield('content')--}}

{{--    </div>--}}

{{--    <main class="py-4">--}}
{{--    </main>--}}
{{--</div>--}}


@section('css')
    {{--  <link rel="stylesheet" href="/css/admin_custom.css">--}}
 @stop

 @section('js')
     <script src="{{ asset('js/app.js') }}" defer></script>
 {{--    <script> console.log('Hi!'); </script>--}}
@stop

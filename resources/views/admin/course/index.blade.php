@extends('layouts.main')

@section('content')

    <div id="app">

        <div class="container px-4 px-lg-5">
            <admin-courses
                set-get-data-url="{{ route('admin.course.index') }}"
                set-show-url="{{ route('admin.course.show', [""]) }}"
                set-presta-url="{{ config('app.presta_url') }}"
            ></admin-courses>

        </div>

        <main class="py-4">
        </main>
    </div>

@stop

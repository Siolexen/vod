@extends('layouts.main')

@section('content')

    <div id="app">
        <div class="container px-4 px-lg-5">
            <admin-courses-edit
                set-get-data-url="{{ route('admin.course.edit', $course->id) }}"
                set-url-update="{{ route('admin.course.update', $course->id) }}"
                set-show-url="{{ route('admin.course.show', [""]) }}"
                set-presta-url="{{ config('app.presta_url') }}"
            ></admin-courses-edit>

        </div>

        <main class="py-4">
        </main>
    </div>

@stop

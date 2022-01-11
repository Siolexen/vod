@extends('layouts.app')

@section('content')
    <user-courses-show
        set-get-user-data-url="{{ route('user.course.index') }}"
        set-get-data-url="{{ route('user.course.show', $courseId) }}"
        set-show-url="{{ route('user.course.show', [""]) }}"
        set-presta-url="{{ config('app.presta_url') }}"
    ></user-courses-show>
@endsection

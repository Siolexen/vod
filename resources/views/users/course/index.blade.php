@extends('layouts.app')

@section('content')
    <user-courses
        set-get-data-url="{{ route('user.course.index') }}"
        set-show-url="{{ route('user.course.show', [""]) }}"
        set-presta-url="{{ config('app.presta_url') }}"
    ></user-courses>
@endsection

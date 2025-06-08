@extends('index')

@section('title')
    <title>
        Ошибка
    </title>
@endsection



@section('main')
    <h2 class="notDone center">

{{-- {{$request}} --}}
{{$message}}

    </h2>

@endsection
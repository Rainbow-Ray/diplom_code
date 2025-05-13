@extends('index')

@section('title')
    <title>{{$title}}</title>
@endsection

@section('main')

<form action="{{$url}}" method="POST" target="_blank">
    @csrf
    <x-period class="" />
    <input type="submit" value="Сформировать">
</form>

@endsection

@extends('List')
@section('title')
<title>Пользователи</title>
@endsection
@section('header')
Пользователи
@endsection

@section('addButton')
@endsection


@section('dictCard')
@foreach ($items as $item)
<div class="card">
    <div class="itemInfo info3">
        <span class="cardLabel">Имя:</span>
        <span class="cardData">{{$item->name}}</span>
        <span class="cardLabel">Сотрудник:</span>
        <span class="cardData">{{$item->worker->surname}} {{$item->worker->name}} {{$item->worker->patronym}}</span>
    </div>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
        </a>
</div>
@endforeach
@endsection

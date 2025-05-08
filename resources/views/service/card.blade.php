@extends('List')
@section('title')
<title>Услуги</title>
@endsection
@section('header')
Услуги
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton">
        Добавить услугу
    </button>
</a>
@endsection


@section('dictCard')
@foreach ($items as $item)
<div class="card">
    <div class="itemInfo customerInfo">
        <span class="cardLabel">Наименование:</span>
        <span class="cardData">{{$item->name}}</span>
        <span class="cardLabel">Стоимость:</span>
        <span class="cardData">{{$item->cost}} руб.</span>
    </div>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
        <button>Редактировать</button>
        </a>
</div>
@endforeach
@endsection

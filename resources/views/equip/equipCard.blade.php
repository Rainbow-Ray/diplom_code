@extends('List')
@section('title')
<title>Оборудование</title>
@endsection
@section('header')
Оборудование
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton">
        Добавить оборудование
    </button>
</a>
@endsection


@section('dictCard')
@foreach ($items as $item)
<div>
    <span>Название:</span>
    <span>{{$item->name}}</span>
    <span>Инвентарный номер:</span>
    <span>{{$item->number}}</span>
    <span>Тип:</span>
    <span>{{$item->equipType -> name}}</span>
    <span>Количество:</span>
    <span>{{$item->count}}</span>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
        <button>Редактировать</button>
        </a>
</div>
<hr>
@endforeach
@endsection

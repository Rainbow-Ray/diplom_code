@extends('index')
@section('title')
<title>Оборудование</title>
@endsection
@section('header')
Оборудование
@endsection

@section('addButton')
@endsection


@section('main')
        <div class="card">

<div class="itemInfo">

    <span class="cardLabel">Название:</span>
    <span class="cardData">{{$item->name}}</span>
    <span class="cardLabel">Инвентарный номер:</span>
    <span class="cardData">{{$item->number}}</span>
    <span class="cardLabel">Тип:</span>
    <span class="cardData">{{$item->equipType -> name}}</span>
    <span class="cardLabel">Количество:</span>
    <span class="cardData">{{$item->count}}</span>
    <span class="cardLabel">Состояние:</span>
    <span class="cardData">{{$item->state()}}</span>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
        <button>Редактировать</button>
        </a>
</div>
</div>

<a href="{{ url('equip_check/'.strval($item->id).'/create', []) }}"><button>Оценка состояния оборудования</button></a>
@endsection

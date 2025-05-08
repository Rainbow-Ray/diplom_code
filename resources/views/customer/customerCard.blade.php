@extends('List')
@section('title')
<title>Клиенты</title>
@endsection
@section('header')
Клиенты
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton">
        Добавить клиента
    </button>
</a>
@endsection

@section('dictCard')
@foreach ($items as $item)

<div class="card">

    <div class="itemInfo customerInfo">
        <span class="cardLabel">ФИО:</span>
        <span class="cardData">{{$item->surname}} {{$item->name}} {{$item->patronym}}</span>
        <span class="cardLabel">Телефон:</span>
        <span class="cardData">{{
        $item->phone[0]
        ."(".substr($item->phone, 1, 3).")"
        .substr($item->phone, 4, 3)
        ."-".substr($item->phone, 7, 2)
        ."-".substr($item->phone, 9, 2)
        }}
        
    </span>
        <span class="cardLabel">Скидка:</span>
        <span class="cardData">{{$item->discount}} %</span>
    
    </div>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
        <button>Редактировать</button>
        </a>
</div>
@endforeach
@endsection

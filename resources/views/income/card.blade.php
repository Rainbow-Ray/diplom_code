@extends('List')
@section('title')
<title>Доходы</title>

<script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>

@endsection

@section('header')
Доходы
@endsection


@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton">
        Добавить доход
    </button>
</a>
@endsection


@section('dictCard')

@foreach ($items as $item)

    <div class="card">
    <div class="itemInfo receiptInfo">
        <span class="cardLabel">Источник:</span>
        <span class="cardData">{{$item->source->name}}</span>

        <span class="cardLabel">Дата:</span>
        <span class="cardData">{{$item->date}}</span>

        <span class="cardLabel">Сумма:</span>
        <span class="cardData">{{$item->amount}} руб.</span>
        
        <span class="cardLabel">Номер:</span>
        <span class="cardData">{{$item->number}}</span>

    
    </div>
    <div>
        <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
            <button>Редактировать</button>
            </a>
        
    </div>
</div>

@endforeach
@endsection

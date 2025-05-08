@extends('List')
@section('title')
<title>Расходы</title>

<script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>

@endsection

@section('header')
Расходы
@endsection


@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton">
        Добавить расход
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

        @if ($item->amount > 0)
        <span class="cardData">{{$item->amount}} руб.</span>

        @else
        <span class="cardData">0 руб.</span>

        @endif

        
        <span class="cardLabel">Целевой сотрудник:</span>
        <span class="cardData">{{$item->worker->surname}} {{$item->worker->name}} {{$item->worker->patronym}}</span>

    
    </div>
    <div>
        <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
            <button>Редактировать</button>
            </a>
        
    </div>
</div>

@endforeach
@endsection

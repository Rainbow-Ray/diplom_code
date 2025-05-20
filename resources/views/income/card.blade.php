@extends('List')
@section('title')
<title>Доходы</title>

<script src=" {{asset('assets/js/jquery-3.7.1.min.js')}}"></script>

@endsection

@section('header')
Доходы
@endsection


@section('addButton')
{{-- <a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить доход
    </button>
</a> --}}
@endsection


@section('dictCard')

@foreach ($items as $item)

    <div class="card">
    <div class="itemInfo info5">
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
                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
            </a>
        
    </div>
</div>

@endforeach
@endsection

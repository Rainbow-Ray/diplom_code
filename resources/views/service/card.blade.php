@extends('List')
@section('title')
<title>Услуги</title>
@endsection
@section('header')
Услуги
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить услугу
    </button>
</a>
@endsection


@section('dictCard')
@foreach ($items as $item)
<div class="card">
    <div class="itemInfo info3">
        <span class="cardLabel start1 end3">Наименование:</span>
        <span class="cardData start1 end3">{{$item->name}}</span>
        <span class="cardLabel">Стоимость:</span>
        <span class="cardData">{{$item->cost}} руб.</span>
    </div>
    <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
        </a>
</div>
@endforeach
@endsection

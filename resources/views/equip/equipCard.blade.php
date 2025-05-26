@extends('List')
@section('title')
<title>Оборудование</title>
@endsection
@section('header')
Оборудование
@endsection

@section('addButton')
<a class="addButtonLink" href="{{url($rootURL.'/create', [])}}">
    <button class="addButton beautyButton">
        Добавить оборудование
    </button>
</a>
@endsection


@section('dictCard')
@foreach ($items as $item)
        <div class="card">


<div class="itemInfo info7">

    <span class="cardLabel start1 end3">Название:</span>
    <span class="cardData start1 end3">{{$item->name}}</span>
    <span class="cardLabel">Инвентарный номер:</span>
    <span class="cardData">{{$item->number}}</span>
    <span class="cardLabel start4 end6">Тип:</span>
    <span class="cardData start4 end6">{{$item->equipType -> name}}</span>
    {{-- <span class="cardLabel">Количество:</span>
    <span class="cardData">{{$item->count}}</span> --}}
    <span class="cardLabel">Состояние:</span>
    <span class="cardData">{{$item->state()}}</span>
                <span class="cardLabel">Дата проверки:</span>
            <span class="cardData">{{ $item->dateCheck() }}</span>

</div>
                    <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">



                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
                        </a>

    {{-- <a href="{{ url($rootURL.'/'.strval($item->id).'/edit', []) }}">
        <button>Редактировать</button>
        </a> --}}

</div>
@endforeach
@endsection

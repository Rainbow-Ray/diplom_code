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
<div class="mainHeader"><h1>
    {{ $item->surname }} {{ $item->name }} {{ $item->patronym }}
    </h1></div>
    <div class="">
        <div class="itemInfo">

            <span class="cardLabel">ФИО:</span>
            <span class="cardData">{{ $item->surname }} {{ $item->name }} {{ $item->patronym }}</span>
            <span class="cardLabel">Телефон:</span>
            <span
                class="cardData">{{ $item->phone[0] .
                    '(' .
                    substr($item->phone, 1, 3) .
                    ')' .
                    substr($item->phone, 4, 3) .
                    '-' .
                    substr($item->phone, 7, 2) .
                    '-' .
                    substr($item->phone, 9, 2) }}

            </span>
            <span class="cardLabel">Скидка:</span>
            <span class="cardData">{{ $item->discount }} %</span>

            <a  href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}" class="rstart2">
                <button class="addButton beautyButton right ">Редактировать</button>
            </a>
        </div>
    </div>

@endsection

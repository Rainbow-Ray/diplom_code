@extends('index')

@section('title')
    <title>{{ $item->source->name }}</title>
@endsection

@section('header')
    {{ $item->source->name }}
@endsection

@section('main')
    <h2>{{ $item->source->name }}</h2>

    <div class="info6">

        <div class="labelTop">
            <span class="cardLabel">Источник:</span>
            <span class="cardData">{{ $item->source->name }}</span>
        </div>
                <div class="labelTop">
            <span class="cardLabel">Дата</span>
            <span class="cardData">{{ $item->date() }}</span>
        </div>

        <div class="labelTop">
            <span class="cardLabel">Сумма</span>
            <span class="cardData">{{ $item->amount }} руб.</span>
        </div>

        <div class="labelTop">
            <span class="cardLabel">Cотрудник:</span>
            <span class="cardData">{{ $item->worker->surname . ' ' . $item->worker->name }}</span>
        </div>


        @if (!is_null($item->receipt()))
            <div class="labelTop">
                <span class="cardLabel">№ квитанции:</span>
                <span class="cardData">{{ $item->receipt()->number }}</span>

            </div>
                            <a href="{{ url('receipt/' . $item->receipt()->id) }}">
                    <button class="addButton beautyButton right">Квитанция</button>
                </a>

        @endif

    </div>

    <div class="right marginTop">
        <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
            <button class="addButton beautyButton">Редактировать</button>
        </a>

    </div>
@endsection

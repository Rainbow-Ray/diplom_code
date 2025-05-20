@extends('List')
@section('title')
    <title>{{ $title }}</title>
@endsection
@section('header')
    {{ $title }}
@endsection

@section('addButton')
    <a class="addButtonLink" href="{{ url($rootURL . '/create', []) }}">
        <button class="addButton beautyButton">
            Добавить должность
        </button>
    </a>
@endsection


@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
            <div class="itemInfo info3">
                <span class="cardLabel">Название:</span>
                <span class="cardData">{{ $item->name }}</span>
                <span class="cardLabel">Заработная плата:</span>
                <span class="cardData">{{ $item->salary }}</span>
            </div>
                                <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">



                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
                        </a>

        </div>
    @endforeach
@endsection

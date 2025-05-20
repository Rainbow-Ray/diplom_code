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
            Добавить
        </button>
    </a>
@endsection


@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
            <div class="itemInfo">

                <span class="cardLabel">Название:</span>
                <span class="cardData">{{ $item->name }}</span>


            </div>
            {{-- <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">
                <button>Редактировать</button>
            </a> --}}

                                <a href="{{ url($rootURL . '/' . strval($item->id) . '/edit', []) }}">



                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
                        </a>

        </div>
    @endforeach
@endsection

@extends('List')
@section('title')
    <title>Сотрудники</title>
@endsection
@section('header')
    Сотрудники
@endsection

@section('addButton')
    <a class="addButtonLink" href="{{ url($rootURL . '/create', []) }}">
        <button class="addButton beautyButton">
            Добавить сотрудника
        </button>
    </a>
@endsection


@section('dictCard')
    @foreach ($items as $item)
        <div class="card">
                <div class="itemInfo workerInfo">
                    <span class="cardLabel">ФИО:</span>
                    <p class="cardData">{{ $item->surname }} {{ $item->name }}
                        {{ $item->patronym }}</p>

                    <span class="cardLabel">Должность:</span>
                    <p class="cardData">{{ $item->job->name }}</p>

                    <span class="cardLabel">Телефон:</span>
                    <p class="cardData">{{ $item->phone }}</p>
                    <span class="cardLabel">email:</span>
                    <p class="cardData">{{ $item->email }}</p>
                </div>

                                            <a href="{{ url($rootURL . '/' . strval($item->id), []) }}">



                <img src="{{asset('assets/css/angle-right-svgrepo-com.svg')}}" alt="">
                        </a>

        </div>
    @endforeach
@endsection
